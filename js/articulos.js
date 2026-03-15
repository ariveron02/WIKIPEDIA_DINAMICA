class Articulo {
  constructor(data) {
    this.id = data.id_tabla || data.id;
    this.titulo = data.name_tabla || data.titulo;
    this.contenido = data.info_tabla || data.contenido;
    this.imagen = data.img_tabla || data.img;
    this.fecha = data.created_at || "Reciente";
  }

  resumen() {
    return `${this.titulo} (${this.fecha})`;
  }
}

// ARTÍCULOS DE LA BD
const listaArticulos = (
  typeof articulosBD !== "undefined" ? articulosBD : []
).map((a) => new Articulo(a));

// TODO DENTRO DE UN SOLO DOMContentLoaded
document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.querySelector(".container.mt-5");
  const articulosDOM = JSON.parse(localStorage.getItem("articulosDOM")) || [];

  // INYECTAR ARTÍCULOS DESDE LOCALSTORAGE
  articulosDOM.forEach((a) => {
    const div = document.createElement("div");
    div.className = "card mb-5 shadow-sm p-3 position-relative articulo";
    div.id = "articulo" + a.id;
    div.innerHTML = `
      ${a.img ? `<div class="float-end ms-3 mb-3" style="width: 300px;">
        <div class="border rounded p-2 bg-light">
          <img src="${a.img}" class="img-fluid rounded w-100">
        </div>
      </div>` : ""}
      <h2 class="card-title">${a.titulo}</h2>
      <p class="card-text">${a.contenido}</p>
      <small class="text-muted">Publicado recientemente</small>
      <div class="mt-2">
        <button class="btn btn-warning btn-sm favorito-btn" data-id="${a.id}">⭐ Favorito</button>
        <span class="badge bg-secondary visitas" data-id="${a.id}">0 visitas</span>
      </div>
      <div class="clearfix"></div>
    `;
    contenedor.appendChild(div);
  });

  // EFECTO ESCALONADO AL CARGAR
  const articulosCards = document.querySelectorAll(".articulo");
  articulosCards.forEach((articulo, index) => {
    articulo.style.opacity = "0";
    setTimeout(() => {
      articulo.style.transition = "opacity 0.8s";
      articulo.style.opacity = "1";
    }, index * 200);
  });

  // CONTADOR DE VISITAS
  let visitas = JSON.parse(localStorage.getItem("visitas")) || {};
  document.querySelectorAll(".articulo").forEach((card) => {
    const id = card.id.replace("articulo", "");
    if (!visitas[id]) visitas[id] = 0;
    visitas[id]++;
    localStorage.setItem("visitas", JSON.stringify(visitas));

    const badge = card.querySelector(`.visitas[data-id="${id}"]`);
    setTimeout(() => {
      if (badge) badge.textContent = visitas[id] + " visitas";
    }, 800);
  });

  // BUSCADOR FUNCIONAL
  const buscador = document.getElementById("buscador");
  if (buscador) {
    buscador.form.addEventListener("submit", (e) => {
      e.preventDefault();
      const texto = buscador.value.toLowerCase();
      listaArticulos.forEach((art) => {
        if (art.titulo.toLowerCase().includes(texto)) {
          location.href = "#articulo" + art.id;
        }
      });
    });
  }

  // MARCAR ARTÍCULOS YA VISITADOS AL CARGAR
  let visitados = JSON.parse(localStorage.getItem("articulos_visitados")) || [];

  visitados.forEach((id) => {
    const card = document.getElementById("articulo" + id);
    if (card) {
      card.style.borderLeft = "4px solid #198754";
      const titulo = card.querySelector("h2");
      if (titulo && !titulo.querySelector(".badge.bg-success")) {
        const badge = document.createElement("span");
        badge.className = "badge bg-success ms-2";
        badge.textContent = "✔ Ya visitado";
        titulo.appendChild(badge);
      }
    }
  });

  // FAVORITOS + MARCAR VISITADO 
  document.querySelectorAll(".favorito-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;

      // Guardar en favoritos
      let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
      if (!favoritos.includes(id)) favoritos.push(id);
      localStorage.setItem("favoritos", JSON.stringify(favoritos));

      const mensaje = document.createElement("div");
      mensaje.className = "alert alert-success mt-2";
      mensaje.textContent = "Artículo añadido a favoritos";
      btn.parentElement.appendChild(mensaje);
      setTimeout(() => mensaje.remove(), 2000);

      // Marcar como visitado
      const card = btn.closest(".articulo");
      if (card && !visitados.includes(id)) {
        visitados.push(id);
        localStorage.setItem("articulos_visitados", JSON.stringify(visitados));
        card.style.borderLeft = "4px solid #198754";
        const titulo = card.querySelector("h2");
        if (titulo && !titulo.querySelector(".badge.bg-success")) {
          const badge = document.createElement("span");
          badge.className = "badge bg-success ms-2";
          badge.textContent = "✔ Ya visitado";
          titulo.appendChild(badge);
        }
      }
    });
  });

  // SOLO ADMIN
  const esAdmin = document.getElementById("tabla-usuarios");

  if (esAdmin) {

    // CONFIRMACIÓN ACEPTAR/RECHAZAR PETICIONES
    document.querySelectorAll("form").forEach((form) => {
      form.addEventListener("submit", function (e) {
        const boton = e.submitter;
        if (!boton) return;
        const accion = boton.value === "aceptada" ? "aceptar" : "rechazar";
        const confirmar = confirm(`¿Estás seguro de que quieres ${accion} esta petición?`);
        if (!confirmar) {
          e.preventDefault();
        }
      });
    });

    // CONTADORES
    const contadorUsuarios = document.getElementById("contador-usuarios");
    if (contadorUsuarios) {
      const filas = document.querySelectorAll("#tabla-usuarios tbody tr td.fw-semibold");
      contadorUsuarios.textContent = filas.length;
    }

    const contadorPeticiones = document.getElementById("contador-peticiones");
    if (contadorPeticiones) {
      const pendientes = document.querySelectorAll(".badge.bg-warning");
      contadorPeticiones.textContent = pendientes.length;
    }

    // BORRAR ARTÍCULOS DE USUARIOS
    let articulosDOMAdmin = JSON.parse(localStorage.getItem("articulosDOM")) || [];

    if (articulosDOMAdmin.length === 0) {
      const aviso = document.createElement("div");
      aviso.className = "alert alert-info mt-3";
      aviso.textContent = "No hay artículos subidos por usuarios.";
      document.querySelector(".container.mt-5").appendChild(aviso);
    } else {
      const seccion = document.createElement("div");
      seccion.className = "mt-5";
      seccion.innerHTML = `
        <div class="row mb-4 ps-2">
          <div class="col">
            <h2 class="display-6 fw-bold text-dark">Artículos subidos por usuarios</h2>
            <p class="text-secondary">Gestión de contenido añadido por los usuarios</p>
          </div>
        </div>
        <div class="table-responsive border rounded-4 shadow-sm">
          <table class="table table-hover mb-0" id="tabla-articulos-usuarios">
            <thead class="table-light">
              <tr>
                <th class="py-3 ps-4 text-uppercase small fw-bold text-secondary">Título</th>
                <th class="py-3 text-uppercase small fw-bold text-secondary">Contenido</th>
                <th class="py-3 pe-4 text-end text-uppercase small fw-bold text-secondary">Acciones</th>
              </tr>
            </thead>
            <tbody id="tbody-articulos-usuarios" class="align-middle"></tbody>
          </table>
        </div>
      `;
      document.querySelector(".container.mt-5").appendChild(seccion);

      const tbody = document.getElementById("tbody-articulos-usuarios");

      articulosDOMAdmin.forEach((art) => {
        const tr = document.createElement("tr");
        tr.id = "fila-" + art.id;
        tr.innerHTML = `
          <td class="ps-4 fw-semibold text-dark">${art.titulo}</td>
          <td class="text-muted">${art.contenido.substring(0, 80)}...</td>
          <td class="pe-4 text-end">
            <button class="btn btn-danger btn-sm borrar-articulo" data-id="${art.id}">🗑 Borrar</button>
          </td>
        `;
        tbody.appendChild(tr);

        tr.querySelector(".borrar-articulo").addEventListener("click", () => {
          const confirmar = confirm(`¿Seguro que quieres borrar "${art.titulo}"?`);
          if (!confirmar) return;

          let arts = JSON.parse(localStorage.getItem("articulosDOM")) || [];
          arts = arts.filter((a) => a.id != art.id);
          localStorage.setItem("articulosDOM", JSON.stringify(arts));

          tr.style.transition = "opacity 0.3s ease";
          tr.style.opacity = "0";
          setTimeout(() => {
            tr.remove();
            if (arts.length === 0) {
              tbody.innerHTML = `<tr><td colspan="3" class="text-center py-4 text-muted">No hay artículos subidos por usuarios.</td></tr>`;
            }
          }, 300);
        });
      });
    }

  } else {

    // SOLO PÁGINA DE USUARIO

    // CONFIRMACIÓN ANTES DE ENVIAR PETICIÓN
    document.querySelectorAll('form[method="POST"]').forEach((form) => {
      form.addEventListener("submit", function (e) {
        const textarea = form.querySelector('textarea[name="peticion_texto"]');
        if (!textarea) return;
        const confirmar = confirm("¿Seguro que quieres enviar esta petición?");
        if (!confirmar) {
          e.preventDefault();
        }
      });
    });

    // FORMULARIO AÑADIR ARTÍCULOS
    const formAgregar = document.getElementById("formAgregarArticulo");
    const mensajeForm = document.getElementById("mensajeArticulo");
    if (formAgregar) {
      formAgregar.addEventListener("submit", (e) => {
        e.preventDefault();
        const data = new FormData(formAgregar);
        const nuevoArticulo = {
          id: Date.now(),
          titulo: data.get("titulo"),
          contenido: data.get("contenido"),
          img: data.get("img"),
        };

        articulosDOM.push(nuevoArticulo);
        localStorage.setItem("articulosDOM", JSON.stringify(articulosDOM));

        const div = document.createElement("div");
        div.className = "card mb-5 shadow-sm p-3 position-relative articulo";
        div.id = "articulo" + nuevoArticulo.id;
        div.innerHTML = `
          ${nuevoArticulo.img ? `<div class="float-end ms-3 mb-3" style="width: 300px;">
            <div class="border rounded p-2 bg-light">
              <img src="${nuevoArticulo.img}" class="img-fluid rounded w-100">
            </div>
          </div>` : ""}
          <h2 class="card-title">${nuevoArticulo.titulo}</h2>
          <p class="card-text">${nuevoArticulo.contenido}</p>
          <small class="text-muted">Publicado recientemente</small>
          <div class="mt-2">
            <button class="btn btn-warning btn-sm favorito-btn" data-id="${nuevoArticulo.id}">⭐ Favorito</button>
            <span class="badge bg-secondary visitas" data-id="${nuevoArticulo.id}">0 visitas</span>
          </div>
          <div class="clearfix"></div>
        `;
        contenedor.appendChild(div);

        // Listener favorito solo para el nuevo artículo
        div.querySelector(".favorito-btn").addEventListener("click", () => {
          const id = nuevoArticulo.id.toString();
          let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
          if (!favoritos.includes(id)) favoritos.push(id);
          localStorage.setItem("favoritos", JSON.stringify(favoritos));

          const m = document.createElement("div");
          m.className = "alert alert-success mt-2";
          m.textContent = "Artículo añadido a favoritos";
          div.querySelector(".mt-2").appendChild(m);
          setTimeout(() => m.remove(), 2000);

          // Marcar como visitado
          if (!visitados.includes(id)) {
            visitados.push(id);
            localStorage.setItem("articulos_visitados", JSON.stringify(visitados));
            div.style.borderLeft = "4px solid #198754";
            const titulo = div.querySelector("h2");
            if (titulo && !titulo.querySelector(".badge.bg-success")) {
              const badge = document.createElement("span");
              badge.className = "badge bg-success ms-2";
              badge.textContent = "✔ Ya visitado";
              titulo.appendChild(badge);
            }
          }
        });

        mensajeForm.textContent = "Artículo añadido correctamente!";
        setTimeout(() => (mensajeForm.textContent = ""), 3000);
        formAgregar.reset();
      });
    }
  }

}); 
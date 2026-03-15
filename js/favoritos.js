document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.getElementById("favoritos-container");
  const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
  const articulosDOM = JSON.parse(localStorage.getItem("articulosDOM")) || [];
  const articulosBD = typeof articulos !== "undefined" ? articulos : [];

  // Combinar artículos de BD y LocalStorage
  const todosArticulos = [...articulosBD, ...articulosDOM];

  if (favoritos.length === 0) {
    document.getElementById("mensaje-vacio").classList.remove("d-none");
    return;
  }

  favoritos.forEach((idFav) => {
    const art = todosArticulos.find((a) => (a.id_tabla || a.id) == idFav);
    if (art) {
      const idArt = art.id_tabla || art.id;
      const div = document.createElement("div");
      div.className = "col-12 col-md-6 col-lg-4";
      div.innerHTML = `
                <div class="card shadow-sm p-3 h-100">
                    ${
                      art.img_tabla || art.img
                        ? `
                    <div class="mb-3">
                        <img src="${art.img_tabla || art.img}" class="img-fluid rounded w-100" style="max-height:180px; object-fit:cover;">
                    </div>`
                        : ""
                    }
                    <h5 class="card-title fw-bold">${art.name_tabla || art.titulo}</h5>
                    <p class="card-text text-muted">${art.info_tabla || art.contenido}</p>
                    <small class="text-muted">Publicado: ${art.created_at || "Reciente"}</small>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <span class="badge bg-secondary visitas" data-id="${idArt}">0 visitas</span>
                        <button class="btn btn-danger btn-sm quitar-fav" data-id="${idArt}">❌ Quitar</button>
                    </div>
                </div>
            `;
      contenedor.appendChild(div);

      // Contador de visitas
      let visitas = JSON.parse(localStorage.getItem("visitas")) || {};
      if (!visitas[idArt]) visitas[idArt] = 0;
      div.querySelector(".visitas").textContent = visitas[idArt] + " visitas";

      // Quitar favorito con confirmación
      div.querySelector(".quitar-fav").addEventListener("click", () => {
        const confirmar = confirm(
          `¿Quieres quitar "${art.name_tabla || art.titulo}" de tus favoritos?`,
        );
        if (!confirmar) return;

        let favs = JSON.parse(localStorage.getItem("favoritos")) || [];
        favs = favs.filter((f) => f != idArt);
        localStorage.setItem("favoritos", JSON.stringify(favs));

        // Animación de salida antes de eliminar
        div.style.transition = "opacity 0.3s ease, transform 0.3s ease";
        div.style.opacity = "0";
        div.style.transform = "scale(0.95)";
        setTimeout(() => {
          div.remove();
          if (favs.length === 0) {
            document.getElementById("mensaje-vacio").classList.remove("d-none");
          }
        }, 300);
      });
    }
  });
});

// ================================
// CLASE ARTICULO
// ================================
class Articulo {
    constructor(data){
        this.id = data.id_tabla || data.id; 
        this.titulo = data.name_tabla || data.titulo;
        this.contenido = data.info_tabla || data.contenido;
        this.imagen = data.img_tabla || data.img;
        this.fecha = data.created_at || "Reciente";
    }

    resumen(){
        return `${this.titulo} (${this.fecha})`;
    }
}

// ================================
// ARTÍCULOS DE LA BD
// ================================
const listaArticulos = (typeof articulosBD !== 'undefined' ? articulosBD : []).map(a => new Articulo(a));

// ================================
// INYECTAR ARTÍCULOS DESDE LOCALSTORAGE
// ================================
document.addEventListener('DOMContentLoaded', () => {

    const contenedor = document.querySelector('.container.mt-5');

    // Artículos guardados desde la página normal (usuario)
    const articulosDOM = JSON.parse(localStorage.getItem('articulosDOM')) || [];

    articulosDOM.forEach(a => {
        const div = document.createElement('div');
        div.className = "card mb-5 shadow-sm p-3 position-relative articulo";
        div.id = "articulo" + a.id;
        div.innerHTML = `
            ${a.img ? `<div class="float-end ms-3 mb-3" style="width: 300px;">
                <div class="border rounded p-2 bg-light">
                    <img src="${a.img}" class="img-fluid rounded w-100">
                </div>
            </div>` : ''}
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

    // ================================
    // EFECTO ESCALONADO AL CARGAR
    // ================================
    const articulosCards = document.querySelectorAll(".articulo");
    articulosCards.forEach((articulo, index) => {
        articulo.style.opacity = "0";
        setTimeout(() => {
            articulo.style.transition = "opacity 0.8s";
            articulo.style.opacity = "1";
        }, index * 200);
    });

    // ================================
    // FAVORITOS CON LOCALSTORAGE
    // ================================
    document.querySelectorAll(".favorito-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
            if(!favoritos.includes(id)) favoritos.push(id);
            localStorage.setItem("favoritos", JSON.stringify(favoritos));

            // MENSAJE TEMPORAL
            const mensaje = document.createElement("div");
            mensaje.className = "alert alert-success mt-2";
            mensaje.textContent = "Artículo añadido a favoritos";
            btn.parentElement.appendChild(mensaje);

            setTimeout(() => mensaje.remove(), 2000);
        });
    });

    // ================================
    // CONTADOR DE VISITAS
    // ================================
    let visitas = JSON.parse(localStorage.getItem("visitas")) || {};
    document.querySelectorAll(".articulo").forEach(card => {
        const id = card.id.replace("articulo","");
        if(!visitas[id]) visitas[id] = 0;
        visitas[id]++;
        localStorage.setItem("visitas", JSON.stringify(visitas));

        const badge = card.querySelector(`.visitas[data-id="${id}"]`);
        setTimeout(() => {
            if(badge) badge.textContent = visitas[id] + " visitas";
        }, 800);
    });

    // ================================
    // BUSCADOR FUNCIONAL
    // ================================
    const buscador = document.getElementById("buscador");
    if(buscador){
        buscador.form.addEventListener("submit", e => {
            e.preventDefault();
            const texto = buscador.value.toLowerCase();
            listaArticulos.forEach(art => {
                if(art.titulo.toLowerCase().includes(texto)){
                    location.href = "#articulo" + art.id;
                }
            });
        });
    }

    // ================================
    // FORMULARIO PARA USUARIO: AÑADIR ARTÍCULOS
    // ================================
    const formAgregar = document.getElementById("formAgregarArticulo");
    const mensajeForm = document.getElementById("mensajeArticulo");
    if(formAgregar){
        formAgregar.addEventListener("submit", e => {
            e.preventDefault();
            const data = new FormData(formAgregar);
            const nuevoArticulo = {
                id: Date.now(),
                titulo: data.get("titulo"),
                contenido: data.get("contenido"),
                img: data.get("img")
            };

            // Guardar en LocalStorage
            articulosDOM.push(nuevoArticulo);
            localStorage.setItem("articulosDOM", JSON.stringify(articulosDOM));

            // Inyectar en DOM
            const div = document.createElement("div");
            div.className = "card mb-5 shadow-sm p-3 position-relative articulo";
            div.id = "articulo" + nuevoArticulo.id;
            div.innerHTML = `
                ${nuevoArticulo.img ? `<div class="float-end ms-3 mb-3" style="width: 300px;">
                    <div class="border rounded p-2 bg-light">
                        <img src="${nuevoArticulo.img}" class="img-fluid rounded w-100">
                    </div>
                </div>` : ''}
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

            // Añadir funcionalidad de favorito al nuevo artículo
            div.querySelector(".favorito-btn").addEventListener("click", () => {
                let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
                if(!favoritos.includes(nuevoArticulo.id.toString())) favoritos.push(nuevoArticulo.id.toString());
                localStorage.setItem("favoritos", JSON.stringify(favoritos));
                const m = document.createElement("div");
                m.className = "alert alert-success mt-2";
                m.textContent = "Artículo añadido a favoritos";
                div.querySelector(".mt-2").appendChild(m);
                setTimeout(() => m.remove(), 2000);
            });

            mensajeForm.textContent = "Artículo añadido correctamente!";
            setTimeout(() => mensajeForm.textContent = "", 3000);
            formAgregar.reset();
        });
    }
});
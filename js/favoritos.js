
document.addEventListener("DOMContentLoaded", () => {
    const contenedor = document.getElementById("favoritos-container");
    const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
    const articulosDOM = JSON.parse(localStorage.getItem("articulosDOM")) || [];
    const articulosBD = typeof articulos !== 'undefined' ? articulos : [];

    // Combinar artículos de BD y LocalStorage
    const todosArticulos = [...articulosBD, ...articulosDOM];

    if(favoritos.length === 0){
        document.getElementById("mensaje-vacio").classList.remove("d-none");
        return;
    }

    favoritos.forEach(idFav => {
        const art = todosArticulos.find(a => (a.id_tabla || a.id) == idFav);
        if(art){
            const div = document.createElement("div");
            div.className = "col-12 col-md-6 col-lg-4";
            div.innerHTML = `
                <div class="card shadow-sm p-3 position-relative">
                    ${art.img_tabla || art.img ? `<div class="float-end ms-3 mb-3" style="width: 150px;">
                        <div class="border rounded p-2 bg-light">
                            <img src="${art.img_tabla || art.img}" class="img-fluid rounded w-100">
                        </div>
                    </div>` : ''}
                    <h5 class="card-title">${art.name_tabla || art.titulo}</h5>
                    <p class="card-text">${art.info_tabla || art.contenido}</p>
                    <small class="text-muted">Publicado: ${art.created_at || "Reciente"}</small>
                    <div class="mt-2 d-flex justify-content-between align-items-center">
                        <span class="badge bg-secondary visitas" data-id="${art.id_tabla || art.id}">0 visitas</span>
                        <button class="btn btn-danger btn-sm quitar-fav" data-id="${art.id_tabla || art.id}">❌ Quitar</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            `;
            contenedor.appendChild(div);

            // Contador de visitas
            let visitas = JSON.parse(localStorage.getItem("visitas")) || {};
            const idArt = art.id_tabla || art.id;
            if(!visitas[idArt]) visitas[idArt] = 0;
            visitas[idArt]++;
            localStorage.setItem("visitas", JSON.stringify(visitas));
            div.querySelector(`.visitas`).textContent = visitas[idArt] + " visitas";

            // Quitar favorito
            div.querySelector(".quitar-fav").addEventListener("click", () => {
                let favs = JSON.parse(localStorage.getItem("favoritos")) || [];
                favs = favs.filter(f => f != idArt);
                localStorage.setItem("favoritos", JSON.stringify(favs));
                div.remove();
                if(favs.length === 0){
                    document.getElementById("mensaje-vacio").classList.remove("d-none");
                }
            });
        }
    });
});
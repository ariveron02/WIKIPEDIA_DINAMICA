window.onload = function() {

    // MENSAJE DE BIENVENIDA
    const bienvenida = document.getElementById('bienvenida');
    if (bienvenida) {
        setTimeout(() => bienvenida.classList.add('show'), 700);
        setTimeout(() => bienvenida.classList.remove('show'), 4000);
    }

    // ANIMACIÓN AL HACER SCROLL
    setTimeout(() => {
        const sections = document.querySelectorAll('#articulos .card, #categorias .col-6, #sobre-nosotros');
        
        sections.forEach((el, index) => {
            el.classList.add('fade-in-section');
            el.style.transitionDelay = `${index * 0.12}s`;
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.01, rootMargin: '0px 0px -50px 0px' });

        sections.forEach(el => observer.observe(el));

    }, 100);

};
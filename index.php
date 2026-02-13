<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiÁgora</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/index.css" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR PRINCIPAL -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>

            <!-- Links, buscador y botones -->
            <div class="collapse navbar-collapse" id="navbarContenido">
                <!-- Menú de navegación -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Artículos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sobre nosotros</a></li>
                </ul>

                <!-- Buscador -->
                <form class="d-flex me-3">
                    <input class="form-control form-control-sm search-input" type="search" placeholder="Buscar...">
                </form>

                <!-- Botones de login / signup -->
                <a href="frontend/login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
                <a href="frontend/registro.php" class="btn btn-light btn-sm">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- CAROUSEL CON OVERLAY -->
<main class="flex-grow-1">
    <div id="carouselFondo" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="fotos/mundo.webp" class="d-block w-100 carousel-img" alt="Mundo">
                <br>
                <!-- TEXTO CENTRAL -->
                <div class="conocimiento d-flex flex-column justify-content-center align-items-center text-center">
                    <h1>Explora el conocimiento</h1>
                    <p>Una enciclopedia colaborativa moderna</p>
                    <a href="#" class="btn btn-primary btn-lg mt-3">Explorar artículos</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="fotos/articulo.avif" class="d-block w-100 carousel-img" alt="Artículo">
                <div class="conocimiento d-flex flex-column justify-content-center align-items-center text-center">
                    <h1>Explora el conocimiento</h1>
                    <p>Una enciclopedia colaborativa moderna</p>
                    <a href="#" class="btn btn-primary btn-lg mt-3">Explorar artículos</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="fotos/conocimiento.jpg" class="d-block w-100 carousel-img" alt="Conocimiento">
                <div class="conocimiento d-flex flex-column justify-content-center align-items-center text-center">
                    <h1>Explora el conocimiento</h1>
                    <p>Una enciclopedia colaborativa moderna</p>
                    <a href="#" class="btn btn-primary btn-lg mt-3">Explorar artículos</a>
                </div>
            </div>

        </div>
    </div>
</main>

<footer class="custom-footer">
    <div class="container">
        <div class="row text-center text-md-start">

            <div class="col-md-4 mb-4">
                <h5 class="footer-title">WikiÁgora</h5>
                <p>Enciclopedia colaborativa moderna para explorar y compartir conocimiento.</p>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="footer-title">Enlaces</h5>
                <ul class="footer-links">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Artículos</a></li>
                    <li><a href="#">Categorías</a></li>
                    <li><a href="#">Sobre nosotros</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="footer-title">Equipo</h5>
                <p>Aitor, Alberto, David y Sara</p>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="text-center small">
            © 2026 WikiÁgora | Todos los derechos reservados
        </div>
    </div>
</footer>

</html>
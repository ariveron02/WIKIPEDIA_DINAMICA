<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiÁgora</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href= "header.css">
</head>
<body>

 <header class="navbar">
    <div class="nav-container">
        
        <div class="logo">
            <div class="logo-box">B</div>
        </div>

        <nav class="nav-links">
            <a href="#">Home</a>
            <a href="#">Features</a>
            <a href="#">Pricing</a>
            <a href="#">FAQs</a>
            <a href="#">About</a>
            <p>HOLA
        </nav>

        <div class="nav-actions">
            <input type="text" placeholder="Search..." class="search-input">

            <button class="btn btn-outline" >Login</button>
            <button class="btn btn-primary">Sign-up</button>
        </div>

    </div>
</header>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Logo a la izquierda -->
        <a class="navbar-brand" href="#">
            <img src="fotos/wikiagora_blanco.png" alt="WikiÁgora" height="40">
        </a>
        <!-- Botones a la derecha -->
        <div class="ms-auto d-flex">
            <a href="frontend/registro.php" class="btn btn-light me-2">Registrarse</a>
            <a href="frontend/login.php" class="btn btn-outline-light">Iniciar sesión</a>
        </div>
    </div>
</nav>

<!-- Carousel de fondo -->
<div id="carouselFondo" class="carousel slide vh-100" data-bs-ride="false">
    <div class="carousel-inner h-100">
        <div class="carousel-item active h-100">
            <a href="https://es.wikipedia.org/wiki/Mundo">
                <img src="fotos/mundo.webp" class="d-block w-100 h-100" style="object-fit: cover;" alt="Mundo">
            </a>
        </div>
        <div class="carousel-item h-100">
            <a href="https://es.wikipedia.org/wiki/Artículo">
                <img src="fotos/articulo.avif" class="d-block w-100 h-100" style="object-fit: cover;" alt="Artículo">
            </a>
        </div>
        <div class="carousel-item h-100">
            <a href="https://es.wikipedia.org/wiki/Conocimiento">
                <img src="fotos/conocimiento.jpg" class="d-block w-100 h-100" style="object-fit: cover;" alt="Conocimiento">
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <p> Wikipedia | © Todos los derechos reservados </p>
    <p> Desarrolladores: Aitor, Alberto, David y Sara. </p>
</footer>
</html>

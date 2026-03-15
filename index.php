<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiÁgora</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="../fotos/logowiki.png">
</head>

<body>
    <div id="toast-bienvenida">👋 ¡Bienvenido a WikiÁgora!</div>
    <?php
    include 'includes/header.php';
    ?>
        <!-- CAROUSEL CON OVERLAY -->
        <main class="flex-grow-1">
            <div id="miCarrusel" class="carousel slide" data-bs-ride="carousel">
    
    <div class="carousel-inner">
        
        <!-- Imagen 1 -->
        <div class="carousel-item active">
            <img src="fotos/imagen1W.png" class="d-block w-100 carousel-img" alt="Mundo">
        </div>

        <!-- Imagen 2 -->
        <div class="carousel-item">
            <img src="fotos/imagen3WW.png" class="d-block w-100 carousel-img" alt="Programación">
        </div>

        <!-- Imagen 3 -->
        <div class="carousel-item">
            <img src="fotos/imagen0W.png" class="d-block w-100 carousel-img" alt="Código">
        </div>

    </div>

    <!-- Botón anterior -->
    <button class="carousel-control-prev" type="button" data-bs-target="#miCarrusel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <!-- Botón siguiente -->
    <button class="carousel-control-next" type="button" data-bs-target="#miCarrusel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>
        </main>

        <section id="articulos" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" style="color: #003366;">Artículos Destacados</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="fotos/articulo.avif" class="card-img-top" alt="Tecnología">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Avances en IA</h5>
                            <p class="card-text text-muted">Explora cómo la inteligencia artificial está transformando el desarrollo web moderno.</p>
                            <a href="frontend/login.php" class="btn btn-outline-primary btn-sm">Leer más</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="fotos/mundo.webp" class="card-img-top" alt="Historia">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Historia Universal</h5>
                            <p class="card-text text-muted">Un recorrido por los hitos que marcaron el rumbo de nuestra civilización actual.</p>
                            <a href="frontend/login.php" class="btn btn-outline-primary btn-sm">Leer más</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="fotos/ciencia.jpg" class="card-img-top" alt="Ciencia">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Física Cuántica</h5>
                            <p class="card-text text-muted">Conceptos básicos para entender el fascinante mundo de las partículas subatómicas.</p>
                            <a href="frontend/login.php" class="btn btn-outline-primary btn-sm">Leer más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="categorias" class="py-5 bg-white"> <div class="container">
        <h2 class="text-center mb-5 fw-bold" style="color: #003366;">Explorar por Categorías</h2>
        <div class="row text-center g-3">
            <div class="col-6 col-md-3">
                <div class="p-4 bg-light border rounded shadow-sm hover-elevate"> <i class="bi bi-laptop fs-1 mb-2"></i>
                    <h6 class="fw-bold">Tecnología</h6>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 bg-light border rounded shadow-sm hover-elevate"> <i class="bi bi-palette fs-1 mb-2"></i>
                    <h6 class="fw-bold">Arte</h6>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 bg-light border rounded shadow-sm hover-elevate"> <i class="bi bi-mortaboard fs-1 mb-2"></i>
                    <h6 class="fw-bold">Educación</h6>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 bg-light border rounded shadow-sm hover-elevate"> <i class="bi bi-heart-pulse fs-1 mb-2"></i>
                    <h6 class="fw-bold">Salud</h6>
                </div>
            </div>
        </div>
        </div>
    </section>
    
    <section id="sobre-nosotros" class="py-5 text-white" style="background-color: #003366;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h2 class="fw-bold">Sobre WikiÁgora</h2>
                    <p class="lead">Somos una plataforma dedicada a democratizar el acceso a la información mediante la colaboración ciudadana.</p>
                    <p>Nuestro objetivo es crear un espacio seguro y moderno donde expertos y entusiastas puedan compartir conocimientos verificados de forma gratuita.</p>
                    <a href="frontend/login.php" class="btn btn-warning fw-bold px-4">Conoce al equipo</a>
                </div>
                <div class="col-md-6 text-center">
                    <div class="border border-2 border-warning rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                        <div class="logo-box m-0 fs-1">W</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/scroll.js"></script> 
    <div id="toast-bienvenida">👋 ¡Bienvenido a WikiÁgora!</div>  
    <?php include 'includes/footer.php'; ?>
</body>
</html>
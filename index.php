

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiÁgora</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>

<body>
    
<?php
include 'includes/header.php';
?>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>
</html>
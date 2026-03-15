<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContenido">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#articulos">Artículos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#categorias">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#sobre-nosotros">Sobre nosotros</a></li>
                </ul>

                <div class="d-flex flex-column flex-lg-row">
                    <a href="frontend/login.php" class="btn btn-outline-light btn-sm me-lg-2 mb-2 mb-lg-0">Login</a>
                    <a href="frontend/registro.php" class="btn btn-light btn-sm">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>
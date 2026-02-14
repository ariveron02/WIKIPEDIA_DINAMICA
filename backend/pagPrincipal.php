<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiAgora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-navbar { background-color: #0d6efd; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>

            <div class="collapse navbar-collapse" id="navbarContenido">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Artículos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sobre nosotros</a></li>
                </ul>

                <form class="d-flex me-3">
                    <input class="form-control form-control-sm search-input" type="search" placeholder="Buscar...">
                </form>

                <p class="text-white mb-0 me-3">
                    Bienvenido, <b><?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Usuario'; ?></b>
                </p>

                <a href="cerrar_sesion.php" class="btn btn-light btn-sm rounded-pill px-3">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div style="margin-top: 100px;"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../includes/footer.php'; ?>
</body>
</html>
<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';
?>
<script>
const articulos = <?php echo json_encode($articulos, JSON_UNESCAPED_UNICODE); ?>;
</script>
<script src="../js/favoritos.js"></script>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Favoritos - WikiAgora</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/index.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
<div class="container">
    <a class="navbar-brand d-flex align-items-center" href="pagPrincipal.php">
        <div class="logo-box me-2">W</div>
        <span class="fw-bold">WikiÁgora</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido">
        <span class="navbar-toggler-icon"></span>
    </button>
<a href="principal.php" class="btn btn-warning btn-sm rounded-pill px-3 me-2">Favoritos</a>
    <div class="collapse navbar-collapse" id="navbarContenido">
        <div class="d-flex align-items-center ms-auto">
            <p class="text-white mb-0 me-3">
                Bienvenido, <b><?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Usuario'; ?></b>
            </p>
            <a href="cerrar_sesion.php" class="btn btn-light btn-sm rounded-pill px-3">Cerrar Sesión</a>
        </div>
    </div>
</div>
</nav>

<div class="container mt-5">
    <h2 class="display-6 fw-bold text-dark mb-4">Tus Favoritos</h2>
    <div id="favoritos-container" class="row g-3">
        <!-- Aquí se inyectarán los artículos favoritos desde JS -->
    </div>
    <div id="mensaje-vacio" class="alert alert-info mt-4 d-none">No tienes artículos favoritos.</div>
</div>

<div style="margin-top: 100px;"></div>
<?php include '../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/favoritos.js"></script>
</body>
</html>
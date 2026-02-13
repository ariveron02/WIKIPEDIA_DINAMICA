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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Logo a la izquierda -->
        <a class="navbar-brand" href="#">
            <img src="../fotos/wikiagora_blanco.png" alt="WikiÁgora" height="40">
        </a>
        <!-- Botones a la derecha -->
        <div class="ms-auto d-flex">
            <a href="backend/cerrar_sesion.php" class="btn btn-outline-light">Cerrar sesión</a>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<footer>
    <p> Wikipedia | © Todos los derechos reservados </p>
    <p> Desarrolladores: Aitor, Alberto, David y Sara.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
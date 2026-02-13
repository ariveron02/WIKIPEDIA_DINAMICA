<?php
// Incluimos la conexión (ajusta la ruta según donde pongas este archivo)
require_once __DIR__ . '../includes/conexion.php';

// Simulación de control de acceso (Idealmente aquí verificarías la sesión)
session_start();
if($_SESSION['rol'] != 'admin') { header("Location: login.php"); exit(); }

// Consulta para obtener usuarios
$sql = "SELECT name, email FROM usuarios";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - WikiAgora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Fondo blanco total */
            color: white;
        }
        .navbar {
            background-color: #000000; /* Fondo negro para el nav */
            border-radius: 50px; /* Bordes redondeados tipo píldora */
            margin: 20px auto;
            max-width: 95%;
            padding: 10px 30px;
        }
        .table {
            color: white;
            border-color: #333;
        }
        .table thead {
            background-color: #111;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="fotos/wikiagora_blanco.webp" alt="Logo" height="30">
            </a>

            <div class="ms-auto d-flex align-items-center">
                <span class="text-dark fw-bold me-3">Panel de Administrador</span>
                <a href="frontend/cerrar_sesion.php" class="btn btn-danger btn-sm rounded-pill px-4">Salir</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Usuarios Registrados</h2>
        
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <span class="badge bg-secondary">Ver detalles</span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
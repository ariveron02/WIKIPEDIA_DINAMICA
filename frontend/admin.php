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
    <title>Panel Admin - WikiAgora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white"> <div class="container mt-4">
        <nav class="navbar navbar-dark bg-dark rounded-pill shadow-sm px-4 py-2">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a class="navbar-brand p-0" href="#">
                    <img src="../fotos/wikiagora_blanco.png" alt="WikiAgora" height="30">
                </a>

                <div class="d-flex align-items-center">
                    <span class="navbar-text text-white fw-bold me-4 d-none d-md-block">
                        Panel de Administrador
                    </span>
                    <a href="cerrar_sesion.php" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                        Salir
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container mt-5">
        <div class="row mb-4 ps-2">
            <div class="col">
                <h2 class="display-6 fw-bold text-dark">Usuarios Registrados</h2>
                <p class="text-secondary">Gestión y control de cuentas activas</p>
            </div>
        </div>

        <div class="table-responsive border rounded-4 shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 ps-4 text-uppercase small fw-bold text-secondary">Nombre de Usuario</th>
                        <th class="py-3 text-uppercase small fw-bold text-secondary">Correo Electrónico</th>
                        <th class="py-3 pe-4 text-end text-uppercase small fw-bold text-secondary">Estado</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (mysqli_num_rows($resultado) > 0): ?>
                        <?php while($user = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td class="ps-4 fw-semibold text-dark"><?php echo htmlspecialchars($user['name']); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="pe-4 text-end">
                                <span class="badge rounded-pill bg-light text-dark border">Activo</span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted italic">No hay registros disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
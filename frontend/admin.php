<?php
// Incluimos la conexión
session_start();
require_once __DIR__ . '/../includes/conexion.php';

// Manejo de actualización de estado de peticiones (solo admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_peticion'], $_POST['estado_peticion'])) {
    $id_peticion = intval($_POST['id_peticion']);
    $estado = $_POST['estado_peticion'] === 'aceptada' ? 'aceptada' : 'rechazada';
    $conn->query("UPDATE peticiones SET estado='$estado' WHERE id_peticion=$id_peticion");
}

// Consulta para obtener usuarios
$sql = "SELECT id_user, name, email FROM usuarios";
$resultado = mysqli_query($conn, $sql);

// Consulta para obtener peticiones
$sql_pet = "SELECT p.id_peticion, p.texto_peticion, p.estado, p.created_at, 
                   u.name AS usuario, i.name_tabla AS articulo
            FROM peticiones p
            JOIN usuarios u ON p.id_user = u.id_user
            JOIN informacion i ON p.id_info = i.id_tabla
            ORDER BY p.created_at DESC";
$resultado_peticiones = mysqli_query($conn, $sql_pet);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - WikiAgora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body class="bg-white">
<div class="container mt-4">
    <nav class="navbar navbar-dark bg-dark rounded-pill shadow-sm px-4 py-2">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>
            <div class="d-flex align-items-center">
                <span class="navbar-text text-white fw-bold me-4 d-none d-md-block">Panel de Administrador</span>
                <a href="../backend/cerrar_sesion.php" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Salir</a>
            </div>
        </div>
    </nav>
</div>

<div class="container mt-5">
    <!-- Usuarios -->
    <div class="row mb-4 ps-2">
        <div class="col">
            <h2 class="display-6 fw-bold text-dark">Usuarios Registrados</h2>
            <p class="text-secondary">Gestión y control de cuentas activas</p>
        </div>
    </div>

    <div class="table-responsive border rounded-4 shadow-sm mb-5">
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

    <!-- Peticiones -->
    <div class="row mb-4 ps-2">
        <div class="col">
            <h2 class="display-6 fw-bold text-dark">Peticiones de Usuarios</h2>
            <p class="text-secondary">Revisión y gestión de solicitudes enviadas</p>
        </div>
    </div>

    <div class="table-responsive border rounded-4 shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="py-3 ps-4 text-uppercase small fw-bold text-secondary">Usuario</th>
                    <th class="py-3 text-uppercase small fw-bold text-secondary">Artículo</th>
                    <th class="py-3 text-uppercase small fw-bold text-secondary">Texto de Petición</th>
                    <th class="py-3 text-uppercase small fw-bold text-secondary">Estado</th>
                    <th class="py-3 pe-4 text-end text-uppercase small fw-bold text-secondary">Acciones</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php if (mysqli_num_rows($resultado_peticiones) > 0): ?>
                    <?php while($pet = mysqli_fetch_assoc($resultado_peticiones)): ?>
                    <tr>
                        <td class="ps-4 fw-semibold text-dark"><?php echo htmlspecialchars($pet['usuario']); ?></td>
                        <td class="text-dark"><?php echo htmlspecialchars($pet['articulo']); ?></td>
                        <td class="text-muted"><?php echo nl2br(htmlspecialchars($pet['texto_peticion'])); ?></td>
                        <td>
                            <?php 
                                if($pet['estado'] === 'pendiente') echo "<span class='badge bg-warning text-dark'>Pendiente</span>";
                                elseif($pet['estado'] === 'aceptada') echo "<span class='badge bg-success'>Aceptada</span>";
                                else echo "<span class='badge bg-danger'>Rechazada</span>";
                            ?>
                        </td>
                        <td class="pe-4 text-end">
                            <form method="POST" class="d-flex gap-2 justify-content-end">
                                <input type="hidden" name="id_peticion" value="<?php echo $pet['id_peticion']; ?>">
                                <button type="submit" name="estado_peticion" value="aceptada" class="btn btn-success btn-sm">Aceptar</button>
                                <button type="submit" name="estado_peticion" value="rechazada" class="btn btn-danger btn-sm">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted italic">No hay peticiones disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

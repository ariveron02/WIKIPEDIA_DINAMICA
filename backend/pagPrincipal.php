<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peticion_texto'], $_POST['peticion_info'])) {
    $id_user = $_SESSION['id_user'] ?? 0;
    $id_info = intval($_POST['peticion_info']);
    $texto = $conn->real_escape_string($_POST['peticion_texto']);

    if ($id_user > 0 && $texto !== '') {
        $conn->query("INSERT INTO peticiones (id_info, id_user, texto_peticion) VALUES ($id_info, $id_user, '$texto')");
        $mensaje = "Tu petición ha sido enviada correctamente.";
    } else {
        $mensaje = "No se pudo enviar la petición. Asegúrate de estar logueado y rellenar el campo.";
    }
}

$sql = "SELECT * FROM informacion ORDER BY created_at DESC";
$resultado = $conn->query($sql);

$articulos = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $articulos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiAgora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" type="image/png" href="../fotos/logowiki.png">
    <style>
        :target {
            border: 2px solid #0d6efd;
            padding: 10px;
            transition: all 0.5s;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContenido">
                <form class="d-flex me-3" onsubmit="buscarArticulo(event)">
                    <input id="buscador" class="form-control form-control-sm search-input" type="text" placeholder="Buscar artículo...">
                    <button class="btn btn-light btn-sm ms-2">Ir</button>
                </form>
                <a href="favoritos.php" class="btn btn-warning btn-sm rounded-pill px-3 me-2">Favoritos</a>
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

        <div class="card mb-4 p-3 shadow-sm">
            <h5>Agregar nuevo artículo</h5>
            <form id="formAgregarArticulo">
                <div class="mb-2">
                    <input type="text" class="form-control" name="titulo" placeholder="Título del artículo" required>
                </div>
                <div class="mb-2">
                    <textarea class="form-control" name="contenido" rows="3" placeholder="Contenido del artículo" required></textarea>
                </div>
                <div class="mb-2">
                    <input type="text" class="form-control" name="img" placeholder="URL de la imagen (opcional)">
                </div>
                <button type="submit" class="btn btn-success btn-sm">Añadir Artículo</button>
            </form>
            <div id="mensajeArticulo" class="mt-2"></div>
        </div>

        <?php if (!empty($articulos)): ?>
            <?php foreach ($articulos as $row): ?>
                <?php

                $id = 'articulo' . $row['id_tabla'];
                ?>
                <div class="card mb-5 shadow-sm p-3 position-relative articulo" id="<?php echo $id; ?>">

                    <?php if (!empty($row['img_tabla'])): ?>
                        <div class="float-end ms-3 mb-3" style="width: 300px;">
                            <div class="border rounded p-2 bg-light">
                                <img src="<?php echo htmlspecialchars($row['img_tabla']); ?>" alt="<?php echo htmlspecialchars($row['name_tabla']); ?>" class="img-fluid rounded w-100">
                            </div>
                        </div>
                    <?php endif; ?>

                    <h2 class="card-title"><?php echo htmlspecialchars($row['name_tabla']); ?></h2>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($row['info_tabla'])); ?></p>
                    <small class="text-muted">Publicado el <?php echo $row['created_at']; ?></small>

                    <div class="mt-2">
                        <button class="btn btn-warning btn-sm favorito-btn" data-id="<?php echo $row['id_tabla']; ?>">⭐ Favorito</button>
                        <span class="badge bg-secondary visitas" data-id="<?php echo $row['id_tabla']; ?>">0 visitas</span>
                    </div>

                    <div class="clearfix"></div>

                    <hr>
                    <h5>Enviar una petición sobre este artículo:</h5>
                    <?php if (isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
                    <form method="POST">
                        <input type="hidden" name="peticion_info" value="<?php echo $row['id_tabla']; ?>">
                        <div class="mb-3">
                            <textarea name="peticion_texto" class="form-control" rows="3" placeholder="Escribe tu petición aquí..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Enviar petición</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class='alert alert-info'>No hay artículos disponibles.</div>
        <?php endif; ?>

    </div>

    <div style="margin-top: 100px;"></div>
    <?php include '../includes/footer.php'; ?>


    <script>
        const articulos = <?php echo json_encode($articulos, JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <script src="../js/articulos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <!-- NAVBAR PRINCIPAL -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>

            <!-- Links, buscador y botones -->
            <div class="collapse navbar-collapse" id="navbarContenido">
                <!-- Menú de navegación -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Artículos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sobre nosotros</a></li>
                </ul>

                <!-- Buscador -->
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

<div class="container mt-5">

    <?php
    $sql = "SELECT * FROM informacion ORDER BY created_at DESC";
    $resultado = $conn->query($sql);

    if($resultado && $resultado->num_rows > 0){
        while($row = $resultado->fetch_assoc()){
    ?>
        <div class="card mb-5 shadow-sm p-3 position-relative">

            <!-- Imagen flotando a la derecha -->
            <?php if(!empty($row['img_tabla'])): ?>
            <div class="float-end ms-3 mb-3" style="width: 300px;">
                <div class="border rounded p-2 bg-light">
                    <img src="<?php echo htmlspecialchars($row['img_tabla']); ?>" 
                         alt="<?php echo htmlspecialchars($row['name_tabla']); ?>" 
                         class="img-fluid rounded w-100">
                </div>
            </div>
            <?php endif; ?>

            <!-- Texto del artículo -->
            <h2 class="card-title"><?php echo htmlspecialchars($row['name_tabla']); ?></h2>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($row['info_tabla'])); ?></p>
            <small class="text-muted">Publicado el <?php echo $row['created_at']; ?></small>

            <div class="clearfix"></div>
        </div>
    <?php
        }
    } else {
        echo "<div class='alert alert-info'>No hay artículos disponibles.</div>";
    }
    ?>

</div>



    <div style="margin-top: 100px;"></div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
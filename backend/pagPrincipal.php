<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';

// Manejo del envío de peticiones
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peticion_texto'], $_POST['peticion_info'])) {
    $id_user = $_SESSION['id_user'] ?? 0; // asegúrate de tener el id del usuario en sesión
    $id_info = intval($_POST['peticion_info']);
    $texto = $conn->real_escape_string($_POST['peticion_texto']);

    if($id_user > 0 && $texto !== ''){
        $conn->query("INSERT INTO peticiones (id_info, id_user, texto_peticion) VALUES ($id_info, $id_user, '$texto')");
        $mensaje = "Tu petición ha sido enviada correctamente.";
    } else {
        $mensaje = "No se pudo enviar la petición. Asegúrate de estar logueado y rellenar el campo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiAgora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <style>
        :target { border: 2px solid #0d6efd; padding: 10px; transition: all 0.5s; }
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
                <form class="d-flex me-3" onsubmit="location.href='#' + this.q.value.toLowerCase(); return false;">
                    <input name="q" class="form-control form-control-sm search-input" type="text" placeholder="Buscar por id...">
                    <button class="btn btn-light btn-sm ms-2" type="submit">Ir</button>
                </form>

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

<?php
$sql = "SELECT * FROM informacion ORDER BY created_at DESC";
$resultado = $conn->query($sql);

if($resultado && $resultado->num_rows > 0){
    while($row = $resultado->fetch_assoc()){
        switch($row['name_tabla']){
            case 'Imperio Solar de Aethernia': $id='artenia'; break;
            case 'La Revolución Digital Global': $id='digital'; break;
            case 'Biblioteca Subterránea de Valdris': $id='biblio'; break;
            case 'Teoría del Horizonte Infinito': $id='universo'; break;
            case 'Federación Interestelar de Orion': $id='orion'; break;
            case 'Reino de España': $id='espana'; break;
            case 'La Antigua Grecia y la Democracia': $id='grecia'; break;
            case 'La Revolución Francesa': $id='francia'; break;
            case 'El Imperio Romano': $id='roma'; break;
            case 'Concepto de Estado y Nación': $id='estado'; break;
            case 'La Ruta de la Seda': $id='ruta'; break;
            default: $id='articulo'.$row['id_tabla']; break;
        }
?>
<div class="card mb-5 shadow-sm p-3 position-relative" id="<?php echo $id; ?>">
    <?php if(!empty($row['img_tabla'])): ?>
    <div class="float-end ms-3 mb-3" style="width: 300px;">
        <div class="border rounded p-2 bg-light">
            <img src="<?php echo htmlspecialchars($row['img_tabla']); ?>" alt="<?php echo htmlspecialchars($row['name_tabla']); ?>" class="img-fluid rounded w-100">
        </div>
    </div>
    <?php endif; ?>
    <h2 class="card-title"><?php echo htmlspecialchars($row['name_tabla']); ?></h2>
    <p class="card-text"><?php echo nl2br(htmlspecialchars($row['info_tabla'])); ?></p>
    <small class="text-muted">Publicado el <?php echo $row['created_at']; ?></small>
    <div class="clearfix"></div>

    <!-- Formulario de peticiones -->
    <hr>
    <h5>Enviar una petición sobre este artículo:</h5>
    <?php if(isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
    <form method="POST">
        <input type="hidden" name="peticion_info" value="<?php echo $row['id_tabla']; ?>">
        <div class="mb-3">
            <textarea name="peticion_texto" class="form-control" rows="3" placeholder="Escribe tu petición aquí..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Enviar petición</button>
    </form>
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

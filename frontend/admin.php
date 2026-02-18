<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';

// Manejo de envío de peticiones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Enviar nueva petición
    if (isset($_POST['peticion_texto'], $_POST['peticion_info'])) {
        $id_user = $_SESSION['id_user'] ?? 0; 
        $id_info = intval($_POST['peticion_info']);
        $texto = $conn->real_escape_string($_POST['peticion_texto']);

        if($id_user > 0 && $texto !== ''){
            $conn->query("INSERT INTO peticiones (id_info, id_user, texto_peticion) VALUES ($id_info, $id_user, '$texto')");
            $mensaje = "Tu petición ha sido enviada correctamente.";
        } else {
            $mensaje = "No se pudo enviar la petición. Asegúrate de estar logueado y rellenar el campo.";
        }
    }

    // Cambiar estado de petición (solo admin)
    if (isset($_POST['estado_peticion'], $_POST['id_peticion']) && $_SESSION['rol'] === 'admin') {
        $estado = $_POST['estado_peticion'] === 'aceptada' ? 'aceptada' : 'rechazada';
        $id_peticion = intval($_POST['id_peticion']);
        $conn->query("UPDATE peticiones SET estado='$estado' WHERE id_peticion=$id_peticion");
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
        <a class="navbar-brand d-flex align-items-center" href="#"><div class="logo-box me-2">W</div><span class="fw-bold">WikiÁgora</span></a>
        <div class="collapse navbar-collapse" id="navbarContenido">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Artículos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Sobre nosotros</a></li>
            </ul>

            <form class="d-flex me-3" onsubmit="location.href='#' + this.q.value.toLowerCase(); return false;">
                <input name="q" class="form-control form-control-sm search-input" type="text" placeholder="Buscar por id (ej: orion, artenia...)">
                <button class="btn btn-light btn-sm ms-2" type="submit">Ir</button>
            </form>

            <p class="text-white mb-0 me-3">Bienvenido, <b><?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Usuario'; ?></b></p>
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
        switch($row['name_tabla']){
            case 'Imperio Solar de Aethernia': $id='artenia'; break;
            case 'La Revolución Digital Global': $id='digital'; break;
            case 'Biblioteca Subterránea de Valdris': $id='biblio'; break;
            case 'Teoría del Horizonte Infinito': $id='universo'; break;
            case 'Federación Interestelar de Orion': $id='orion'; break;
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

    <!-- Formulario de nueva petición -->
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

    <!-- Mostrar peticiones existentes -->
    <hr>
    <h5>Peticiones recibidas:</h5>
    <?php
    $id_info = $row['id_tabla'];
    $peticiones = $conn->query("SELECT p.*, u.name FROM peticiones p JOIN usuarios u ON p.id_user = u.id_user WHERE p.id_info=$id_info ORDER BY p.created_at DESC");
    if($peticiones && $peticiones->num_rows > 0){
        while($pet = $peticiones->fetch_assoc()){
            echo "<div class='border rounded p-2 mb-2'>";
            echo "<strong>Usuario:</strong> ".htmlspecialchars($pet['name'])."<br>";
            echo "<strong>Texto:</strong> ".nl2br(htmlspecialchars($pet['texto_peticion']))."<br>";
            echo "<strong>Estado:</strong> ".htmlspecialchars($pet['estado'])."<br>";
            echo "<small class='text-muted'>Creado: ".$pet['created_at']."</small>";

            // Si es admin, mostrar botones para cambiar estado
            if($_SESSION['rol'] === 'admin'){
                echo "<form method='POST' class='mt-1 d-flex gap-2'>";
                echo "<input type='hidden' name='id_peticion' value='".$pet['id_peticion']."'>";
                echo "<button type='submit' name='estado_peticion' value='aceptada' class='btn btn-success btn-sm'>Aceptar</button>";
                echo "<button type='submit' name='estado_peticion' value='rechazada' class='btn btn-danger btn-sm'>Rechazar</button>";
                echo "</form>";
            }

            echo "</div>";
        }
    } else {
        echo "<div class='text-muted'>No hay peticiones para este artículo.</div>";
    }
    ?>

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

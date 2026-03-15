<?php
$error = $_GET['error'] ?? 0; // Recibir código de error desde procesarRegistro.php
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wikipedia - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

    <!-- NAVBAR PRINCIPAL -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>
        </div>
    </nav>

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh; margin-top: 30px;">
        <div class="row w-100 align-items-center justify-content-center">

            <div class="col-md-5 d-flex justify-content-center mb-5 mb-md-0">
                <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px; border-radius: 15px;">
                    <h2 class="card-title text-center mb-4">Crear Cuenta</h2>

                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2 small">
                            <?php
                            switch ($error) {
                                case 1:
                                    echo "Datos inválidos. Revisa los campos.";
                                    break;
                                case 2:
                                    echo "Este correo ya está registrado.";
                                    break;
                                case 3:
                                    echo "Error interno al registrar el usuario.";
                                    break;
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <form action="../backend/procesarRegistro.php" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre de usuario</label>
                            <input type="text" class="form-control" id="nombre" name="name" placeholder="Nombre Usuario" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Crear Cuenta</button>
                        </div>
                    </form>

                    <p class="text-center mt-3 mb-0 small">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
                </div>
            </div>

            <div class="col-md-5 d-flex justify-content-center">
                <div class="border border-2 border-warning rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                    <div class="logo-box m-0 fs-1 fw-bold">W</div>
                </div>
            </div>

        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>
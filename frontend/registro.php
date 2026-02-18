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
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>
        </div>
    </nav>

    <!-- Formulario centrado -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px; border-radius: 15px;">
            <h2 class="card-title text-center mb-4">Crear Cuenta</h2>

            <!-- Errores -->
            <?php if ($error): ?>
                <div class="alert alert-danger">
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

            <!-- Formulario -->
            <form action="../backend/procesarRegistro.php" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" id="nombre" name="name" placeholder="Nombre Usuario" required>
                    <div class="invalid-feedback">
                        Ingresa tu nombre de usuario.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                    <div class="invalid-feedback">
                        Ingresa un correo válido.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                    <div class="invalid-feedback">
                        Ingresa una contraseña (mínimo 6 caracteres).
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Crear Cuenta</button>
            </form>

            <p class="text-center mt-3 mb-0">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <!-- NAVBAR PRINCIPAL -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <div class="logo-box me-2">W</div>
                <span class="fw-bold">WikiÁgora</span>
            </a>
    </nav>

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="row w-100 align-items-center justify-content-center">
        
            <div class="col-md-5 d-flex justify-content-center mb-5 mb-md-0">
                <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
                    <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>

                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger text-center py-2 small">
                            Correo o contraseña incorrectos.
                        </div>
                    <?php endif; ?>

                    <form action="../backend/procesarLogin.php" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                    </form>

                    <p class="text-center mt-3 mb-0 small">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
                </div>
            </div>

            <div class="col-md-5 d-flex justify-content-center">
                <div class="border border-2 border-warning rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                    <div class="logo-box m-0 fs-1 fw-bold">W</div>
                </div>
            </div>

        </div>
    </div>

    <!-- Validación Bootstrap -->
    <script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../includes/footer.php'; ?>
</body>
</html>

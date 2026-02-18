<?php
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="../css/.css"> -->
</head>
<body>

    <div class="login-container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">Iniciar Sesión</h4>
            </div>
            
            <div class="card-body p-4">

                <!-- 🔥 MENSAJE DE ERROR -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center">
                        Correo o contraseña incorrectos.
                    </div>
                <?php endif; ?>

                <form action="../backend/procesarLogin.php" method="POST" class="needs-validation" novalidate>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
                        <div class="invalid-feedback">Por favor, ingresa un correo válido.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        <div class="invalid-feedback">La contraseña es obligatoria.</div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                    
                </form> <!-- 🔥 FALTABA ESTO -->

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

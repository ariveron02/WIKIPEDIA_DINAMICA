<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        header("Location: ../frontend/login.php?error=1");
        exit();
    }

    $sql = "SELECT id_user, name, rol, password FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en prepare: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario['password'])) {
            $_SESSION['id_user'] = $usuario['id_user'];
            $_SESSION['name'] = $usuario['name'];
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['login'] = true;

            if ($usuario['rol'] === 'admin') {
                header("Location: ../frontend/admin.php");
            } else {
                header("Location: ../pagPrincipal.php");
            }
            exit();
        }
    }

    // Si algo falla, redirigimos al login con error
    header("Location: ../frontend/login.php?error=1");
    exit();
}
?>

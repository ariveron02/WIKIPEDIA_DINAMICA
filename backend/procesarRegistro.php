<?php
require_once __DIR__  . "/../includes/conexion.php";

if (!isset($conn)) {
    die("Error: No se está cargando la conexión.");
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validaciones básicas
$errors = [];

if (empty($name)) {
    $errors[] = "El nombre es obligatorio.";
} elseif (strlen($name) > 25) {
    $errors[] = "El nombre no puede superar 25 caracteres.";
}

if (empty($email)) {
    $errors[] = "El email es obligatorio.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El email no es válido.";
}

if (empty($password)) {
    $errors[] = "La contraseña es obligatoria.";
} elseif (strlen($password) < 6) {
    $errors[] = "La contraseña debe tener al menos 6 caracteres.";
}

// Comprobar si el email ya existe
if (empty($errors)) {
    $stmt = $conn->prepare("SELECT id_user FROM usuarios WHERE email = ?");
    if (!$stmt) die("Error en prepare: " . $conn->error);

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errors[] = "El email ya está registrado.";
    }
    $stmt->close();
}

// Insertar usuario si no hay errores
if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (name, email, password) VALUES (?, ?, ?)");
    if (!$stmt) die("Error en prepare: " . $conn->error);

    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        header("Location: pagPrincipal.php");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Mostrar errores
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}

$conn->close();

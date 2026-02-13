<?php
session_start();
$_SESSION = [];
session_destroy();
setcookie('usuario', '', time() - 3600, "/"); 
header("Location: ../src/index.php");
exit;
?>

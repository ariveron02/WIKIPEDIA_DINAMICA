<?php
$host = "db"; 
$dbname = "wikipedia_dinamica"; 
$user = "adminWikipedia"; 
$pass = "admin123";    

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>
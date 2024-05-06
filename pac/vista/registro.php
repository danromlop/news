<?php 
require "../controlador/controlador.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    insertUsuario();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro nuevos usuarios</title>
</head>
<body>
    <h1>Registro nuevos usuarios</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="nombre" id="nombre" name="nombre" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Registrarse">
    </form>
    <button><a  href="index.php">Volver a Inicio</a></button>
</body>
</html> 
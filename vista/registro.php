<?php 

require "../controlador/controlador.php";
include "header.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){

    if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password']) ){
        insertUsuario();
    }
    
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
    <div class="noticia w60">
        <h1 >Registro nuevos usuarios</h1>
        <form class="form-registro"   method="POST">
            <div class="form-datos">
                <div class="form-entrada">
                    <label for="nombre">Nombre:</label>
                    <input type="nombre" id="nombre" name="nombre" required>
                </div>
                <div class="form-entrada">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-entrada">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>
            <input class="boton" type="submit" value="Registrarse">
            
        </form>
        
    </div>
    <div class="crear-container flex-end">
    <button class="boton editar blanco novisited " ><a  href="index.php">Volver a Inicio</a></button>
    </div>
</body>
</html> 
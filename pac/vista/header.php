<?php 

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['email']) && isset($_POST['password'])) {
        loginUsuario();
    } elseif (isset($_POST['logout'])) {
        logoutUsuario();
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- fin codigo php-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitio de noticias</title>

    <!-- archivos css -->
   
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="header">
        <div class="header-barra">
            <div class="header-logo">
                <h1>Sitio de noticias</h1>
            </div>

            <div class="header-login">
                <?php if (!isset($_SESSION['usuario'])) { // Mostrar el formulario solo si el usuario no ha iniciado sesión ?>
                        <div class="login-form">
                            <form method="POST">
                                
                                <input type="email" id="email" name="email" required placeholder="Email">
                                
                                <input type="password" id="password" name="password" required placeholder="Contraseña">
                                <input class="boton" type="submit" value="Iniciar Sesión">
                            </form>
                        </div>

                        <div class="registro">
                            <button class="registro-button boton"><a href="registro.php">Registrarse</a></button>
                        </div>

                    <?php } else { // Mostrar el nombre del usuario y el botón de deslogear ?>
                        <div class="user-login">
                            <p>Bienvenido, <?php echo $_SESSION['usuario']; ?></p>
                            <form method="POST">
                                <input class="boton" type="submit" name="logout" value="Desconectar">
                            </form>
                        </div>
                    <?php } ?>
            </div>

            <!-- ! login -->
        </div>
    </header>
<?php 

if(!isset($_SESSION)){
    session_start();
}

if($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $login = loginUsuario();
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
   
    <link rel="stylesheet" href="../css/styles.css?v=1">
</head>
<body>



    <header class="header">
   

  

        <div class="header-barra">

        <div class="header-main">
            <div class="mobile-menu">
                    <img src="../img/hamburger-menu.svg">
                </div>
                <div class="header-logo">
                    <a class="header-logo" href="index.php">
                    <img src="../img/news.svg">
            
                    <h1>The News</h1>
                    </a>
                </div>
        </div>

            <div class="header-login">
                <?php if (!isset($_SESSION['usuario'])) { // Mostrar el formulario solo si el usuario no ha iniciado sesión ?>
                        <div >
                            <form class="login-form" method="POST">
                                
                                <input type="email" id="email" name="email" required placeholder="Email">
                                
                                <input type="password" id="password" name="password" required placeholder="Contraseña">
                                <div class="login-form-botones">
                                    <input class="boton" type="submit" value="Iniciar Sesión">
                                    <button class="registro-button boton" onclick="window.location.href='registro.php'">Registrarse</button>
                                </div>
                                
                            </form>
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

        
      

        <script src="../js/script.js"></script>
    </header>
     <!-- Espacio para mensajes de error al login -->
    <?php if (!empty($login) && ($login != 1)){ ?>
    <div class="fondo-main">
        <div class="alerta error ">
           <?php
        
            echo $login ;
           ?>
            </div>
    </div> 

        <?php   }; ?>
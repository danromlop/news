
<?php 
        require "../controlador/controlador.php";
        $id = $_GET["id"];
       $noticia = mostrarNoticia($id);
    
        include "header.php";
    ?>
    
    <hr>
    <h1><?php echo $noticia['titulo']; ?></h1>
    
    <p>Fecha de publicación: <?php echo $noticia['fecha']; ?></p>
    <p>Autor: <?php echo mostrarUsuario($noticia["id_autor"]); ?></p>

    <p><?php echo $noticia['cuerpo']; ?></p>

    <button><a  href="index.php">Volver a Inicio</a></button>
</body>
</html>
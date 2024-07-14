
<?php 

        require "../controlador/controlador.php";
        $id = $_GET["id"];
       $noticia = mostrarNoticia($id);
    
        include "header.php";

       
    ?>
    
        <main class="noticia-main">
    
    
                <div class="noticia w60">
                    <h1 class="titulo-noticia"><?php echo $noticia['titulo']; ?></h1>
    
    
                    <p class="descripcion-noticia"><?php echo nl2br($noticia['cuerpo']); ?></p>
                    <p class="detalle-noticia">Fecha de publicación: <?php echo $noticia['fecha']; ?></p>
                    <p class="detalle-noticia">Autor: <?php echo mostrarUsuario($noticia["id_autor"]); ?></p>
    
                    <button class="boton editar blanco novisited"  onclick="window.location.href='index.php'">Volver a Inicio</button>
                </div>
        </main>
        
        <?php
            include "footer.php";
        ?>
    
</body>
</html>
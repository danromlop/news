
    <!-- codigo PHP -->
    <?php 
        require "../controlador/controlador.php";


        //autentificacion
        session_start();

        $auth = $_SESSION['id'];
        
        if(!$auth){
             header("Location: index.php");
         };

         //Ejecuta el código después de que el usuario envía el formulario

        $id = $_GET["id"];
        //recuperamos noticia a editar
        $noticia = mostrarNoticia($id);

         //Array con mensajes de errores
         $errores = [];

         $titulo = "";
         $fecha = "";
         $cuerpo = "";
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $errores = updateNoticia($id);;

            $titulo = $_POST['titulo'];
            $cuerpo = $_POST['cuerpo'];
            $fecha = $_POST['fecha']; 
        }

        include "header.php";
    ?>
     <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>
        
           
        <?php endforeach; ?>

    

    <div class="formulario-crear w60">
    <h1>Editar noticia</h1>


   
        <form method="POST" >
            <label for="titulo">Título:</label>
            <input id="titulo" name="titulo" type="text" value="<?php echo $noticia["titulo"] ?>">
            <br>
            <br>
            <label for="fecha">Fecha:</label>
            <input id="fecha" name="fecha" type="date" value="<?php echo $noticia["fecha"] ?>">
            <br>
            <br>
            <label for="cuerpo">Cuerpo de noticia:</label>
            <br>
            <textarea id="cuerpo" name="cuerpo" rows="20" cols="120"><?php echo $noticia["cuerpo"]?></textarea>
            <br>
            <input class="boton" type="submit" value="Editar noticia">
        </form>
    </div>

    
    <?php
        include "footer.php";
    ?>
    
</body>
</html>
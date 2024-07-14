
    <!-- codigo PHP -->
    <?php 
        
        require "../controlador/controlador.php";
        include "header.php";

        
        //autentificacion
        $auth = $_SESSION['id'];
        
        if(!$auth){
             header("Location: index.php");
         };

       

        //Array con mensajes de errores
        $errores = [];

        $titulo = "";
        $fecha = "";
        $cuerpo = "";
        
         //Ejecuta el código después de que el usuario envía el formulario
        $id_usuario = $_SESSION["id"]; //obtenemos id usuario para insertar la noticia
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $errores = insertNoticia($id_usuario);

            $titulo = $_POST['titulo'];
            $cuerpo = $_POST['cuerpo'];
            $fecha = $_POST['fecha']; 
    

        }

    ?>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>    
        <?php endforeach; ?>
 
    <div class="formulario-crear w60">
        <h1>Nueva noticia</h1>
        <form method="POST" action="crear.php">
            <label for="titulo">Título:</label>
            <input id="titulo" name="titulo" type="text" value="<?php echo $titulo; ?>">
            <br>
            <br>
            <label for="fecha">Fecha:</label>
            <input id="fecha" name="fecha" type="date"  value="<?php echo $fecha; ?>">
            <br>
            <br>
            <label for="cuerpo">Cuerpo de noticia:</label>
            <br>
            <textarea id="cuerpo" name="cuerpo" rows="20" cols="120" ><?php echo $cuerpo; ?></textarea>
            <br>
            <input class="boton" type="submit" value="Añadir noticia">
        </form>
    </div>

    
    <?php
        include "footer.php";
    ?>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- codigo PHP -->
    <?php 
        require "../controlador/controlador.php";

         //Ejecuta el código después de que el usuario envía el formulario

        $id = $_GET["id"];
        //recuperamos noticia a editar
        $noticia = mostrarNoticia($id);
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            updateNoticia($id);
        }
    
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear noticia</title>
</head>
<body>
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
        <textarea id="cuerpo" name="cuerpo" rows="20" cols="120"> <?php echo $noticia["cuerpo"] ?></textarea>
        <br>
        <input type="submit" value="Editar noticia">

    </form>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- codigo PHP -->
    <?php 
        require "../controlador/controlador.php";
        session_start(); //mantenemos inicio de sesion usuario
         //Ejecuta el código después de que el usuario envía el formulario
        $id_usuario = $_SESSION["id"]; //obtenemos id usuario para insertar la noticia
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            insertNoticia($id_usuario);
        }
    
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear noticia</title>
</head>
<body>
    <h1>Nueva noticia</h1>

    <form method="POST" action="crear.php">
        <label for="titulo">Título:</label>
        <input id="titulo" name="titulo" type="text">
        <br>
        <br>
        <label for="fecha">Fecha:</label>
        <input id="fecha" name="fecha" type="date"> 
        <br>
        <br>
        <label for="cuerpo">Cuerpo de noticia:</label>
        <br>
        <textarea id="cuerpo" name="cuerpo" rows="20" cols="120"></textarea>
        <br>
        <input type="submit" value="Añadir noticia">

    </form>
    
</body>
</html>
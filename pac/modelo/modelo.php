<?php 

require_once("datos_conexion.php");

function crearConexion(){
    //usamos las constantes predefinidas en datos_conexion.php para establecer la conexion con la bbdd
    $conexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    //en caso de error lo notificamos y detenemos el proceso
    if(!$conexion){
        die("<br>Error de conexión con la base de datos: " . mysqli_connect_error());
    }
    //si está correcto, devolvemos la conexión con la bbdd
    else{
        //echo "Conexion establecida";
        return $conexion;
    }
    

}

//función para cerrar la conexión con la bbdd
function cerrarConexion($conexion){
    mysqli_close($conexion);
}

// FUNCIONES CRUD

// READ - LEER


function getListaNoticias($orderBy, $orderDir){

    //abrimos conexión
    $db = crearConexion();

    //posibles opciones con las que ordenar el SELECT
    $orderByOptions = array("titulo", "fecha", "id_autor"); 
     
    if (!in_array($orderBy, $orderByOptions)) {
        //Si el valor de orderBy no es válido o no está predefinido, utilizamos un valor predeterminado (en este caso, "titulo")
        $orderBy = "titulo";
        
    }
    //generamos la consulta sql según lo solicitado en el index.php
    //al ser una JOIN, he preferido añadir un segundo condicional para simplificar en caso de que haya que ordenar por usuario
    if ($orderBy == $orderByOptions[2]){
        
        $sql = "SELECT noticia.*, usuario.nombre AS nombre_autor
        FROM noticia
        JOIN usuario ON noticia.id_autor = usuario.id
        ORDER BY usuario.nombre $orderDir;";
        
    } else{
        $sql = "SELECT noticia.*, usuario.nombre AS nombre_autor
        FROM noticia
        JOIN usuario ON noticia.id_autor = usuario.id
        ORDER BY $orderBy $orderDir;";
    }
    
    $stmt = $db->prepare($sql);
    if ($stmt === false) {
        //Manejo de errores si la preparación de la consulta falla
        error_log('MySQL prepare statement failed: ' . $db->error);
        cerrarConexion($db);
        return false;
    }

    //Ejecutar la consulta preparada
    $stmt->execute();

    //Obtener resultados
    $result = $stmt->get_result();

   if($result->num_rows > 0){
    
       return $result; //devolvemos resultado de consulta a la función controlador
   } else{
       echo "No hay nada en la tabla noticia";
   }
    $stmt->close();
    cerrarConexion($db);

}

//función para obtener nombre de usuario
function getUsuario($id){

    $db = crearConexion();

    $sql = "SELECT nombre FROM usuario WHERE id = ?";

    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($db);
        cerrarConexion($db);
        return false;
    }

    $stmt->bind_param("i", $id);

    $stmt->execute();
    
    $result = $stmt->get_result();
 
    if(mysqli_num_rows($result) > 0){

        return $result;
    } else{
        echo "No hay nada en la tabla usuario";
    }
 
     $stmt->close();
     cerrarConexion($db);

}

//función para obtener los datos de una noticia en concreto
function getNoticia($id){

    $db = crearConexion();

    $sql = "SELECT * FROM noticia WHERE id = ?";
 
    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($db);
        cerrarConexion($db);
        return false;
    }

    $stmt->bind_param("i", $id);

    $stmt->execute();
    
    $result = $stmt->get_result();
 
    if(mysqli_num_rows($result) > 0){
         

        return $result;
    } else{
        echo "Noticia con id " . $id . "no encontrada";
    }
 
    cerrarConexion($db);

}



// CREATE - CREAR 


function crearNoticia($id_autor, $titulo, $cuerpo, $fecha){
    
    $db = crearConexion();
    
    //realizamos el INSERT INTO para añadir la noticia a la BBDD
    $sql = "INSERT INTO noticia (id_autor, titulo, cuerpo, fecha) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($db);
        cerrarConexion($db);
        return false;
    }

    $stmt->bind_param("isss", $id_autor, $titulo, $cuerpo, $fecha);

    $resultado = $stmt->execute();
   
    if($resultado){
        //Rediccionaremos al usuario a la pagina principal al crear la noticia

         header("Location: index.php");
    } else if(!$resultado){
        echo "Error al realizar la consulta" . mysqli_error($db);
    }

    cerrarConexion($db);
}


// UPDATE - ACTUALIZAR 

function actualizarNoticia($id, $titulo, $cuerpo, $fecha){
    $db = crearConexion();
    
    $sql = "UPDATE noticia SET titulo=?, cuerpo=?, fecha=? WHERE id=?";

    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($db);
        cerrarConexion($db);
        return false;
    }

    $stmt->bind_param("sssi", $titulo, $cuerpo, $fecha, $id);

    $resultado = $stmt->execute();

    if($resultado){
        //Rediccionaremos al usuario a la pagina principal al crear la noticia

        header("Location: index.php");
    } else if(!$resultado){
        echo "Error al realizar la consulta" . mysqli_error($db);
    }

    cerrarConexion($db);
}



// DELETE - ELIMINAR 

function eliminarNoticia($id){

    $db = crearConexion();

    $sql = "DELETE FROM noticia WHERE id = ?;";

    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($db);
        cerrarConexion($db);
        return false;
    }

    $stmt->bind_param("i", $id);

    $resultado = $stmt->execute();

    if($resultado){
        //Rediccionaremos al usuario a la pagina principal al crear la noticia

        header("Location: index.php");
    } else if(!$resultado){
        echo "Error al eliminar la noticia" . mysqli_error($db);
    }

    cerrarConexion($db);

}

// GESTION USUARIOS

//  CREAR USUARIO
function crearUsuario($nombre, $email, $contrasena){

    $db = crearConexion();
    
    
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO usuario (nombre, email, contrasena) VALUES (?, ?, ?)";

   
    $stmt = $db->prepare($sql);
    if ($stmt === false) {
        //Manejo de errores
        error_log('MySQL prepare statement failed: ' . $db->error);
        echo "Error en la preparación de la consulta.";
        cerrarConexion($db);
        return false;
    }

  
    $stmt->bind_param('sss', $nombre, $email, $hashedPassword);

   
    if ($stmt->execute()) {
        //Redirigimos al usuario a la página principal en caso de éxito
        header("Location: index.php");
        exit(); // Asegura que el script se detenga después de redirigir
    } else {
        // Manejo de errores 
        error_log('MySQL execute statement failed: ' . $stmt->error);
        echo "Error al realizar la consulta: " . $stmt->error;
    }

    //cerramos stmt y conexion a bbdd
    $stmt->close();

  
    cerrarConexion($db);

    return true;
}

// AUTENTICAR USUARIO

function autenticarUsuario($email){

    $db = crearConexion();

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $db->prepare($sql);
    if ($stmt === false) {
        
        error_log('MySQL prepare statement failed: ' . $db->error);
        return false;
    }

    //vinculamos el marcador ? con el email en la consulta sql
     $stmt->bind_param('s', $email);

   
    if (!$stmt->execute()) {
        
        error_log('MySQL execute statement failed: ' . $stmt->error);
        return false;
    }

   
    $resultado = $stmt->get_result();
    
    $usuarioLogin = $resultado->fetch_assoc();

    //cerramos stmt y conexion a bbdd
    $stmt->close();

    cerrarConexion($db);

    //verificacion email
    if ($usuarioLogin) {
        return $usuarioLogin;
    } else {
        return false;
    }

}

?>
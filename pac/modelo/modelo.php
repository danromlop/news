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
    
   $result = mysqli_query($db, $sql);

   if(mysqli_num_rows($result) > 0){
       return $result; //devolvemos resultado de consulta a la función controlador
   } else{
       echo "No hay nada en la tabla noticia";
   }

    cerrarConexion($db);

}

//función para obtener nombre de usuario
function getUsuario($id){

    $db = crearConexion();

    $sql = "SELECT nombre FROM usuario WHERE id = $id";
 
    $result = mysqli_query($db, $sql);
 
    if(mysqli_num_rows($result) > 0){
        return $result;
    } else{
        echo "No hay nada en la tabla usuario";
    }
 
     cerrarConexion($db);

}

//función para obtener los datos de una noticia en concreto
function getNoticia($id){

    $db = crearConexion();

    $sql = "SELECT * FROM noticia WHERE id = $id";
 
    $result = mysqli_query($db, $sql);
 
    if(mysqli_num_rows($result) > 0){
         

        return $result;
    } else{
        echo "Noticia con id " . $id . "no encontrada";
    }
 
    cerrarConexion($db);

}



// --------------------------- CREAR NOTICIA --------------------

function crearNoticia($id_autor, $titulo, $cuerpo, $fecha){
    
    $db = crearConexion();

    //realizamos el INSERT INTO para añadir la noticia a la BBDD
    $sql = "INSERT INTO noticia (id_autor, titulo, cuerpo, fecha) VALUES ('$id_autor', '$titulo', '$cuerpo', '$fecha')";

    $resultado = mysqli_query($db, $sql);

    if($resultado){
        //Rediccionaremos al usuario a la pagina principal al crear la noticia

        header("Location: index.php");
    } else if(!$resultado){
        echo "Error al realizar la consulta" . mysqli_error($db);
    }

    cerrarConexion($db);
}


//------------ ACTUALIZAR NOTICIA

function actualizarNoticia($id, $titulo, $cuerpo, $fecha){
    $db = crearConexion();
    
    $sql = "UPDATE noticia SET titulo='$titulo', cuerpo='$cuerpo', fecha='$fecha' WHERE id='$id'";

    $resultado = mysqli_query($db, $sql);

    if($resultado){
        //Rediccionaremos al usuario a la pagina principal al crear la noticia

        header("Location: index.php");
    } else if(!$resultado){
        echo "Error al realizar la consulta" . mysqli_error($db);
    }

    cerrarConexion($db);
}



//---------------------- ELIMINAR NOTICIA

function eliminarNoticia($id){

    $db = crearConexion();

    $sql = "DELETE FROM noticia WHERE id = $id;";

    $resultado = mysqli_query($db, $sql);

    if($resultado){
        //Rediccionaremos al usuario a la pagina principal al crear la noticia

        header("Location: index.php");
    } else if(!$resultado){
        echo "Error al eliminar la noticia" . mysqli_error($db);
    }

    cerrarConexion($db);

}

// ------------------ CREAR USUARIO
function crearUsuario($nombre, $email, $contrasena){
    
    $db = crearConexion();


    $sql = "INSERT INTO usuario (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";

    $resultado = mysqli_query($db, $sql);

    if($resultado){
        //Rediccionaremos al usuario a la pagina principal al crear la noticia

        header("Location: index.php");
    } else if(!$resultado){
        echo "Error al realizar la consulta" . mysqli_error($db);
    }

    cerrarConexion($db);
}

//--------------- AUTENTICAR USUARIO

function autenticarUsuario($email){

    $db = crearConexion();

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($db, $sql);

    $usuarioLogin = mysqli_fetch_assoc($resultado);
    // Verificar si se encontró un usuario con el email dado
    if ($usuarioLogin) {

        return $usuarioLogin;

    }else{
        echo "Usuario no encontrado";
    }

    cerrarConexion($db);


}

?>
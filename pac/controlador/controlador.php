<?php

include "../modelo/modelo.php";

// FUNCIONES CRUD

// READ - LEER


function showListaNoticias($orderBy, $orderDir){
    //obtiene el valor del formulario para ordenar las noticias
    if (isset($_POST['orderBy'])) {
        $orderBy = $_POST['orderBy'];
        $orderDir = $_POST['orderDir'];
    } 

    $datos = getListaNoticias($orderBy, $orderDir);

    if (is_string($datos)) { //en caso de error, lo muestra
        echo $datos;
    } else {
        while ($fila = mysqli_fetch_assoc($datos)) { //introducimos en la tabla una línea por noticia
    ?>
            <div class="noticia">
                <h3 class="titulo-noticia novisited"><a  href="noticia.php?id=<?= $fila["id"] ?>"><?= $fila["titulo"] ?></a></h3>
                <p class="noticia-cuerpo"><?=  substr($fila["cuerpo"], 0, 200); ?>... <a class="leer-mas" href="noticia.php?id=<?= $fila["id"] ?>">Leer Más</a></p>

                <hr>
                <p class="info-noticia"><span class="bold">Publicada el: </span><?= $fila["fecha"] ?> | <span class="bold">Autor: </span><span class="autor bold"><?= $fila["nombre_autor"] ?></span></p>
                <!-- botones solo para registrados y logeados -->
                <?php
                if (isset($_SESSION['usuario'])) { ?>
                <div class="botones-usuario">

                <button class="boton editar blanco" onclick="window.location.href='editar.php?id=<?= $fila["id"] ?>'">Editar</button>
                    
                        <!-- form para enviar la solicitud de eliminar noticia -->
                        <form method="POST">
                            <!-- input hidden, envía datos de forma oculta -->
                            <input type="hidden" name="id_eliminar" value="<?= $fila["id"] ?>">
                            <input class="boton eliminar" type="submit" value="Eliminar">
                        </form>
                </div>
                
                <?php }?>
            </div>
    <?php
        }
    }

}



//mostrar noticia única

function mostrarNoticia($id){
    $datos = getNoticia($id);
    
    if(is_string($datos)){
        echo $datos;
    } else{
        $noticia = mysqli_fetch_assoc($datos);
        
        return $noticia;
    }

}

//mostrar usuario segun id
function mostrarUsuario($id){
    $datos = getUsuario($id);
    $usuario = mysqli_fetch_assoc($datos);

    return $usuario["nombre"];

}

// CREATE - CREAR  


function insertNoticia($id_usuario){

    //Array con mensajes de errores
    $errores = [];

    $titulo = "";
    $fecha = "";
    $cuerpo = "";

    
    $id_autor = $id_usuario;

    if (isset($_POST['titulo']) && isset($_POST['cuerpo'])  && isset($_POST['fecha'])) {
        $titulo = $_POST['titulo'];
        $cuerpo = $_POST['cuerpo'];
        $fecha = $_POST['fecha']; 

        if(!$titulo){
            $errores[] = "Debes añadir un título";
        }
        if(!$fecha){
            $errores[] = "Debes añadir una fecha";
        }
        if( strlen ($cuerpo) < 50){
            $errores[] = "El cuerpo es obligatorio y debe tener al menos 50 caracteres";
            
        }
            
        if(empty($errores)){
            crearNoticia($id_autor, $titulo, $cuerpo, $fecha);
        }else{
            return $errores;
        }
        
        
        
    } else {
        echo "Error en controlador insertNoticia";
    }
}


// UPDATE - ACTUALIZAR

function updateNoticia($id){
if (isset($_POST['titulo']) && isset($_POST['cuerpo']) && isset($_POST['fecha'])) {
    $titulo = $_POST['titulo'];
    $cuerpo = $_POST['cuerpo'];
    $fecha = $_POST['fecha'];

    //manejo de errores

    if(!$titulo){
        $errores[] = "Debes añadir un título";
    }
    if(!$fecha){
        $errores[] = "Debes añadir una fecha";
    }
    if( strlen ($cuerpo) < 50){
        $errores[] = "El cuerpo es obligatorio y debe tener al menos 50 caracteres";
        
    }
        
    if(empty($errores)){

    actualizarNoticia($id, $titulo, $cuerpo, $fecha);
    }else{
        return $errores;
    }

    
} else{
    echo "Error en controlador actualizarNoticia";
}


}



// DELETE - ELIMINIAR

function deleteNoticia(){
    
        if(isset($_POST['id_eliminar'])) {
            
            $id = $_POST['id_eliminar'];

            eliminarNoticia($id);
        } 



}

// GESTION USUARIOS



// CREAR USUARIO


function insertUsuario(){

    if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password']) ) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contrasena = $_POST['password'];

        crearUsuario($nombre, $email, $contrasena);

     
        
    } else {
        echo "Error en controlador insertUsuario";
    }

    
}

// LOGEAR USUARIO


function loginUsuario(){
    if (isset($_POST['email']) && isset($_POST['password']) ) { //solo se ejecuta la función si el usuario ha introducido email y password
        //sanear email introducido
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $contrasena = $_POST['password'];

        $usuario = autenticarUsuario($email);

        if ($usuario) {
            //Verificación contraseña 
            if (password_verify($contrasena, $usuario['contrasena'])) {
                //Auth OK
                $_SESSION['id'] = $usuario["id"];
                $_SESSION['usuario'] = $usuario['nombre']; // Definimos la variable de sesión
                return true;
            } else {
                //Contraseña incorrecta
               $errorPassword = "Contraseña incorrecta";
                return $errorPassword;
            }
        } 
        else {
            $errorUsuario = "Usuario no encontrado";
            return $errorUsuario;
        };
        
    } 
}


// LOGOUT

function logoutUsuario(){
    session_unset(); // Limpiar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header("Location: index.php");

    
}





?>



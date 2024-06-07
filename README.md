Este proyecto es una aplicación web CRUD (Crear, Leer, Actualizar, Eliminar) para gestionar un sitio de noticias utilizando PHP y MySQL. Permite a los usuarios administrar artículos de noticias a través de una interfaz web sencilla, crear nuevos usuarios y acceder a la app mediante autenticación con email y contraseña.

Requisitos
Servidor web (como Apache)
PHP 7.0 o superior
MySQL 5.6 o superior

Importar la base de datos:

Localiza el fichero ilernoticias.sql en el directorio del proyecto.
Importa el fichero SQL en tu servidor MySQL.

Configurar la conexión a la base de datos:

Abre el archivo datos_conexion.php y modifica las siguientes líneas con tus credenciales de MySQL:

$host = 'localhost'; // Nombre del host o IP del servidor MySQL
$dbname = 'nombre_de_la_base_de_datos'; // Nombre de la base de datos
$username = 'tu_usuario'; // Nombre de usuario de MySQL
$password = 'tu_contraseña'; // Contraseña de MySQL


Ejecutar la aplicación:

Coloca el proyecto en la raíz de tu servidor web o en una subcarpeta.
Accede a la aplicación desde tu navegador.


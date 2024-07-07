
    <!-- codigo PHP -->
    <?php 
        require "../controlador/controlador.php";

        
            // Si $_POST['orderBy'] no está definido
            $orderBy = ""; // para evitar mensajes de error
            $orderDir = "";
        
            if($_SERVER["REQUEST_METHOD"] === "POST") {

                deleteNoticia();
            }

            

            //incluimos header
        include "header.php"
    
    ?>
 <!-- inicio página -->
    <main class="main">
        
        <div class="noticias-container">
            <!-- formulario para ordenar las noticias -->
            <form class="noticias-form" action="index.php" method="POST">
                <label for="ordenar">Ordenar por:</label>
                <!-- select para ordenar por titulo, fecha o autor -->
                <!-- cada opción tiene un condicional para que se mantenga la elegida cada vez que se presiona el botón ordenar -->
                <select class="ordenar-opciones" name="orderBy">
                    <option value="titulo" <?php if(isset($_POST['orderBy']) && $_POST['orderBy'] == 'titulo') echo 'selected'; ?> >Título</option>
                    <option value="fecha" <?php if(isset($_POST['orderBy']) && $_POST['orderBy'] == 'fecha') echo 'selected'; ?>>Fecha</option>
                    <option value="id_autor" <?php if(isset($_POST['orderBy']) && $_POST['orderBy'] == 'id_autor') echo 'selected'; ?>>Autor</option>
                </select>
                <!-- orden ascendente o descendente -->
                <input type="radio" id="ASC" name="orderDir" value="ASC" <?php if(!isset($_POST['orderDir']) || (isset($_POST['orderDir']) && $_POST['orderDir'] == 'ASC')) echo 'checked';?>>
                <label for="ASC">Ascendente</label>
                <input type="radio" id="DESC" name="orderDir" value="DESC" <?php if(isset($_POST['orderDir']) && $_POST['orderDir'] == 'DESC') echo 'checked';?>>
                <label for="DESC">Descendente</label>
                <!-- submit -->
                <input class="ordenar-button"  type="submit" value="Ordenar">
            </form>


            <div class="lista-container">
                
        
                <?php showListaNoticias($orderBy, $orderDir); ?>
        
        
                <!--fin tabla-->
            </div>
        </div>

        <?php //mostrar solo si el usuario está logeado
            if (isset($_SESSION['usuario'])) { ?>
            <div class="crear-container">
                <button class="boton editar blanco novisited" onclick="window.location.href='crear.php'">Añadir nueva noticia</button>
            </div>
        <?php }?>
    </main>


    <?php
        include "footer.php";
    ?>


</body>
</html>
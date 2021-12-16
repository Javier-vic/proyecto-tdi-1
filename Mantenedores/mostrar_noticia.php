<?php
require_once "_init.php";
require('conexion_p.php');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <?php
    bootstrapHead();
    ?>
    </head>
<body>



<?php require __DIR__ . "/../navbar_index_1.php" ?>

<div class="container">
   
    <!-- Page Heading -->
    <h1 class="my-4">Noticias</h1>

    <div class="row">

    <!-- Tarjetas de noticias -->
    <?php
    $i = 0;
        $consulta = "SELECT * FROM noticia ORDER BY Id_noticia DESC";
        $resultado = mysqli_query($conexion, $consulta);
        while ($row = mysqli_fetch_assoc($resultado)) {
            $nombre = $row['Nombre_noticia'];
            $cuerpo = $row['Cuerpo_noticia'];
            $id = $row['Id_noticia'];
            $foto1 = $row['Ruta_portada'];
    
            ?>

            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-lg">
                    <?php
                    echo "<a href=" . echoRutaComillas("ver_noticia.php?seleccionado=" . $id) . "><img class=\"card-img-top\" src=" . echoRutaComillas($foto1 . ".jpg") . " alt=\"\"></a>";
                    ?>
                    <div class="card-body">
                        <h4 class="card-title">
                    <?php
                    echo "<a href=" . echoRutaComillas("ver_noticia.php?seleccionado=" . $id) . ">" . $nombre . "</a>";
                    ?>
                        </h4>
                        <p class="card-text text-truncate"><?php echo $cuerpo ?></p>
                    </div>
                </div>
            </div>

            <?php
            
        }
    ?>

        
        <!-- Plantilla de carta de noticia
        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="https://via.placeholder.com/700x400" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="#">Project Six</a>
                    </h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum
                    suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates,
                    nemo repellat fugiat excepturi! Nemo, esse.</p>
                </div>
            </div>
        </div> -->

    </div>
    <!-- /.row -->

    <!-- Pagination no funcional aun-->
    <!-- <ul class="pagination justify-content-center">
    <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item">
        <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
        <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
        </a>
    </li>
    </ul> -->

</div>
<?php
    bootstrapBody();
    ?>

</body>
</html>
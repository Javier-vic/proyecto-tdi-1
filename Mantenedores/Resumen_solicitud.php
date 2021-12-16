<?php
require_once 'conexion_p.php';
require_once('../auth_admin.php');
?>

<!doctype html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <title>Resumen de solicitudes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../css/Resumen_solicitud.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    </head>

    <body class="d-flex flex-column min-vh-100">
        <div class="container-fluid">
            <?php
            require('Navbar_administrador.html');
            ?>
            <div class="row">
                <div>
                    <main role="main" class="col-md-9 ml-sm-auto col-lg-12 pt-3 px-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Resumen de solicitudes</h1>
                        </div>
                        <h2>Grafica de estado de la solicitud</h2>
                        <canvas class="my-4" id="Grafico_Estado" width="900" height="380"></canvas>
                        <h2>Grafica del tipo de solicitud</h2>
                        <canvas class="my-4" id="Grafico_Tipo" width="900" height="380"></canvas>
                        <div class="table-responsive">
                            <div class="col-lg-12 col-md-12 ps-1">
                                <legend class="text-center pt-3">Registro de las Solicitudes</legend>
                                <table id="table" class="table table-striped table-hover">
                                    <thead class="bg-dark text-light">
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Codigo departamento</th>
                                            <th>Rut persona</th>
                                            <th>Tipo retroalimentacion</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $consulta = "SELECT * FROM `solicitud` ORDER BY `Creada_solicitud` DESC";
                                    $resultado = mysqli_query($conexion, $consulta);
                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                        $Cod = $row['Codigo_solicitud'];
                                        $Codigo = $row['Codigo_dep'];
                                        $Rut = $row['Rut_persona'];
                                        $Tipo = $row['Tipo_solicitud'];
                                        $Descripcion = $row['Descripcion_solicitud'];
                                        $Estado = $row['Estado_solicitud'];
                                        $Fecha = $row['Creada_solicitud'];
                                        echo "<tr>";
                                        echo "<td>" . $Cod . "</td>";
                                        echo "<td>" . $Codigo . "</td>";
                                        echo "<td>" . $Rut . "</td>";
                                        echo "<td>" . $Tipo . "</td>";
                                        echo "<td>" . $Descripcion . "</td>";
                                        echo "<td>" . $Estado . "</td>";
                                        echo "<td>" . $Fecha . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </main>

                    <div class="row">
                            <h2 class="h2">Personas con mayor cantidad de:</h2>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" style="color: black" id="nav-solicitudes-tab" data-bs-toggle="tab" data-bs-target="#nav-solicitudes" type="button" role="tab" aria-controls="nav-solicitudes" aria-selected="true">Solicitudes</button>
                                <button class="nav-link" style="color: black" id="nav-reclamos-tab" data-bs-toggle="tab" data-bs-target="#nav-reclamos" type="button" role="tab" aria-controls="nav-reclamos" aria-selected="false">Reclamos</button>
                                <button class="nav-link" style="color: black" id="nav-sugerencias-tab" data-bs-toggle="tab" data-bs-target="#nav-sugerencias" type="button" role="tab" aria-controls="nav-sugerencias" aria-selected="false">Sugerencias</button>
                                <button class="nav-link" style="color: black" id="nav-felicitaciones-tab" data-bs-toggle="tab" data-bs-target="#nav-felicitaciones" type="button" role="tab" aria-controls="nav-felicitaciones" aria-selected="false">Felicitaciones</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-solicitudes" role="tabpanel" aria-labelledby="nav-solicitudes-tab">
                                <div class="table-responsive">
                                    <div class="col-lg-6 col-md-6 ps-1">
                                        <legend class="text-center pt-3">Personas con mas solicitudes</legend>
                                        <table class="table table-striped table-hover">
                                            <thead class="bg-dark text-light">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Rut</th>
                                                    <th>Cantidad de reclamos</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $consulta = "SELECT Rut_persona, count(*) AS cantidad FROM solicitud GROUP BY Rut_persona ASC HAVING COUNT(*)>=1 ORDER BY `cantidad` DESC LIMIT 5;";
                                                $resultado = mysqli_query($conexion, $consulta);
                                                while ($row = mysqli_fetch_assoc($resultado)) {
                                                    $Rut = $row['Rut_persona'];
                                                    $cant = $row['cantidad'];
                                                    $consulta3 = "SELECT Nombre_persona FROM `persona` WHERE Rut_persona=$Rut";
                                                    $resultado3 = mysqli_query($conexion, $consulta3);
                                                    $row = mysqli_fetch_assoc($resultado3);
                                                    $Nombre = $row['Nombre_persona'];
                                                    echo "<tr>";
                                                    echo "<td>" . $Nombre . "</td>";
                                                    echo "<td>" . $Rut . "</td>";
                                                    echo "<td>" . $cant . "</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>        
                            </div>
                            <div class="tab-pane fade" id="nav-reclamos" role="tabpanel" aria-labelledby="nav-reclamos-tab">
                                <div class="table-responsive">
                                    <div class="col-lg-6 col-md-6 ps-1">
                                        <legend class="text-center pt-3">Personas con mas reclamos</legend>
                                        <table class="table table-striped table-hover">
                                            <thead class="bg-dark text-light">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Rut</th>
                                                    <th>Cantidad de reclamos</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $consulta = "SELECT Rut_persona, count(*) AS cantidad FROM solicitud WHERE tipo_solicitud='Reclamo' GROUP BY Rut_persona ASC HAVING COUNT(*)>=1 ORDER BY `cantidad` DESC LIMIT 5;";
                                                $resultado = mysqli_query($conexion, $consulta);
                                                while ($row = mysqli_fetch_assoc($resultado)) {
                                                    $Rut = $row['Rut_persona'];
                                                    $cant = $row['cantidad'];
                                                    $consulta3 = "SELECT Nombre_persona FROM `persona` WHERE Rut_persona=$Rut";
                                                    $resultado3 = mysqli_query($conexion, $consulta3);
                                                    $row = mysqli_fetch_assoc($resultado3);
                                                    $Nombre = $row['Nombre_persona'];
                                                    echo "<tr>";
                                                    echo "<td>" . $Nombre . "</td>";
                                                    echo "<td>" . $Rut . "</td>";
                                                    echo "<td>" . $cant . "</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>                    
                            </div>
                            <div class="tab-pane fade" id="nav-sugerencias" role="tabpanel" aria-labelledby="nav-sugerencias-tab">
                                <div class="table-responsive">
                                    <div class="col-lg-6 col-md-6 ps-1">
                                        <legend class="text-center pt-3">Personas con mas sugerencias</legend>
                                        <table class="table table-striped table-hover">
                                            <thead class="bg-dark text-light">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Rut</th>
                                                    <th>Cantidad de sugerencias</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $consulta = "SELECT Rut_persona, count(*) AS cantidad FROM solicitud WHERE tipo_solicitud='Sugerencia' GROUP BY Rut_persona ASC HAVING COUNT(*)>=1 ORDER BY `cantidad` DESC LIMIT 5;";
                                                $resultado = mysqli_query($conexion, $consulta);
                                                while ($row = mysqli_fetch_assoc($resultado)) {
                                                    $Rut = $row['Rut_persona'];
                                                    $cant = $row['cantidad'];
                                                    $consulta3 = "SELECT Nombre_persona FROM `persona` WHERE Rut_persona=$Rut";
                                                    $resultado3 = mysqli_query($conexion, $consulta3);
                                                    $row = mysqli_fetch_assoc($resultado3);
                                                    $Nombre = $row['Nombre_persona'];
                                                    echo "<tr>";
                                                    echo "<td>" . $Nombre . "</td>";
                                                    echo "<td>" . $Rut . "</td>";
                                                    echo "<td>" . $cant . "</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>                    
                            </div>
                            <div class="tab-pane fade" id="nav-felicitaciones" role="tabpanel" aria-labelledby="nav-felicitaciones-tab">
                                <div class="table-responsive">
                                    <div class="col-lg-6 col-md-6 ps-1">
                                        <legend class="text-center pt-3">Personas con mas felicitaciones</legend>
                                        <table class="table table-striped table-hover">
                                            <thead class="bg-dark text-light">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Rut</th>
                                                    <th>Cantidad de sugerencias</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $consulta = "SELECT Rut_persona, count(*) AS cantidad FROM solicitud WHERE tipo_solicitud='Felicitaciones' GROUP BY Rut_persona ASC HAVING COUNT(*)>=1 ORDER BY `cantidad` DESC LIMIT 5;";
                                                $resultado = mysqli_query($conexion, $consulta);
                                                while ($row = mysqli_fetch_assoc($resultado)) {
                                                    $Rut = $row['Rut_persona'];
                                                    $cant = $row['cantidad'];
                                                    $consulta3 = "SELECT Nombre_persona FROM `persona` WHERE Rut_persona=$Rut";
                                                    $resultado3 = mysqli_query($conexion, $consulta3);
                                                    $row = mysqli_fetch_assoc($resultado3);
                                                    $Nombre = $row['Nombre_persona'];
                                                    echo "<tr>";
                                                    echo "<td>" . $Nombre . "</td>";
                                                    echo "<td>" . $Rut . "</td>";
                                                    echo "<td>" . $cant . "</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="resumen_solicitud.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script src="cdn.datatables.net/plug-ins/1.11.3/i18n/es-cl.json"></script>
        <script>
                $(document).ready(function() {
                    $('#table').DataTable({
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es-cl.json"
                        }
                    }); {}
                });
        </script>
    </body>

</html>
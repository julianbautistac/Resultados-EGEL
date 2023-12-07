<?php

$servername = "localhost";
$username = "root";
$password = "bautistac5";
$dbname = "egel";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos deseados
$sql = "SELECT alumno.nombre AS nombre_alumno, area.descripcion_area AS nombre_area, periodos.per_aplicacion AS nombre_periodo, resultado.resultado, resultado.nivel FROM resultado 
INNER JOIN alumno ON resultado.id_alumno = alumno.id_alumno INNER JOIN area ON resultado.id_area = area.id_area 
INNER JOIN periodos ON area.id_periodo_aplicacion = periodos.id_periodo_aplicacion;";

/*   
$sql = "SELECT DISTINCT alumno.id_alumno AS id_alumno, alumno.nombre AS nombre_alumno, area.descripcion_area AS nombre_area, periodos.per_aplicacion AS nombre_periodo, resultado.resultado, resultado.nivel FROM resultado INNER JOIN alumno ON resultado.id_alumno = alumno.id_alumno INNER JOIN area ON resultado.id_area = area.id_area INNER JOIN periodos ON area.id_periodo_aplicacion = periodos.id_periodo_aplicacion";

*/


$result = $conn->query($sql);
/*
include("../../basedatos.php");

$sentencia = $conexion->prepare("SELECT alumno.nombre AS nombre_alumno, area.descripcion_area AS nombre_area, periodos.per_aplicacion AS nombre_periodo, resultado.resultado, resultado.nivel FROM resultado 
INNER JOIN alumno ON resultado.id_alumno = alumno.id_alumno 
INNER JOIN area ON resultado.id_area = area.id_area 
INNER JOIN periodos ON area.id_periodo_aplicacion = periodos.id_periodo_aplicacion;");
$result->execute();
$lista2 = $result->fetchAll(PDO::FETCH_ASSOC);*/

?>


<?php include("../../templates/header.php") ?>


<div class="card">
    <div class="card-header">

        <h4>Reporte</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">

                <?php
                if ($result->num_rows > 0) {
                    // Mostrar los resultados en una tabla HTML
                    echo "<thead>
                <tr>
                <th>Alumno</th>
                <th>Área</th>
                <th>Periodo</th>
                <th>Resultado</th>
                <th>Nivel</th>
                </tr> </thead> <tbody> ";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
            <td>" . $row["nombre_alumno"] . "</td>
            <td>" . $row["nombre_area"] . "</td>
            <td>" . $row["nombre_periodo"] . "</td>
            <td>" . $row["resultado"] . "</td>
            <td>" . $row["nivel"] . "</td>
                  </tr>";
                    }

                    echo "  </tbody>
        </table>";
                } else {
                    echo "No hay calificaciones disponibles.";
                }
                ?>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        </div>

    </div>
</div>


<?php include("../../templates/footer.php") ?>
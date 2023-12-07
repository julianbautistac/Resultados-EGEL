<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM alumno WHERE id_alumno=:id_alumno");
    $sentencia->bindParam(":id_alumno", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT *, 
(SELECT nombre_carrera 
FROM `carrera`
WHERE carrera.id_carrera=alumno.id_carrera limit 1) as carrera1
FROM `alumno`");
$sentencia->execute();
$listar = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia2 = $conexion->prepare("SELECT *, 
(SELECT modalidad
FROM modalidad
WHERE modalidad.id_modalidad=alumno.id_modalidad limit 1) as modalidad1
FROM alumno");
$sentencia2->execute();
$lista2 = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include("../../templates/header.php") ?>
<br>
<h4>Alumnos</h4>
<div class="card">
    <div class="card-header">

        <a name="agregar-alumno" id="agregar-alumno" class="btn btn-primary" href="crear.php" role="button">Agregar Alumno</a>
        <a name="reporte" id="reporte" class="btn btn-warning" href="reporte.php" role="button">Reporte de Alumnos</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">FOLIO</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Primer Apellido</th>
                        <th scope="col">Segundo Apellido</th>
                        <!--  <th scope="col">Resultado</th>-->
                        <th scope="col">Periodo Ingreso</th>
                        <th scope="col">Periodo Egreso</th>
                        <th scope="col">Fecha EGEL</th>
                        <th scope="col">Modalidad Titulación</th>
                        <th scope="col">Periodo Titulación</th>
                        <th scope="col"></th>
                        <th scope="col">Acciones</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listar as $registro) { ?>


                        <tr class="">
                            <td scope="row"><?php echo $registro['id_alumno']; ?></td>
                            <td><?php echo $registro['matricula']; ?></td>
                            <td><?php echo $registro['carrera1']; ?></td>
                            <td><?php echo $registro['folio']; ?></td>
                            <td><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['primer_apellido']; ?></td>
                            <td><?php echo $registro['segundo_apellido']; ?></td>
                            <td><?php echo $registro['p_ingreso']; ?></td>
                            <td><?php echo $registro['p_egreso']; ?></td>
                            <td><?php echo $registro['fecha_egel']; ?></td>
                            <td><?php echo $registro['id_modalidad']; ?></td>

                            <td><?php echo $registro['per_titulacion'] ?></td>

                            <td><a name="edit" id="edit" class="btn btn-info" href="resultados.php?txtID= <?php echo $registro['id_alumno']; ?>" role="button">Calificacion</a></td>
                            <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_alumno']; ?>" role="button">Editar</a></td>
                            <td><a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_alumno']; ?>" role="button">Eliminar</a></td>

                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("../../templates/footer.php") ?>
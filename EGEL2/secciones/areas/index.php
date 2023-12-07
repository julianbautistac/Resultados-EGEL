<?php 
include ("../../basedatos.php");

if(isset($_GET['txtID']))
{
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion -> prepare ("DELETE FROM area WHERE id_area=:id_area");
$sentencia->bindParam(":id_area",$txtID);
$sentencia->execute();
header("Location:index.php");

}

$sentencia = $conexion->prepare("SELECT *, 
(SELECT per_aplicacion 
FROM `periodos`
WHERE periodos.id_periodo_aplicacion=area.id_periodo_aplicacion limit 1) as aplicacion
FROM `area`");

$sentencia->execute();
$lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);



?>



<?php include("../../templates/header.php") ?>
<h4>Áreas</h4>

<div class="card">
    <div class="card-header">
    <a name="agregar-carrera" id="agregar-carrera" class="btn btn-primary" href="crear.php" role="button">Agregar Área</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table alumnos" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">No.</th>    
                    <th scope="col">Area</th>
                        <th scope="col">Periodo de aplicación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista as $registro){?>
                    <tr class="">
                    <td scope="row"><?php echo $registro['id_area']; ?></td>
                        <td><?php echo $registro['descripcion_area']; ?></td>
                        <td><?php echo $registro['aplicacion']; ?></td>
                        <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_area']; ?>" role="button">Editar</a>
                        <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_area']; ?>" role="button">Eliminar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("../../templates/footer.php") ?>
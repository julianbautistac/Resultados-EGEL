
<?php 
include ("../../basedatos.php");

if(isset($_GET['txtID']))
{
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion -> prepare ("DELETE FROM carrera WHERE id_carrera=:id_carrera");
$sentencia->bindParam(":id_carrera",$txtID);
$sentencia->execute();
header("Location:index.php");

}

$sentencia=$conexion->prepare("SELECT * FROM `carrera`");
$sentencia->execute();
$lista=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include("../../templates/header.php") ?>
<br>
<h4>Lista de Carreras</h4>
<div class="card">
    <div class="card-header">
    <a name="agregar-carrera" id="agregar-carrera" class="btn btn-primary" href="crear.php" role="button">Agregar Carrera</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table alumnos" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Acciones</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista as $registro){?>
                    <tr class="">
                    <td scope="row"><?php echo $registro['id_carrera']; ?></td>
                        <td><?php echo $registro['nombre_carrera']; ?></td>
                        <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_carrera']; ?>" role="button">Editar</a>
                        <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_carrera']; ?>" role="button">Eliminar</a></td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("../../templates/footer.php") ?>
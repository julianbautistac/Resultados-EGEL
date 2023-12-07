<?php 
include ("../../basedatos.php");

if(isset($_GET['txtID']))
{
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion -> prepare ("DELETE FROM modalidad WHERE id_modalidad=:id_modalidad");
$sentencia->bindParam(":id_modalidad",$txtID);
$sentencia->execute();
header("Location:index.php");

}

$sentencia=$conexion->prepare("SELECT * FROM `modalidad`");
$sentencia->execute();
$lista=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include("../../templates/header.php") ?>

<br>
<H4>Modalidad de titulación</H4>
<div class="card">
    <div class="card-header">
        <a name="agregar-modalidad" id="agregar-modalidad" class="btn btn-primary" href="crear.php" role="button">Agregar Modalidad</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista as $registro){?>
                    <tr class="">
                    <td scope="row"><?php echo $registro['id_modalidad']; ?></td>
                        <td><?php echo $registro['modalidad']; ?></td>
                        <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_modalidad']; ?>" role="button">Editar</a>
                        <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_modalidad']; ?>" role="button">Eliminar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>

</div>




<?php include("../../templates/footer.php") ?>
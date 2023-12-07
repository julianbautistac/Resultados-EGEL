<?php 
include ("../../basedatos.php");

if(isset($_GET['txtID']))
{
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion -> prepare ("DELETE FROM seccion WHERE id_seccion=:id_seccion");
$sentencia->bindParam(":id_seccion",$txtID);
$sentencia->execute();
header("Location:index.php");

}

$sentencia=$conexion->prepare("SELECT * FROM `seccion`");
$sentencia->execute();
$lista=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>




<?php include("../../templates/header.php") ?>
<h4>Lista de secciones</h4>

<div class="card">
    <div class="card-header">
    <a name="agregar-seccion" id="agregar-seccion" class="btn btn-primary" href="crear.php" role="button">Agregar Sección</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table secciones" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">No.</th>    
                    <th scope="col">Sección</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista as $registro){?>
                    <tr class="">
                    <td scope="row"><?php echo $registro['id_seccion']; ?></td>
                        <td><?php echo $registro['seccion']; ?></td>
                        <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_seccion']; ?>" role="button">Editar</a>
                        <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_seccion']; ?>" role="button">Eliminar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("../../templates/footer.php") ?>
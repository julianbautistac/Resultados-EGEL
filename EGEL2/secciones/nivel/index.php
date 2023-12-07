<?php 
include ("../../basedatos.php");

if(isset($_GET['txtID']))
{
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion -> prepare ("DELETE FROM nivel WHERE id_nivel=:id_nivel");
$sentencia->bindParam(":id_nivel",$txtID);
$sentencia->execute();
header("Location:index.php");

}

$sentencia=$conexion->prepare("SELECT * FROM `nivel`");
$sentencia->execute();
$lista=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>




<?php include("../../templates/header.php") ?>
<h4>Lista de niveles</h4>

<div class="card">
    <div class="card-header">
    <a name="agregar-nivel" id="agregar-nivel" class="btn btn-primary" href="crear.php" role="button">Agregar Nivel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table alumnos" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">No.</th>    
                    <th scope="col">Nivel</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista as $registro){?>
                    <tr class="">
                    <td scope="row"><?php echo $registro['id_nivel']; ?></td>
                        <td><?php echo $registro['descripcion_nivel']; ?></td>
                        <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_nivel']; ?>" role="button">Editar</a>
                        <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_nivel']; ?>" role="button">Eliminar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("../../templates/footer.php") ?>
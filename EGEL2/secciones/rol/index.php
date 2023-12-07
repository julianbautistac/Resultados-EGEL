<?php 
include ("../../basedatos.php");

if(isset($_GET['txtID']))
{
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion -> prepare ("DELETE FROM rol_usuario WHERE id_rol_usuario=:id_rol_usuario");
$sentencia->bindParam(":id_rol_usuario",$txtID);
$sentencia->execute();
header("Location:index.php");

}

$sentencia=$conexion->prepare("SELECT * FROM `rol_usuario`");
$sentencia->execute();
$lista_roles=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php") ?>
<br>
<H4>Lista de roles</H4>
<div class="card">
    <div class="card-header">
        <a name="agregar-rol" id="agregar-rol" class="btn btn-primary" href="crear.php" role="button">Agregar Rol</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="myTable">
                <thead>
                    <tr> <!--Nombre de las columnas-->
                        <th scope="col">No.</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($lista_roles as $registro){?>

    <tr class="">
                        <td scope="row"><?php echo $registro['id_rol_usuario']; ?></td>
                        <td><?php echo $registro['descripcion_rol']; ?></td>
                        <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_rol_usuario']; ?>" role="button">Editar</a>
                        <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_rol_usuario']; ?>" role="button">Eliminar</a></td>
                    </tr>

<?php } ?>


                </tbody>
            </table>
        </div>


    </div>

</div>



<?php include("../../templates/footer.php") ?>
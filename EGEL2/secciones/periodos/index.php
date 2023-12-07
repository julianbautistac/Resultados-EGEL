<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM periodos WHERE id_periodo_aplicacion=:id_periodo_aplicacion");
    $sentencia->bindParam(":id_periodo_aplicacion", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM `periodos`");
$sentencia->execute();
$lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php") ?>

<br>
<H4>Lista de periodos</H4>
<div class="card">
    <div class="card-header">
        <a name="agregar-periodo" id="agregar-periodo" class="btn btn-primary" href="crear.php" role="button">Agregar periodo</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Periodo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id_periodo_aplicacion']; ?></td>
                            <td><?php echo $registro['per_aplicacion']; ?></td>
                            <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_periodo_aplicacion']; ?>" role="button">Editar</a>
                                <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_periodo_aplicacion']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>

</div>

<?php include("../../templates/footer.php") ?>
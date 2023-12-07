<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM modalidad WHERE id_modalidad=:id_modalidad");
    $sentencia->bindParam(":id_modalidad", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $modalidad = $registro["modalidad"];

}


if ($_POST) {
    //print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre = (isset($_POST["modalidad"]) ? $_POST["modalidad"] : "");

    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("UPDATE modalidad SET modalidad=:modalidad WHERE id_modalidad=:id_modalidad ");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":modalidad", $nombre);
    $sentencia->bindParam(":id_modalidad", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

?>



<?php include("../../templates/header.php") ?>

<h4>Editar Modalidad</h4>

<div class="card">
    <div class="card-header">
        Modalidades
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>

            <div class="mb-3">
                <label for="modalidad" class="form-label">Nombre de la modalidad</label>
                <input type="text" value="<?php echo $modalidad; ?>" class="form-control" name="modalidad" id="modalidad" aria-describedby="helpId" placeholder="">

            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>
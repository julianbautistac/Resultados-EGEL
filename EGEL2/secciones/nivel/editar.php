<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM nivel WHERE id_nivel=:id_nivel");
    $sentencia->bindParam(":id_nivel", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nivel = $registro["descripcion_nivel"];

}


if ($_POST) {
    //print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre = (isset($_POST["nivel"]) ? $_POST["nivel"] : "");

    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("UPDATE nivel SET descripcion_nivel=:nivel WHERE id_nivel=:id_nivel ");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":nivel", $nombre);
    $sentencia->bindParam(":id_nivel", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

?>

<?php include("../../templates/header.php") ?>


<h4>Editar Nivel</h4>

<div class="card">
    <div class="card-header">
        Editar nivel
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>


            <div class="mb-3">
                <label for="nivel" class="form-label">Nivel</label>
                <input type="text" value="<?php echo $nivel; ?>" class="form-control" name="nivel" id="nivel" aria-describedby="helpId" placeholder="">

            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>
<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM area WHERE id_area=:id_area");
    $sentencia->bindParam(":id_area", $txtID);
    $sentencia->execute();
    

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro["descripcion_area"];
    $periodo = $registro["id_periodo_aplicacion"];


}

if ($_POST) {
    //print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $nombre = (isset($_POST["area"]) ? $_POST["area"] : "");
    $periodo = (isset($_POST["periodo"]) ? $_POST["periodo"] : "");
    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("UPDATE area SET descripcion_area=:area,id_periodo_aplicacion=:periodo WHERE id_area=:id");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":area", $nombre);
    $sentencia->bindParam(":periodo", $periodo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");

    //Mensaje para indicar que se agregó correctamente


}

$sentencia2 = $conexion->prepare("SELECT * FROM `periodos`");
$sentencia2->execute();
$lista = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php") ?>

<h4>Editar Areas</h4>

<div class="card">
    <div class="card-header">
        Áreas
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>

            <div class="mb-3">
                <label for="area" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="area" id="area" aria-describedby="helpId" placeholder="">

            </div>

            <div class="mb-3">
                <label for="periodo" class="form-label">Periodo aplicacion</label><!--esta informacion se obtiene de la base de datos-->
                <select class="form-select form-select-lg" name="periodo" id="periodo">

                    <?php foreach ($lista as $registro) { ?>
                        <option value="<?php echo $registro['id_periodo_aplicacion'] ?>"> <?php echo $registro['per_aplicacion'] ?> </option>
                    <?php } ?>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>
<?php include("../../templates/footer.php") ?>
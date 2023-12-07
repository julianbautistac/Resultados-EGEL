<?php
include("../../basedatos.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM periodos WHERE id_periodo_aplicacion=:id_periodo_aplicacion");
    $sentencia->bindParam(":id_periodo_aplicacion", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $cadena2 = $registro["per_aplicacion"];
    $primeros4=substr($cadena2,0,4);
    $ultimo=substr($cadena2,-1);
}

if ($_POST) {
   // print_r($_POST);
    //recibimos los datos del método post

    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $anio = (isset($_POST["anio"]) ? $_POST["anio"] : "");
    $periodo = (isset($_POST["periodo"]) ? $_POST["periodo"] : "");
    $espacio = "-";
    $cadena = $anio . $espacio . $periodo;


    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("UPDATE periodos SET per_aplicacion=:cadena WHERE id_periodo_aplicacion=:id_periodo_aplicacion ");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":cadena", $cadena);
    $sentencia->bindParam(":id_periodo_aplicacion", $txtID);
    $sentencia->execute();
    header("Location:index.php");

}

?>


<?php include("../../templates/header.php") ?>
<h4>Editar Periodo de aplicación</h4>

<div class="card">
    <div class="card-header">
        Periodos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        
        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>

            <div class="mb-3">
                <label for="nivel" class="form-label">Año</label>
                <input type="number" value="<?php echo $primeros4; ?>" class="form-control" id="anio" name="anio" min="2000" max="2099" step="1" required>
                <br>
                <label for="nivel" class="form-label">Periodo</label>
                <input type="number" value="<?php echo $ultimo; ?>" class="form-control" id="periodo" name="periodo" min="1" max="2" step="1" required>

               
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>
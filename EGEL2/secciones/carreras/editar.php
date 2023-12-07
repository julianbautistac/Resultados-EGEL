<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM carrera WHERE id_carrera=:id_carrera");
    $sentencia->bindParam(":id_carrera", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $carrera = $registro["nombre_carrera"];
}


if($_POST){
    //print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre=(isset($_POST["carrera"])?$_POST["carrera"]:"");

    //preparar la insercion de los datos
    $sentencia=$conexion -> prepare ("UPDATE carrera SET nombre_carrera=:carrera WHERE id_carrera=:id_carrera ");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":carrera",$nombre);
    $sentencia->bindParam(":id_carrera",$txtID);
    $sentencia->execute();
    header("Location:index.php");
    
    
    }

?>



<?php include("../../templates/header.php") ?>
<h4>Editar carreras</h4> 

<div class="card">
    <div class="card-header">
        Carreras
    </div>
    <div class="card-body">
<form action="" method="post" enctype="multipart/form-data">

<div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>

<div class="mb-3">
                <label for="carrera" class="form-label">Nombre de la carrera</label>
                <input type="text" value="<?php echo $carrera; ?>" class="form-control" name="carrera" id="carrera" aria-describedby="helpId" placeholder="">
                
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

</form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>
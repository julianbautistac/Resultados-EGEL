<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM seccion WHERE id_seccion=:id_seccion");
    $sentencia->bindParam(":id_seccion", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $seccion = $registro["seccion"];
}


if($_POST){
    //print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre=(isset($_POST["seccion"])?$_POST["seccion"]:"");

    //preparar la insercion de los datos
    $sentencia=$conexion -> prepare ("UPDATE seccion SET seccion=:seccion WHERE id_seccion=:id_seccion ");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":seccion",$nombre);
    $sentencia->bindParam(":id_seccion",$txtID);
    $sentencia->execute();
    header("Location:index.php");
    
    
    }

?>

<?php include("../../templates/header.php") ?>
<h4>Editar Seccion</h4>

<div class="card">
    <div class="card-header">
        Secciones
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>
            <div class="mb-3">
                <label for="seccion" class="form-label">Sección</label>
                <input type="text" value="<?php echo $seccion; ?>" class="form-control" name="seccion" id="seccion" aria-describedby="helpId" placeholder="">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>
<?php include("../../templates/footer.php") ?>
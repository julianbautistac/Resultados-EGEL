<?php 
include ("../../basedatos.php");

if($_POST){
//print_r($_POST);
//recibimos los datos del método post
$nombre_nivel=(isset($_POST["nivel"])?$_POST["nivel"]:"");
//preparar la insercion de los datos
$sentencia=$conexion -> prepare ("INSERT INTO nivel(id_nivel,descripcion_nivel) VALUES (null,:nivel)");
//asignando los valores que vienen del método POST
$sentencia->bindParam(":nivel",$nombre_nivel);
$sentencia->execute();
//header("Location:index.php");

//Mensaje para indicar que se agregó correctamente
$lastInsertId = $conexion->lastInsertId();
if($lastInsertId>0){

echo "<div class='content alert alert-primary' >  $nombre_nivel  Ha sido agregado correctamente </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pudo insertar el dato  </div>";

print_r($sql->errorInfo()); 
}

}

?>

<?php include("../../templates/header.php") ?>
<h4>Agregar Nivel</h4>

<div class="card">
    <div class="card-header">
        Niveles
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nivel" class="form-label">Nivel</label>
                <input type="text" class="form-control" name="nivel" id="nivel" aria-describedby="helpId" placeholder="">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>
<?php include("../../templates/footer.php") ?>
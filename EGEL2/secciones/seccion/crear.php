<?php 
include ("../../basedatos.php");

if($_POST){
//print_r($_POST);
//recibimos los datos del método post
$nombre_seccion=(isset($_POST["seccion"])?$_POST["seccion"]:"");
//preparar la insercion de los datos
$sentencia=$conexion -> prepare ("INSERT INTO seccion(id_seccion,seccion) VALUES (null,:seccion)");
//asignando los valores que vienen del método POST
$sentencia->bindParam(":seccion",$nombre_seccion);
$sentencia->execute();
//header("Location:index.php");

//Mensaje para indicar que se agregó correctamente
$lastInsertId = $conexion->lastInsertId();
if($lastInsertId>0){

echo "<div class='content alert alert-primary' >  $nombre_seccion  Ha sido agregado correctamente </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pudo insertar el dato  </div>";

print_r($sql->errorInfo()); 
}

}

?>

<?php include("../../templates/header.php") ?>
<h4>Agregar Seccion</h4>

<div class="card">
    <div class="card-header">
        Secciones
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="seccion" class="form-label">Sección</label>
                <input type="text" class="form-control" name="seccion" id="seccion" aria-describedby="helpId" placeholder="">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>
<?php include("../../templates/footer.php") ?>
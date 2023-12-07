<?php 
include ("../../basedatos.php");

if($_POST){
//print_r($_POST);
//recibimos los datos del método post
$nombre=(isset($_POST["area"])?$_POST["area"]:"");
$periodo = (isset($_POST["periodo"]) ? $_POST["periodo"] : "");
//preparar la insercion de los datos
$sentencia=$conexion -> prepare ("INSERT INTO area(id_area,descripcion_area,id_periodo_aplicacion) VALUES (null,:area,:periodo)");
//asignando los valores que vienen del método POST
$sentencia->bindParam(":area",$nombre);
$sentencia->bindParam(":periodo",$periodo);
$sentencia->execute();
//header("Location:index.php");

//Mensaje para indicar que se agregó correctamente
$lastInsertId = $conexion->lastInsertId();
if($lastInsertId>0){

echo "<div class='content alert alert-primary' >  $nombre  Ha sido agregado correctamente </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pudo insertar el dato  </div>";

print_r($sql->errorInfo()); 
}

}

//para desplegar la lista de roles de usuario
$sentencia2 = $conexion->prepare("SELECT * FROM `periodos`");
$sentencia2->execute();
$lista = $sentencia2->fetchAll(PDO::FETCH_ASSOC);


?>

<?php include("../../templates/header.php") ?>
<h4>Agregar Área</h4>

<div class="card">
    <div class="card-header">
        Áreas
    </div>
    <div class="card-body">
<form action="" method="post" enctype="multipart/form-data">
<div class="mb-3">
                <label for="area" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="area" id="area" aria-describedby="helpId" placeholder="">
                
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

<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia4 = $conexion->prepare("SELECT * FROM alumno WHERE id_alumno=:id_alumno");
    $sentencia4->bindParam(":id_alumno", $txtID);
    $sentencia4->execute();

    $registro = $sentencia4->fetch(PDO::FETCH_LAZY);
    $matricula = $registro["matricula"];
 

}

if ($_POST) {
    // print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $area = (isset($_POST["area"]) ? $_POST["area"] : "");
    $calificacion = (isset($_POST["calificacion"]) ? $_POST["calificacion"] : "");
    //preparar la insercion de los datos
// Aplicar lógica de evaluación de calificaciones
if ($calificacion >= 700 && $calificacion <= 999) {
    $evaluacion = "Aun no satisfactorio";
} elseif ($calificacion < 999) {
    $evaluacion = "Sin testimonio";
} elseif ($calificacion >= 1000 && $calificacion <= 1149) {
    $evaluacion = "Satisfactorio";
} elseif ($calificacion >= 1150 && $calificacion <= 1300) {
    $evaluacion = "Sobresaliente";
} else {
    // Manejar otros casos o mostrar un mensaje de error
    $evaluacion = "Calificación no válida";
}

    $sentencia = $conexion->prepare("INSERT INTO resultado(id_resultado,resultado,nivel,id_alumno,id_area)
    VALUES (null,:resultado,:nivel,:id_alumno,:id_area)");
   //asignando los valores que vienen del método POST
    $sentencia->bindParam(":id_alumno", $txtID);
    $sentencia->bindParam(":id_area", $area);
    $sentencia->bindParam(":resultado", $calificacion);
    $sentencia->bindParam(":nivel", $evaluacion);
    $sentencia->execute();
    //header("Location:index.php");

//Mensaje para indicar que se agregó correctamente
$lastInsertId = $conexion->lastInsertId();
if($lastInsertId>0){

echo "<div class='content alert alert-primary' >  La calificacion se ha agregado correctamente </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pudo insertar el dato  </div>";

print_r($sql->errorInfo()); 
}


}

//para desplegar la lista de carreras
$sentencia2 = $conexion->prepare("SELECT * FROM `area`");
$sentencia2->execute();
$lista = $sentencia2->fetchAll(PDO::FETCH_ASSOC);




?>

<?php include("../../templates/header.php") ?>
<h4>Resultado</h4>
<div class="card">
    <div class="card-header">
        Datos del alumno

    </div>
    <div class="card-body">
 

        <form action="" method="post">
        <div class="mb-3">
            <label for="txtID" class="form-label">ID:</label>
            <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">



            <div class="mb-3">
                <label for="area" class="form-label">Area</label><!--esta informacion se va jalar de la base de datos-->
                <select class="form-select form-select-lg" name="area" id="area">

                    <?php foreach ($lista as $registro) { ?>
                        <option value="<?php echo $registro['id_area'] ?>"> <?php echo $registro['descripcion_area'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="folio" class="form-label">Calificación</label>
                <input type="number" class="form-control" name="calificacion" id="calificacion" min="0" max="9999" step="1" placeholder="" required>
            </div>

      <!--     <div class="mb-3">

                <label for="folio" class="form-label">Nivel</label>
                <input type="number" value="<?php //echo $evaluacion?>" class="form-control" name="nivel" id="nivel"  placeholder="" required>
            </div>--> 


            <button type="submit" class="btn btn-primary">Agregar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>


        </form>


    </div>


</div>



<?php include("../../templates/footer.php") ?>
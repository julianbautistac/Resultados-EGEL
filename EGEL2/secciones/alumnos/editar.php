<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia4 = $conexion->prepare("SELECT * FROM alumno WHERE id_alumno=:id_alumno");
    $sentencia4->bindParam(":id_alumno", $txtID);
    $sentencia4->execute();

    $registro = $sentencia4->fetch(PDO::FETCH_LAZY);
    $matricula = $registro["matricula"];
    $carrera = $registro["id_carrera"];
    $folio = $registro["folio"];
    $nombre = $registro["nombre"];
    $apellido1 = $registro["primer_apellido"];
    $apellido2 = $registro["segundo_apellido"];
    $ingreso = $registro["p_ingreso"];
    $egreso = $registro["p_egreso"];
    $egel_date = $registro["fecha_egel"];
    $modalidad_titulacion = $registro["id_modalidad"];
    $titulacion=$registro["per_titulacion"];

}

if ($_POST) {
     print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $matricula = (isset($_POST["matricula"]) ? $_POST["matricula"] : "");
    $carrera = (isset($_POST["carrera"]) ? $_POST["carrera"] : "");
    $folio = (isset($_POST["folio"]) ? $_POST["folio"] : "");
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $apellido1 = (isset($_POST["apellido1"]) ? $_POST["apellido1"] : "");
    $apellido2 = (isset($_POST["apellido2"]) ? $_POST["apellido2"] : "");
    $ingreso = (isset($_POST["ingreso"]) ? $_POST["ingreso"] : "");
    $egreso = (isset($_POST["egreso"]) ? $_POST["egreso"] : "");
    $egel_date = (isset($_POST["egel_date"]) ? $_POST["egel_date"] : "");
    $modalidad_titulacion = (isset($_POST["modalidad_titulacion"]) ? $_POST["modalidad_titulacion"] : "");
    $titulacion = (isset($_POST["titulacion"]) ? $_POST["titulacion"] : "");


    //preparar la insercion de los datos

   

    $sentencia = $conexion->prepare("UPDATE alumno SET matricula=:matricula, folio=:folio, nombre=:nombre,
    primer_apellido=:apellido1, segundo_apellido=:apellido2,
    id_carrera=:carrera, id_modalidad=:modalidad_titulacion, p_ingreso=:ingreso, p_egreso=:egreso,
    fecha_egel=:egel_date, per_titulacion=:titulacion WHERE id_alumno=:id");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":matricula", $matricula);
    $sentencia->bindParam(":folio", $folio);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellido1", $apellido1);
    $sentencia->bindParam(":apellido2", $apellido2);
    $sentencia->bindParam(":carrera", $carrera);
    $sentencia->bindParam(":modalidad_titulacion", $modalidad_titulacion);
    $sentencia->bindParam(":ingreso", $ingreso);
    $sentencia->bindParam(":egreso", $egreso);
    $sentencia->bindParam(":egel_date", $egel_date);

    $sentencia->bindParam(":titulacion", $titulacion);
    $sentencia->execute();
    header("Location:index.php");
}

//para desplegar la lista de carreras
$sentencia2 = $conexion->prepare("SELECT * FROM `carrera`");
$sentencia2->execute();
$lista_carrera = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

$sentencia3 = $conexion->prepare("SELECT * FROM `modalidad`");
$sentencia3->execute();
$lista_modalidad = $sentencia3->fetchAll(PDO::FETCH_ASSOC);


?>



<?php include("../../templates/header.php") ?>

<br>
<h4>Editar Alumno</h4>

<div class="card">
    <div class="card-header">
        Datos del alumno

    </div>
    <div class="card-body">

        <form action="" method="post">
        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="number" value="<?php echo $matricula; ?>"  class="form-control" name="matricula" id="matricula" min="100000" max="99999999" step="1" placeholder="######" required>
            </div>

            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera</label><!--esta informacion se va jalar de la base de datos-->
                <select class="form-select form-select-lg" name="carrera" id="carrera">

                    <?php foreach ($lista_carrera as $registro) { ?>
                        <option value="<?php echo $registro['id_carrera'] ?>"> <?php echo $registro['nombre_carrera'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="folio" class="form-label">Folio</label>
                <input type="number" value="<?php echo $folio; ?>" class="form-control" name="folio" id="folio" min="100" max="9999999999" step="1" placeholder="##########" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="apellido1" class="form-label">Primer Apellido</label>
                <input type="text" value="<?php echo $apellido1; ?>" class="form-control" name="apellido1" id="apellido1" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo Apellido</label>
                <input type="text" value="<?php echo $apellido2; ?>" class="form-control" name="apellido2" id="apellido2" placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="ingreso" class="form-label">Periodo de Ingreso</label>
                <input type="text" value="<?php echo $ingreso; ?>" class="form-control" id="ingreso" name="ingreso" placeholder="Año-#" required>
            </div>

            <div class="mb-3">
                <label for="egreso" class="form-label">Periodo de Egreso</label>
                <input type="text" value="<?php echo $egreso; ?>" class="form-control" id="egreso" name="egreso" placeholder="Año-#" required>
            </div>

            <div class="mb-3">
                <label for="fecha-egel" class="form-label">Fecha EGEL</label>
                <input type="date" value="<?php echo $egel_date; ?>" class="form-control" id="egel_date" name="egel_date" required>

            </div>


            <div class="mb-3">
                <label for="modalidad_titulacion" class="form-label">Modalidad de titulación</label><!--esta informacion se va jalar de la base de datos-->
                <select class="form-select form-select-lg" name="modalidad_titulacion" id="modalidad_titulacion">

                <?php foreach ($lista_modalidad as $registro2) { ?>
                        <option value="<?php echo $registro2['id_modalidad'] ?>"> <?php echo $registro2['modalidad'] ?> </option>
                    <?php } ?>
                </select>
                
            </div>

            <div class="mb-3">
                <label for="titulacion" class="form-label">Periodo de Titulación</label>
                <input type="text" value="<?php echo $titulacion; ?>" class="form-control" id="titulacion" name="titulacion" placeholder="Año-#" required>
                <br>
                </select>

            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>


        </form>


    </div>


</div>

<?php include("../../templates/footer.php") ?>
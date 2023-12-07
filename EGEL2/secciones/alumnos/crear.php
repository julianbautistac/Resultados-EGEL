<?php
include("../../basedatos.php");

if ($_POST) {
     //print_r($_POST);
    //recibimos los datos del método post
    $matricula = (isset($_POST["matricula"]) ? $_POST["matricula"] : "");
    $carrera = (isset($_POST["carrera"]) ? $_POST["carrera"] : "");
    $folio = (isset($_POST["folio"]) ? $_POST["folio"] : "");
    $name = (isset($_POST["name"]) ? $_POST["name"] : "");
    $apellido1 = (isset($_POST["apellido1"]) ? $_POST["apellido1"] : "");
    $apellido2 = (isset($_POST["apellido2"]) ? $_POST["apellido2"] : "");
    $ingreso = (isset($_POST["ingreso"]) ? $_POST["ingreso"] : "");
    $egreso = (isset($_POST["egreso"]) ? $_POST["egreso"] : "");
    $egel_date = (isset($_POST["egel_date"]) ? $_POST["egel_date"] : "");
    $modalidad_titulacion = (isset($_POST["modalidad_titulacion"]) ? $_POST["modalidad_titulacion"] : "");
    $titulacion = (isset($_POST["titulacion"]) ? $_POST["titulacion"] : "");

    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("INSERT INTO alumno(id_alumno,matricula,folio,nombre,primer_apellido,segundo_apellido,id_carrera,id_modalidad,p_ingreso,p_egreso,fecha_egel,per_titulacion)
     VALUES (null,:matricula,:folio,:name,:apellido1,:apellido2,:carrera,:modalidad_titulacion,:ingreso,:egreso,:egel_date,:titulacion)");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":matricula", $matricula);
    $sentencia->bindParam(":folio", $folio);
    $sentencia->bindParam(":name", $name);
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
<h4>Agregar alumnos</h4>

<div class="card">
    <div class="card-header">
        Datos del alumno

    </div>
    <div class="card-body">

        <form action="" method="post">
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="number" class="form-control" name="matricula" id="matricula" min="100000" max="99999999" step="1" placeholder="######" required>
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
                <input type="number" class="form-control" name="folio" id="folio" min="100" max="9999999999" step="1" placeholder="##########" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="apellido1" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="ingreso" class="form-label">Periodo de Ingreso</label>
                <input type="text" class="form-control" id="ingreso" name="ingreso" placeholder="Año-#" required>
                <br>

            </div>

            <div class="mb-3">
                <label for="egreso" class="form-label">Periodo de Egreso</label>
                <input type="text" class="form-control" id="egreso" name="egreso" placeholder="Año-#" required>
                <br>
                </select>

            </div>

            <div class="mb-3">
                <label for="fecha-egel" class="form-label">Fecha EGEL</label>
                <input type="date" class="form-control" id="egel_date" name="egel_date" required>

            </div>


            <div class="mb-3">
                <label for="modalidad_titulacion" class="form-label">Modalidad de titulación</label><!--esta informacion se va jalar de la base de datos-->
                <select class="form-select form-select-lg" name="modalidad_titulacion" id="modalidad_titulacion">

                <?php foreach ($lista_modalidad as $registro2) { ?>
                        <option value="<?php echo $registro2['id_modalidad'] ?>"> <?php echo $registro2['modalidad'] ?> </option>
                    <?php } ?>
                </select>
                </select>
            </div>

            <div class="mb-3">
                <label for="titulacion" class="form-label">Periodo de Titulación</label>
                <input type="text" class="form-control" id="titulacion" name="titulacion" placeholder="Año-#" required>
                <br>
                </select>

            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>


        </form>


    </div>


</div>

<?php include("../../templates/footer.php") ?>
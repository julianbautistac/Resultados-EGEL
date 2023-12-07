<?php
include("../../basedatos.php");

if ($_POST) {
    //recibimos los datos del método post
    $nombre = (isset($_POST["modalidad"]) ? $_POST["modalidad"] : "");

    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("INSERT INTO modalidad(id_modalidad,modalidad)
     VALUES (null,:cadena)");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":cadena", $nombre);
    $sentencia->execute();
    //header("Location:index.php");

    //Mensaje para indicar que se agregó correctamente
    $lastInsertId = $conexion->lastInsertId();
    if ($lastInsertId > 0) {

        echo "<div class='content alert alert-primary' >  $nombre  Ha sido agregado correctamente </div>";
    } else {
        echo "<div class='content alert alert-danger'> No se pudo insertar el dato  </div>";

        print_r($sql->errorInfo());
    }
}
?>


<?php include("../../templates/header.php") ?>
<h4>Agregar modalidad</h4>

<div class="card">
    <div class="card-header">
        Modalidades
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="modalidad" class="form-label">Nombre de la modalidad</label>
                <input type="text" class="form-control" name="modalidad" id="modalidad" aria-describedby="helpId" placeholder="">

            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>
<?php
include("../../basedatos.php");


if ($_POST) {
   // print_r($_POST);
    //recibimos los datos del método post

    $anio = (isset($_POST["anio"]) ? $_POST["anio"] : "");
    $periodo = (isset($_POST["periodo"]) ? $_POST["periodo"] : "");
    $espacio = "-";
    $cadena = $anio . $espacio . $periodo;


    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("INSERT INTO periodos(id_periodo_aplicacion,per_aplicacion)
     VALUES (null,:cadena)");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":cadena", $cadena);
    $sentencia->execute();
    header("Location:index.php");
    /*
    //Mensaje para indicar que se agregó correctamente
    $lastInsertId = $conexion->lastInsertId();
    if ($lastInsertId > 0) {

        echo "<div class='content alert alert-primary' >  $anio.$espacio.$periodo  Ha sido agregado correctamente </div>";
    } else {
        echo "<div class='content alert alert-danger'> No se pudo insertar el dato  </div>";

        print_r($sql->errorInfo());
    }*/
}

?>


<?php include("../../templates/header.php") ?>

<h4>Agregar periodo</h4>

<div class="card">
    <div class="card-header">
        Periodos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="nivel" class="form-label">Año</label>
                <input type="number" class="form-control" id="anio" name="anio" min="2000" max="2099" step="1" required>
                <br>
                <label for="nivel" class="form-label">Periodo</label>
                <input type="number" class="form-control" id="periodo" name="periodo" min="1" max="2" step="1" required>

                <!--  <input type="hidden" id="final" />-->

            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <!--<input type="submit" class="btn btn-primary" value="Guardar" onClick="javascript:procesar();"/> -->
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>


<?php include("../../templates/footer.php") ?>
<!--
<script type="text/javascript">

function procesar() {

    campo1=document.getElementById('anio').value;
    campo2=document.getElementById('periodo').value;

    final=campo1+'-'+campo2;

    document.getElementById('final').value=final;

    document.forms.ejemplo.submit();

}

</script> -->
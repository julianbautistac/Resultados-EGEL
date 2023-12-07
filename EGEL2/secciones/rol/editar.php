<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM rol_usuario WHERE id_rol_usuario=:id_rol_usuario");
    $sentencia->bindParam(":id_rol_usuario", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $rol = $registro["descripcion_rol"];
}


if($_POST){
    //print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre_rol=(isset($_POST["rol"])?$_POST["rol"]:"");

    //preparar la insercion de los datos
    $sentencia=$conexion -> prepare ("UPDATE rol_usuario SET descripcion_rol=:rol WHERE id_rol_usuario=:id_rol_usuario ");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":rol",$nombre_rol);
    $sentencia->bindParam(":id_rol_usuario",$txtID);
    $sentencia->execute();
    header("Location:index.php");
    
    /*
    //Mensaje para indicar que se agregó correctamente
    $lastInsertId = $conexion->lastInsertId();
    if($lastInsertId>0){
    
    echo "<div class='content alert alert-primary' >  $nombre_rol  Ha sido agregado correctamente </div>";
    }
    else{
        echo "<div class='content alert alert-danger'> No se puedo insertar el dato  </div>";
    
    print_r($sql->errorInfo()); 
    }*/
    
    
    }

?>

<?php include("../../templates/header.php") ?>
<h4>Editar rol de usuarios</h4>

<div class="card">
    <div class="card-header">
        Editar rol de usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>


            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <input type="text" value="<?php echo $rol; ?>" class="form-control" name="rol" id="rol" aria-describedby="helpId" placeholder="">

            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>


<?php include("../../templates/footer.php") ?>
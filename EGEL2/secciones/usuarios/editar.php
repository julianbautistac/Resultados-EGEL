<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
    $sentencia->bindParam(":id_usuario", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro["nombre"];
    $primer_apellido = $registro["primer_apellido"];
    $segundo_apellido = $registro["segundo_apellido"];
    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
    $id_rol = $registro["id_rol"];
}

if ($_POST) {
    // print_r($_POST);
    //recibimos los datos del método post
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
    $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $pass = (isset($_POST["pass"]) ? $_POST["pass"] : "");
    $email = (isset($_POST["email"]) ? $_POST["email"] : "");
    $rol_user = (isset($_POST["rol_user"]) ? $_POST["rol_user"] : "");

    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("UPDATE usuarios SET nombre=:nombre, primer_apellido=:primerapellido,
    segundo_apellido=:segundoapellido, usuario=:usuario, password=:pass, correo=:email, id_rol=:rol_user WHERE id_usuario=:id");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":pass", $pass);
    $sentencia->bindParam(":email", $email);
    $sentencia->bindParam(":rol_user", $rol_user);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
    /*
    //Mensaje para indicar que se agregó correctamente
    $lastInsertId = $conexion->lastInsertId();
    if ($lastInsertId > 0) {

        echo "<div class='content alert alert-primary' >  $usuario  Ha sido agregado correctamente </div>";
    } else {
        echo "<div class='content alert alert-danger'> No se pudo insertar el dato  </div>";

        print_r($sql->errorInfo());
    }*/
}



$sentencia2 = $conexion->prepare("SELECT * FROM `rol_usuario`");
$sentencia2->execute();
$lista_roles = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

?>




<?php include("../../templates/header.php") ?>
Editar usuario

<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="txt" readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="" required>

            </div>

            <div class="mb-3">
                <label for="primerapellido" class="form-label">Primer Apellido</label>
                <input type="text" value="<?php echo $primer_apellido; ?>" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="" required>

            </div>

            <div class="mb-3">
                <label for="segundoapellido" class="form-label">Segundo Apellido</label>
                <input type="text" value="<?php echo $segundo_apellido; ?>" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="" required>

            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="" required>

            </div>
            <!--
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" ******aqui va el value y echo para imprimir el password class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="" required>

            </div>
-->
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <div class="input-group">
                    <input id="txtPassword" type="password" value="<?php echo $password; ?>" class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="" required>
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="pass" class="form-label">Correo</label>
                <input type="email" value="<?php echo $correo; ?>" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" required>

            </div>

            <div class="mb-3">
                <label for="rol_user" class="form-label">Rol</label><!--esta informacion se obtiene de la base de datos-->
                <select class="form-select form-select-lg" name="rol_user" id="rol_user">

                    <?php foreach ($lista_roles as $registro) { ?>
                        <option value="<?php echo $registro['id_rol_usuario'] ?>"> <?php echo $registro['descripcion_rol'] ?> </option>
                    <?php } ?>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>

<script type="text/javascript">
    function mostrarPassword() {
        var cambio = document.getElementById("txtPassword");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
</script>

<?php include("../../templates/footer.php") ?>
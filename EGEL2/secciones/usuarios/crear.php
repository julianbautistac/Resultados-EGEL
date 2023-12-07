<?php
include("../../basedatos.php");


if ($_POST) {
    // print_r($_POST);
    //recibimos los datos del método post
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
    $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $pass = (isset($_POST["pass"]) ? $_POST["pass"] : "");
    $email = (isset($_POST["email"]) ? $_POST["email"] : "");
    $rol_user = (isset($_POST["rol_user"]) ? $_POST["rol_user"] : "");

    //preparar la insercion de los datos
    $sentencia = $conexion->prepare("INSERT INTO usuarios(id_usuario,nombre,primer_apellido,segundo_apellido,usuario,password,correo,id_rol)
     VALUES (null,:nombre,:primerapellido,:segundoapellido,:usuario,:pass,:email,:rol_user)");
    //asignando los valores que vienen del método POST
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":pass", $pass);
    $sentencia->bindParam(":email", $email);
    $sentencia->bindParam(":rol_user", $rol_user);
    $sentencia->execute();
    header("Location:index.php");

}

//para desplegar la lista de roles de usuario
$sentencia2 = $conexion->prepare("SELECT * FROM `rol_usuario`");
$sentencia2->execute();
$lista_roles = $sentencia2->fetchAll(PDO::FETCH_ASSOC);


?>


<?php include("../../templates/header.php") ?>
<h4>Agregar Usuario</h4>

<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="" required>

            </div>

            <div class="mb-3">
                <label for="primerapellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="" required>

            </div>

            <div class="mb-3">
                <label for="segundoapellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="" required>

            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="" required>

            </div>

            <!--  <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="" required>

            </div>-->

            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <div class="input-group">
                    <input id="txtPassword" type="password" class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="" required>
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="pass" class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" required>

            </div>

            <div class="mb-3">
                <label for="rol_user" class="form-label">Rol</label><!--esta informacion se obtiene de la base de datos-->
                <select class="form-select form-select-lg" name="rol_user" id="rol_user">

                    <?php foreach ($lista_roles as $registro) { ?>
                        <option value="<?php echo $registro['id_rol_usuario'] ?>"> <?php echo $registro['descripcion_rol'] ?> </option>
                    <?php } ?>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
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
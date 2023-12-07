<?php
include("../../basedatos.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario=:id_usuario");
    $sentencia->bindParam(":id_usuario", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT *, 
(SELECT descripcion_rol 
FROM `rol_usuario`
WHERE rol_usuario.id_rol_usuario=usuarios.id_rol limit 1) as rol
FROM `usuarios`");

$sentencia->execute();
$listar = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

<?php include("../../templates/header.php") ?>
<br>
<div class="card">
    <div class="card-header">
        <a name="agregar-user" id="agregar-user" class="btn btn-primary" href="crear.php" role="button">Agregar Usuario</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>

                        <th scope="col">Usuario</th>
                        <th scope="col">Password</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Primer Apellido</th>
                        <th scope="col">Segundo Apellido</th>
                        <th scope="col">Rol de usuario</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($listar as $registro) { ?>

                        <tr class="">
                            <td scope="row"><?php echo $registro['id_usuario']; ?></td>
                            <td><?php echo $registro['usuario']; ?></td>
                            <td><?php echo $registro['password']; ?></td>
                            <td><?php echo $registro['correo']; ?></td>
                            <td><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['primer_apellido']; ?></td>
                            <td><?php echo $registro['segundo_apellido']; ?></td>
                            <td><?php echo $registro['rol']; ?></td>
                            <td><a name="edit" id="edit" class="btn btn-success" href="editar.php?txtID= <?php echo $registro['id_usuario']; ?>" role="button">Editar</a>
                                <a name="del" id="del" class="btn btn-danger" href="index.php?txtID= <?php echo $registro['id_usuario']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>


<?php include("../../templates/footer.php") ?>
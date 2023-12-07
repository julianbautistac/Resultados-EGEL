<?php 
session_start();
$url_base="http://localhost/EGEL2/";

if(!isset($_SESSION['usuario'])){

    header("Location:".$url_base."login.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Registro de resultados EGEL</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  


</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link active" href="" aria-current="page">Bienvenida <span class="visually-hidden">(current)</span></a>
            </li>
   
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/periodos/">Periodos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/areas/">Áreas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/carreras/">Carreras</a>
            </li>
            <!--
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/nivel/">Nivel</a>
            </li>-->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/modalidad/">Modalidad de titulación</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/alumnos/">Alumnos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/rol/">Rol de usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/usuarios/">Usuarios</a>
            </li>
  

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;  ?>logout.php">Cerrar Sesión</a>
            </li>


        </ul>
    </nav>

    <main class="container">
<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" media="all">
    <title>Registro de resultados EGEL</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="/img/04_ESCUDO-UABC-BLANCO.png" alt="UABC">
            <h2>UABC</h2>
        </div>
    </header>




    <footer>
        <p>&copy; 2023 FIAD UABC. Todos los derechos reservados.</p>
    </footer>
</body>

</html> -->
<?php include("templates/header.php") ?>

<br>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenid@ al sistema</h1>
        <h1 class="display-5 fw-bold"> para registrar calificaciones del EGEL</h1>
        <p class="col-md-8 fs-4">Usuario:<?php echo $_SESSION['usuario']; ?></p>
        
    </div>
</div>

<?php include("templates/footer.php") ?>
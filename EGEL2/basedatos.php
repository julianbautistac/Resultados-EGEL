<?php 

$servidor="localhost";
$basedatos="egel";
$user="root";
$contrasenia="bautistac5";
try{
$conexion=new PDO("mysql:host=$servidor; dbname=$basedatos",$user,$contrasenia);

}catch(Exception $ex)
{
    echo $ex->getMessage();
}
?>
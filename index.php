<?php 
session_start();
require ("logica/Apartamento.php");
require ("logica/CuentaCobro.php");
require ("logica/Estado.php");
require ("logica/Pago.php");
require ("logica/Propietario.php");
require ("logica/Admin.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjunto Residencial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php 
if(!isset($_GET["pid"])){
    include ("presentacion/inicio.php");
}else{
    include (base64_decode($_GET["pid"]));
}    
?>

</html>

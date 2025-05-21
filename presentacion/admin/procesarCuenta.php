<?php
require_once 'logica/Apartamento.php';
require_once 'logica/CuentaCobro.php';
require_once 'logica/Estado.php';
require_once 'persistencia/CobroDAO.php';
require_once 'persistencia/Conexion.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = trim($_POST["numero"] ?? "");
    $fecha = $_POST["fecha"] ?? "";
    $valor = $_POST["valor"] ?? "";
    $idAdmin = $_SESSION["id"];
    
    if (empty($numero) || empty($fecha) || empty($valor) || !$idAdmin) {
        header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&error=Datos incompletos o sesión inválida");
        exit();
    }
    
    $apartamento = new Apartamento("",$numero,"","");
    $apartamento->consultarPorNumero();
    if ($apartamento->getIdApartamento() !== null && $apartamento->getIdApartamento() !== "") {
        $estado = new Estado(1);
        $cuenta = new CuentaCobro(0, $apartamento, $estado, $fecha, $valor, $idAdmin);
        
        $cobroDAO = new CobroDAO(
            $cuenta->getId(),
            $cuenta->getApartamento()->getIdApartamento(),
            $cuenta->getEstado()->getIdEstado(),
            $cuenta->getFechaGeneracion(),
            $cuenta->getValor(),
            $cuenta->getIdAdministrador()
            );
        
        $conexion = new Conexion();
        $conexion->abrir();
        
        try {
            $conexion->ejecutar($cobroDAO->insertarCuentaCobro());
            echo $cobroDAO->insertarCuentaCobro();
            
            $conexion->cerrar();
            header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&mensaje=Cuenta creada correctamente");
        } catch (Exception $e) {
            $conexion->cerrar();
            header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&error=Error al crear la cuenta");
        }
    } else {
        header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&error=El apartamento no existe");
    }
    exit();
}
?>

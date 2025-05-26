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
    
    // Verificar que el apartamento exista
    $apartamento = new Apartamento($numero, "", "");
    $apartamentos = $apartamento->consultarPorNumero();
    
    if (empty($apartamentos)) {
        header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&error=El apartamento no existe");
        exit();
    }
    
    // Validar que no exista ya una cuenta para ese apartamento en el mismo mes
    $fechaMes = substr($fecha, 0, 7); // ej. "2025-05"
    
    $conexion = new Conexion();
    $conexion->abrir();
    
    $query = "SELECT COUNT(*) FROM cuenta_cobro WHERE numero_apartamento = '$numero' AND DATE_FORMAT(fecha_generacion, '%Y-%m') = '$fechaMes'";
    $resultado = $conexion->ejecutar($query);
    $fila = $conexion->registro($resultado);
    
    if ($fila[0] > 0) {
        $conexion->cerrar();
        header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&error=Ya existe una cuenta de cobro para este apartamento en ese mes.");
        exit();
    }
    
    // Si pasa la validación, se procede a insertar
    $estado = new Estado(1);
    $cuenta = new CuentaCobro(0, $numero, $estado, $fecha, $valor, $idAdmin);
    $cobroDAO = new CobroDAO(
        $cuenta->getId(),
        $cuenta->getNumeroApartamento(),
        $cuenta->getEstado()->getIdEstado(),
        $cuenta->getFechaGeneracion(),
        $cuenta->getValor(),
        $cuenta->getIdAdministrador()
        );
    
    try {
        $conexion->ejecutar($cobroDAO->insertarCuentaCobro());
        $conexion->cerrar();
        
        header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&mensaje=Cuenta creada correctamente");
    } catch (Exception $e) {
        $conexion->cerrar();
        header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearCuenta.php") . "&error=Error al crear la cuenta");
    }
    exit();
}
?>

<?php
require_once 'logica/Apartamento.php';
require_once 'logica/CuentaCobro.php';
require_once 'logica/Estado.php';
require_once 'persistencia/CobroDAO.php';
require_once 'persistencia/Conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = trim($_POST["numero"] ?? "");
    $bloque = trim($_POST["bloque"] ?? "");
    $fecha = $_POST["fecha"] ?? "";
    $valor = $_POST["valor"] ?? "";
    $idAdmin = $_SESSION["id"] ?? null;

    if (empty($numero) || empty($bloque) || empty($fecha) || empty($valor) || !$idAdmin) {
        header("Location: index.php?pid=" . base64_encode("presentacion/sesionAdmin.php") . "&error=Datos incompletos o sesión inválida");
        exit();
    }

    $apartamento = new Apartamento(0, $numero, $bloque);
    $apartamento->consultarPorNumeroYBloque();

    if ($apartamento->getIdApartamento() !== "") {
        $estado = new Estado(1); 
        $cuenta = new CuentaCobro(0, $apartamento, $estado, $fecha, $valor, $idAdmin);

        $cuentaDAO = new CobroDAO(
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
            $conexion->ejecutar($cuentaDAO->insertarCuentaCobro());
            $conexion->cerrar();
            header("Location: index.php?pid=" . base64_encode("presentacion/sesionAdmin.php") . "&mensaje=Cuenta creada correctamente");
        } catch (Exception $e) {
            $conexion->cerrar();
            header("Location: index.php?pid=" . base64_encode("presentacion/sesionAdmin.php") . "&error=Error al crear la cuenta");
        }

    } else {
        header("Location: index.php?pid=" . base64_encode("presentacion/sesionAdmin.php") . "&error=El apartamento no existe");
    }
    exit();
}
?>

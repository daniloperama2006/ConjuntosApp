<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("logica/CuentaCobro.php");
include_once("logica/Estado.php");
include_once("logica/Apartamento.php");
include_once("persistencia/Conexion.php");
include_once("logica/Pago.php");
include_once("persistencia/PagoDAO.php");

if (!isset($_SESSION["id"])) {
    echo "<p>Error: Sesión no iniciada.</p>";
    exit;
}

$msg = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idCuenta = $_POST['idCuenta'];
    $monto = $_POST["monto"];
    
    $idPropietario = $_SESSION["id"];
    $pago = new Pago(0, $idCuenta, date("Y-m-d H:i:s"), $monto, $idPropietario);
    $pagoDAO = new PagoDAO(
        $pago->getIdPago(),
        $pago->getIdCuenta(),
        $pago->getFechaPago(),
        $pago->getMontoPagado(),
        $pago->getIdPropietario()
        );
    
    $conexion = new Conexion();
    $conexion->abrir();
    
    try {
        $conexion->ejecutar($pagoDAO->insertarPago());
        $conexion->cerrar();
        $msg = "Pago registrado correctamente.";
    } catch (Exception $e) {
        $conexion->cerrar();
        $msg = "Error al registrar el pago.";
    }
}

if (isset($_GET['idCuenta'])) {
    $idCuenta = $_GET['idCuenta'];
    $cuentaObj = new CuentaCobro();
    $cuentas = $cuentaObj->consultarPorPropietario($_SESSION["id"]);
    $cuenta = null;
    foreach ($cuentas as $c) {
        if ($c->getId() == $idCuenta) {
            $cuenta = $c;
            break;
        }
    }
    if (!$cuenta) {
        echo "<p>Error: Cuenta no encontrada.</p>";
        exit;
    }
    
    $valor = $cuenta->getValor();
    $fecha = $cuenta->getFechaGeneracion();
    $estado = $cuenta->getEstado()->getNombreEstado();
    
    // Aquí podrías calcular saldo pendiente si tienes lógica o métodos para eso
    // Por ejemplo (solo si tienes el método):
    // $deudaTotal = $cuenta->calcularSaldoPendiente();
} else {
    echo "<p>Error: ID de cuenta no especificado.</p>";
    exit;
}
?>

<body class="bg-light">

<?php include("presentacion/encabezadoPropietario.php"); ?>

<!-- Modal de confirmación -->
<div class="modal fade" id="modalPagoExitoso" tabindex="-1" aria-labelledby="modalPagoExitosoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalPagoExitosoLabel">¡Pago realizado con éxito!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p><?php echo htmlspecialchars($msg ?? ""); ?></p>
      </div>
      <div class="modal-footer">
        <a href="index.php?pid=<?php echo base64_encode('presentacion/propietario/consultarCuenta.php'); ?>" class="btn btn-primary">
          Volver a consultar cuentas de cobro
        </a>
      </div>
    </div>
  </div>
</div>

<main class="container my-5">

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Realizar Pago</h5>
        </div>
        <div class="card-body">
            <p><strong>Cuenta ID:</strong> <?php echo htmlspecialchars($idCuenta); ?></p>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($fecha); ?></p>
            <p><strong>Valor este mes:</strong> $<?php echo number_format($valor, 2); ?></p>
            <p><strong>Estado Actual:</strong> <?php echo htmlspecialchars($estado); ?></p>
            <p><strong>Saldo Pendiente:</strong> FALTA AÑADIR</p>

            <form method="POST" action="">
                <input type="hidden" name="idCuenta" value="<?php echo htmlspecialchars($idCuenta); ?>">
                <div class="mb-3">
                    <label for="monto" class="form-label">Monto a pagar</label>
                    <input type="number" class="form-control" id="monto" name="monto" min="1" required>
                </div>
                <button type="submit" class="btn btn-success">Pagar</button>
            </form>
        </div>
    </div>

</main>

<?php if (isset($msg) && strpos($msg, 'registrado correctamente') !== false): ?>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('modalPagoExitoso'));
    myModal.show();
</script>
<?php endif; ?>

</body>

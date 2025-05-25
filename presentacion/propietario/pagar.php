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

$msg = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idCuenta = $_POST['idCuenta'];
    $monto = $_POST["monto"];
    
    // Obtener los detalles de la cuenta
    $cuentaObj = new CuentaCobro();
    $pago = new Pago();
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
    $numeroApart = $cuenta->getNumeroApartamento();
    $deudaTotal = $cuenta->consultarSaldoPendiente($numeroApart->getNumero());
    $pagoTotal = $pago->consultarPagoTotal($numeroApart->getNumero());
    
    $num1 = $pagoTotal[0] ?? 0;
    $num2 = $deudaTotal[0] ?? 0;
    
    // Verificar si el monto es mayor que el saldo pendiente
    if ($monto > $num2) {
        $msg = "Error: El monto a pagar no puede ser mayor que el saldo pendiente.";
        $showModal = false;  // No mostrar modal de éxito si hay error
    } else {
        // Realizar el pago si la validación es correcta
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
            
            // Si el monto pagado es igual al saldo pendiente, cambiar estado
            if ($monto == $num2) {
                // Cambiar estado de la cuenta de cobro a "Pendiente" (suponiendo que el estado "Pendiente" tiene el id 2)
                $cuentaDAO = new CobroDAO();
                $conexion->ejecutar($cuentaDAO->cambiarEstadoCuenta($idCuenta, 2)); // 2 sería el ID de "Pendiente"
            }
            
            $conexion->cerrar();
            $msg = "Pago registrado correctamente.";
            $showModal = true;  // Mostrar modal de éxito
        } catch (Exception $e) {
            $conexion->cerrar();
            $msg = "Error al registrar el pago.";
            $showModal = false;  // No mostrar modal de éxito si hay error
        }
    }
}


if (isset($_GET['idCuenta'])) {
    $idCuenta = $_GET['idCuenta'];
    $cuentaObj = new CuentaCobro();
    $pago = new Pago();
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
    $numeroApart = $cuenta->getNumeroApartamento();
    $deudaTotal = $cuenta->consultarSaldoPendiente($numeroApart->getNumero());
    $pagoTotal = $pago->consultarPagoTotal($numeroApart->getNumero());
    
    $num1 = $pagoTotal[0] ?? 0;
    $num2 = $deudaTotal[0] ?? 0;
} else {
    echo "<p>Error: ID de cuenta no especificado.</p>";
    exit;
}
?>

<body class="bg-light">

<?php include("presentacion/encabezadoPropietario.php"); ?>

<div class="container my-2">
    <a href="?pid=<?php echo base64_encode("presentacion/propietario/consultarCuenta.php")?>">
        <button type="button" class="btn btn-secondary">Regresar</button> 
    </a>
</div>

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
            <p><strong>Saldo Pendiente:</strong> $<?php echo number_format($num2); ?></p>

            <form method="POST" action="">
                <input type="hidden" name="idCuenta" value="<?php echo htmlspecialchars($idCuenta); ?>">
                <div class="mb-3">
                    <label for="monto" class="form-label">Monto a pagar</label>
                    <input type="number" class="form-control" id="monto" name="monto" min="1" required>
                </div>
                <button type="submit" class="btn btn-success">Pagar</button>
            </form>
            
            <?php if (isset($msg) && strpos($msg, 'Error') !== false): ?>
                <div class="alert alert-danger mt-3">
                    <?php echo htmlspecialchars($msg); ?>
                </div>
            <?php endif; ?>
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

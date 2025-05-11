<?php
include_once("logica/CuentaCobro.php");
include_once("logica/Estado.php");
include_once("logica/Apartamento.php");

if (!isset($_SESSION["id"])) {
    echo "<p>Error: Sesión no iniciada.</p>";
    exit;
}

$pagoExitoso = false;

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cuenta->pagar();
        $pagoExitoso = true;
        $cuentas = $cuentaObj->consultarPorPropietario($_SESSION["id"]);
        foreach ($cuentas as $c) {
            if ($c->getId() == $idCuenta) {
                $cuenta = $c;
                break;
            }
        }
    }

    $valor = $cuenta->getValor();
    $fecha = $cuenta->getFechaGeneracion();
    $estado = $cuenta->getEstado()->getNombreEstado();

} else {
    echo "<p>Error: ID de cuenta no especificado.</p>";
    exit;
}
?>

<section class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Realizar Pago</h5>
        </div>
        <div class="card-body">
            <p><strong>Cuenta ID:</strong> <?php echo $idCuenta; ?></p>
            <p><strong>Fecha:</strong> <?php echo $fecha; ?></p>
            <p><strong>Valor:</strong> $<?php echo number_format($valor, 2); ?></p>
            <p><strong>Estado Actual:</strong> <?php echo $estado; ?></p>

            <?php if ($estado === "PENDIENTE") { ?>
                <form method="post">
                    <button type="submit" class="btn btn-success">Pagar</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-success">Cuenta pagada con éxito</div>
            <?php } ?>

            <?php if ($pagoExitoso) { ?>
                <div class="mt-3 alert alert-info">El estado ha sido actualizado correctamente.</div>
            <?php } ?>
        </div>
    </div>
</section>

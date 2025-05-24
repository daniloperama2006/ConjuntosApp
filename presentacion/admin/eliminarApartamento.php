<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("logica/Apartamento.php");
require_once("logica/CuentaCobro.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['numero']) && !empty($_POST['id_propietario'])) {
        $a = new Apartamento($_POST['numero'], $_POST['id_propietario']);
        $c = new CuentaCobro("",$_POST['numero']);
        if($c->tieneCuentas($_POST['numero'])){
            $msg = "Error: No se pudo eliminar el apartamento tiene cuentas de cobro.";
        }
        else {
            $a->eliminar();
            $msg = "Apartamento eliminado con éxito.";
        } 
    }
}
?>

<body class="bg-light">
    <?php include("presentacion/encabezadoAdmin.php") ?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Eliminar Apartamento</h5>
        </div>
        <div class="card-body">
            <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/eliminarApartamento.php"); ?>">
                <div class="mb-3">
                    <label class="form-label">Número de Apartamento</label>
                    <input type="number" name="numero" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID del Propietario</label>
                    <input type="number" name="id_propietario" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Eliminar Apartamento</button>
            </form>
        </div>
    </div>

    <?php if (isset($msg)): ?>
    <div class="alert alert-<?php echo (strpos($msg, "Error") !== false ? "danger" : "success"); ?> mt-4">
        <?php echo $msg; ?>
    </div>
    <?php endif; ?>
</main>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("logica/Apartamento.php");
require_once("logica/CuentaCobro.php");

$msg = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroAntiguo = $_POST['numero_antiguo'] ?? '';
    $idAntiguo = $_POST['id_antiguo'] ?? '';
    $numeroNuevo = $_POST['numero'] ?? '';
    $idNuevo = $_POST['id_propietario'] ?? '';
    
    if (!empty($numeroAntiguo) && !empty($idAntiguo) && !empty($numeroNuevo) && !empty($idNuevo)) {
        $cuenta = new CuentaCobro("", $numeroAntiguo);
        if ($cuenta->tieneCuentas($numeroAntiguo)) {
            $msg = "Error: No se puede actualizar. El apartamento original tiene cuentas de cobro asociadas.";
        } else {
            $apartamento = new Apartamento($numeroAntiguo, $idAntiguo);
            $apartamento->eliminar();
            
            $nuevoApartamento = new Apartamento($numeroNuevo, $idNuevo);
            $nuevoApartamento->insertar();
            
            $msg = "Apartamento actualizado con éxito.";
        }
    }
}
?>

<body class="bg-light">
    <?php include("presentacion/encabezadoAdmin.php") ?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Actualizar Apartamento</h5>
        </div>
        <div class="card-body">
            <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/actualizarApartamento.php"); ?>">
                <div class="mb-3">
                    <label class="form-label">Número Antiguo</label>
                    <input type="number" name="numero_antiguo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Propietario Antiguo</label>
                    <input type="number" name="id_antiguo" class="form-control" required>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Nuevo Número de Apartamento</label>
                    <input type="number" name="numero" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nuevo ID del Propietario</label>
                    <input type="number" name="id_propietario" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning w-100">Actualizar Apartamento</button>
            </form>
        </div>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-<?php echo (strpos($msg, "Error") !== false ? "danger" : "success"); ?> mt-4">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>
</main>

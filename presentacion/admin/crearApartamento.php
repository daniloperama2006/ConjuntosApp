<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("logica/Apartamento.php");

$msg = ""; // Inicializar mensaje

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['numero']) && !empty($_POST['id_propietario'])) {
        $a = new Apartamento($_POST['numero'], $_POST['id_propietario']);
        try {
            $a->insertar();
            $msg = "Apartamento creado con éxito.";
        } catch (Exception $e) {
            if (str_contains($e->getMessage(), 'Duplicate') || str_contains($e->getMessage(), 'duplicada')) {
                $msg = "Error: Ya existe un apartamento con ese número.";
            } else {
                $msg = "Error al crear apartamento: " . $e->getMessage();
            }
        }
    }
}
?>

<body class="bg-light">
	<?php include("presentacion/encabezadoAdmin.php")?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Registrar Nuevo Apartamento</h5>
        </div>
        <div class="card-body">
            <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/crearApartamento.php"); ?>">
                <input type="hidden" name="accion" value="crear">
                <div class="mb-3">
                    <label class="form-label">Número de Apartamento</label>
                    <input type="number" name="numero" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID del Propietario</label>
                    <input type="number" name="id_propietario" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Crear Apartamento</button>
            </form>
        </div>
    </div>
    
    <?php if (!empty($msg)): ?>
    <div class="alert alert-<?php echo (strpos($msg, "Error") !== false ? "danger" : "success"); ?> mt-4">
        <?php echo $msg; ?>
    </div>
	<?php endif; ?>
</main>

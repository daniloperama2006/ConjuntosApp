<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("logica/Propietario.php");

$msg = null;
$propietario = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'actualizar') {
    if (!empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo'])) {
        $propietario = new Propietario($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['correo']);
        $msg = "Propietario actualizado con éxito.";
    }
} elseif (isset($_GET['accion']) && $_GET['accion'] === 'consultar' && !empty($_GET['id'])) {
    $propietario = new Propietario($_GET['id']);
    if (!$propietario->consultarInformacion()) {
        $msg = "Propietario no encontrado.";
        $propietario = null;
    }
}

?>

<body class="bg-light">
    <?php include("presentacion/encabezadoAdmin.php") ?>
</body>

<main class="container my-5">
    <!-- Formulario para consultar por ID -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Actualizar Propietario por ID</h5>
        </div>
        <div class="card-body">
            <form method="get" action="">
                <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/admin/actualizarPropietario.php"); ?>">
                <input type="hidden" name="accion" value="consultar">
                <div class="mb-3">
                    <label class="form-label">ID del Propietario</label>
                    <input type="number" name="id" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($propietario): ?>
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Editar Propietario</h5>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="id" value="<?php echo $propietario->getId(); ?>">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo $propietario->getNombre(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="<?php echo $propietario->getApellido(); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" value="<?php echo $propietario->getCorreo(); ?>" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($msg): ?>
        <div class="alert alert-<?php echo (strpos($msg, "Propietario no encontrado.") !== false ? "danger" : "success"); ?> mt-4">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>
</main>

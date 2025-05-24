<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("logica/Propietario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo']) && !empty($_POST['clave'])) {
        $p = new Propietario("", $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['clave']);
        $p->insertar();
        $msg = "Propietario creado con éxito.";
    }
}
?>

<body class="bg-light">
	<?php include("presentacion/encabezadoAdmin.php");	?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Registrar Nuevo Propietario</h5>
        </div>
        <div class="card-body">
            <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/crearPropietario.php"); ?>">
                <input type="hidden" name="accion" value="crear">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Clave</label>
                    <input type="password" name="clave" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Crear Propietario</button>
            </form>
        </div>
    </div>
   
    
    <?php if (isset($msg)): ?>
    <div class="alert alert-<?php echo (strpos($msg, "Error") !== false ? "danger" : "success"); ?> mt-4">
        <?php echo $msg; ?>
    </div>
	<?php endif; ?>
    
</main>


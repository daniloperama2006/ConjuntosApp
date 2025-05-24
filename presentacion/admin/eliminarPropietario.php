<?php
require_once("logica/Propietario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proceso eliminación
    $accion = $_POST['accion'] ?? null;
    if ($accion === 'eliminar' && !empty($_POST['id'])) {
        $p = new Propietario($_POST['id']);
        if ($p->contarApartamentos() > 0) {
            // No puede eliminar
            $msg = "No se puede eliminar el propietario. Tiene apartamentos asociados.";
            header("Location: index.php?pid=" . base64_encode("presentacion/admin/eliminarPropietario.php") . "&mensaje=" . urlencode($msg));
            exit();
        } else {
            $p->eliminar();
            $msg = "Propietario eliminado.";
            header("Location: index.php?pid=" . base64_encode("presentacion/admin/eliminarPropietario.php") . "&mensaje=" . urlencode($msg));
            exit();
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
            <h5 class="mb-0">Eliminar Propietario</h5>
        </div>
        <div class="card-body">

            <!-- Formulario para consultar por ID -->
            <form method="get" action="" class="mb-4">
                <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/admin/eliminarPropietario.php"); ?>">
                <input type="hidden" name="accion" value="consultar">

                <div class="mb-3">
                    <label class="form-label">ID del Propietario</label>
                    <input type="number" name="id" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Consultar por ID</button>
                </div>
            </form>

            <?php
            // Mostrar mensaje si viene por GET después de eliminar o error
            if (isset($_GET['mensaje'])) {
                echo "<div class='alert alert-success mt-4'>" . htmlspecialchars($_GET['mensaje']) . "</div>";
            }

            // Proceso consulta
            if (isset($_GET['accion']) && $_GET['accion'] == "consultar" && !empty($_GET['id'])) {
                $propietario = new Propietario($_GET['id']);
                if ($propietario->consultarInformacion()) {
                    $tieneApartamentos = $propietario->contarApartamentos() > 0;

                    if ($tieneApartamentos) {
                        echo "<div class='alert alert-danger mt-4'>Este propietario no puede ser eliminado porque tiene apartamentos asociados.<br>Cantidad de apartamentos asociados: " . $propietario->contarApartamentos() . "</div>";
                    }
                    ?>
                    <div class="card mt-4 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Datos del Propietario</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>ID:</strong> <?php echo $propietario->getId(); ?></p>
                            <p><strong>Nombre:</strong> <?php echo $propietario->getNombre(); ?></p>
                            <p><strong>Apellido:</strong> <?php echo $propietario->getApellido(); ?></p>
                            <p><strong>Correo:</strong> <?php echo $propietario->getCorreo(); ?></p>

                            <!-- Formulario para confirmar eliminación -->
                            <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/eliminarPropietario.php"); ?>">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?php echo $propietario->getId(); ?>">
                                <?php if (!$tieneApartamentos): ?>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-danger">Eliminar Propietario</button>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<div class='alert alert-danger mt-4'>No se encontró el propietario con ID " . htmlspecialchars($_GET['id']) . "</div>";
                }
            }
            ?>
        </div>
    </div>
</main>

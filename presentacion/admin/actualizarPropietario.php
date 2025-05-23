<body class="bg-light">
	<?php include("presentacion/encabezadoAdmin.php")?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Buscar Propietario por ID</h5>
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

    <?php
    require_once 'logica/Propietario.php';
    
    if (isset($_GET['accion']) && $_GET['accion'] == "consultar" && !empty($_GET['id'])) {
        $propietario = new Propietario($_GET['id']);
        if ($propietario->consultarInformacion()) {
            // Si se encontró el propietario, se muestra el formulario editable
            ?>
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Editar Propietario</h5>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/procesarPropietario.php"); ?>">
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
        <?php
    } else {
        echo "<div class='alert alert-danger mt-4'>No se encontró el propietario con ID " . $_GET['id'] . "</div>";
    }
}
?>
    
</main>

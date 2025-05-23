<body class="bg-light">
	<?php include("presentacion/encabezadoAdmin.php")?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Registrar Nuevo Apartamento</h5>
        </div>
        <div class="card-body">
            <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/procesarApartamento.php"); ?>">
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
</main>

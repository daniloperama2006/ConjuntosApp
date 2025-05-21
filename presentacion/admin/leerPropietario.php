<body class="bg-light">
	<?php include("presentacion/encabezadoAdmin.php")?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Consultar Propietario</h5>
        </div>
        <div class="card-body">

            <form method="get" action="" class="mb-4">
                <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/admin/leerPropietario.php"); ?>">
                <input type="hidden" name="accion" value="consultar">

                <div class="mb-3">
                    <label class="form-label">ID del Propietario</label>
                    <input type="number" name="id" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Consultar por ID</button>
                </div>
            </form>

            <form method="get" action="">
                <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/admin/leerPropietario.php"); ?>">
                <input type="hidden" name="accion" value="todos">

                <div class="d-grid">
                    <button type="submit" class="btn btn-secondary">Consultar Todos</button>
                </div>
            </form>

        </div>
    </div>

    <?php
    require_once 'logica/Propietario.php';

    if (isset($_GET['accion'])) {
        if ($_GET['accion'] == "consultar" && !empty($_GET['id'])) {
            $propietario = new Propietario($_GET['id']);
            $propietario->consultar();

            echo "<div class='mt-4 alert alert-light'>";
            echo "<strong>ID:</strong> " . $propietario->getId() . "<br>";
            echo "<strong>Nombre:</strong> " . $propietario->getNombre() . "<br>";
            echo "<strong>Apellido:</strong> " . $propietario->getApellido() . "<br>";
            echo "<strong>Correo:</strong> " . $propietario->getCorreo() . "<br>";
            echo "</div>";
        } elseif ($_GET['accion'] == "todos") {
            $temp = new Propietario();
            $todos = $temp->consultarTodos();

            echo "<table class='table table-bordered table-striped mt-4'>";
            echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr></thead><tbody>";
            foreach ($todos as $p) {
                echo "<tr><td>{$p[0]}</td><td>{$p[1]}</td><td>{$p[2]}</td><td>{$p[3]}</td></tr>";
            }
            echo "</tbody></table>";
        }
    }
    ?>
</main>

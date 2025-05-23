<body class="bg-light">
	<?php include("presentacion/encabezadoAdmin.php")?>
</body>


<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Consultar Apartamento</h5>
        </div>
        <div class="card-body">

            <form method="get" action="" class="mb-4">
                <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/admin/leerApartamento.php"); ?>">
                <input type="hidden" name="accion" value="consultar">

                <div class="mb-3">
                    <label class="form-label">Número del Apartamento</label>
                    <input type="number" name="numero" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Consultar por Número</button>
                </div>
            </form>

            <form method="get" action="">
                <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/admin/leerApartamento.php"); ?>">
                <input type="hidden" name="accion" value="todos">

                <div class="d-grid">
                    <button type="submit" class="btn btn-secondary">Consultar Todos</button>
                </div>
            </form>

        </div>
    </div>

    <?php
    require_once 'logica/Apartamento.php'; // Asegúrate de que esta clase exista y use ApartDAO correctamente

    if (isset($_GET['accion'])) {
        if ($_GET['accion'] == "consultar" && !empty($_GET['numero'])) {
            $apartamentoConsulta = new Apartamento(0, $_GET['numero']);
            $apartamentos = $apartamentoConsulta->consultarPorNumero();
            
            if (count($apartamentos) > 0) {
                echo "<div class='mt-4'>";
                foreach ($apartamentos as $apt) {
                    $propietario = new Propietario($apt['id_propietario']);
                    $propietario->consultarNombre();
                    
                    echo "<div class='alert alert-light mb-3'>";
                    echo "<strong>ID Registro:</strong> " . $apt['idApartamento'] . "<br>";
                    echo "<strong>Número Apartamento:</strong> " . $apt['numero'] . "<br>";
                    echo "<strong>Creado en:</strong> " . $apt['created_at'] . "<br>";
                    echo "<strong>ID Propietario:</strong> " . $apt['id_propietario'] . "<br>";
                    echo "<strong>Nombre y Apellido:</strong> " . $propietario->getNombre() . " " . $propietario->getApellido() . "<br>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mt-4'>No se encontraron apartamentos con ese número.</div>";
            }
        }
        elseif ($_GET['accion'] == "todos") {
            $temp = new Apartamento();
            $todos = $temp->consultarTodos();

            echo "<table class='table table-bordered table-striped mt-4'>";
            echo "<thead><tr><th>ID registro</th><th>Id Propietario</th><th>Número Apartamento</th><th>Nombre Propietario</th><th>Apellido Propietario</th><th>Fue Creado</th></tr></thead><tbody>";
            foreach ($todos as $a) {
                echo "<tr>
                <td>{$a[0]}</td>
                <td>{$a[1]}</td>
                <td>{$a[2]}</td>
                <td>{$a[3]}</td>
                <td>{$a[4]}</td>
                <td>{$a[5]}</td>
            </tr>";
            }
            echo "</tbody></table>";
            
        }
    }
    ?>
</main>


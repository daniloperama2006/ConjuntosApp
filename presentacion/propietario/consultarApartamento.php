<body class="bg-light">
	<?php include("presentacion/encabezadoPropietario.php")?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Consultar Apartamento</h5>
    </div>
    <div class="card-body">

        <form method="get" action="" class="mb-4">
            <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/propietario/consultarApartamento.php"); ?>">

            <div class="mb-3">
                <label class="form-label">Número del Apartamento (opcional)</label>
                <input type="number" name="numero" class="form-control">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="accion" value="buscar" class="btn btn-primary">Buscar</button>
                <button type="submit" name="accion" value="todos" class="btn btn-secondary">Mostrar Todos</button>
            </div>
        </form>

    </div>
</div>


    <?php
    require_once 'logica/Apartamento.php';
    
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];
        $numero = $_GET['numero'] ?? null;
        $idPropietario = $_SESSION['id']; // Asegúrate de tener la sesión iniciada correctamente
        
        $apartamento = new Apartamento($numero, $idPropietario);
        
        if ($accion == "buscar" && !empty($numero)) {
            $resultados = $apartamento->consultarApartamentoPorPropietario();
        } elseif ($accion == "todos") {
            $resultados = $apartamento->consultarTodosPorPropietario();
        }
        
        if (!empty($resultados)) {
            echo "<table class='table table-bordered table-striped mt-4'>";
            echo "<thead><tr><th>Número Apartamento</th><th>Creado en</th></tr></thead><tbody>";
            foreach ($resultados as $a) {
                echo "<tr>
                    <td>{$a['numero']}</td>
                    <td>{$a['created_at']}</td>
                </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning mt-4'>No se encontraron resultados.</div>";
        }
    }
    
    ?>
</main>
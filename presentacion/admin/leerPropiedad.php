<body class="bg-light">
	<?php include("presentacion/encabezadoAdmin.php")?>
</body>

<main class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Consultar Apartamento</h5>
        </div>
        <div class="card-body">
            <form method="get" action="">
                <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/leerPropiedad.php"); ?>">
                <div class="mb-3">
                    <label class="form-label">Número de Apartamento (opcional)</label>
                    <input type="number" name="numero" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Consultar</button>
            </form>
        </div>
    </div>

    <?php
    require_once 'logica/Apartamento.php';

    if (isset($_GET['numero']) && $_GET['numero'] != "") {
        $apto = new Apartamento(0, $_GET['numero']);
        if ($apto->consultarPorNumero()) {
            echo "<div class='mt-4 alert alert-light'>";
            echo "<strong>ID:</strong> " . $apto->getIdApartamento() . "<br>";
            echo "<strong>Número:</strong> " . $apto->getNumero() . "<br>";
            echo "<strong>ID Propietario:</strong> " . $apto->getPropietario() . "<br>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger mt-4'>No se encontró ese apartamento.</div>";
        }
    } else {
        // Suponiendo que agregues un método consultarTodos en Apartamento los apartamentos asociados a un cliente
        
    }
    ?>
</main>

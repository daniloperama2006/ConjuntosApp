<body>
    <?php include("presentacion/encabezadoPropietario.php") ?>

    <main class="container my-5">

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Consultar Pagos Realizados</h5>
            </div>
            <div class="card-body">
                <form method="get" action="" class="mb-4">
                    <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/propietario/consultarPago.php"); ?>">

                    <div class="mb-3">
                        <label class="form-label">Número del Apartamento (opcional)</label>
                        <input type="number" name="numeroApartamento" class="form-control" value="<?php echo $_GET['numeroApartamento'] ?? '' ?>">
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="submit" name="accion" value="buscar" class="btn btn-primary">Buscar por Apartamento</button>
                        <button type="submit" name="accion" value="todos" class="btn btn-secondary">Mostrar Todos Mis Pagos</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        include_once("logica/Pago.php");
        
        if (isset($_GET['accion'])) {
            $accion = $_GET['accion'];
            $idPropietario = $_SESSION['id'];
            $pago = new Pago();
            $pagos = [];
        
            if ($accion == "buscar" && !empty($_GET['numeroApartamento'])) {
                $numero = (int)$_GET['numeroApartamento'];
                $pagos = $pago->consultarPorPropiedad($idPropietario, $numero);
            } elseif ($accion == "todos") {
                $pagos = $pago->consultarPagosPorPropietario($idPropietario); // Esto devuelve array asociativo
            }
        
            if (!empty($pagos)) {
                echo "<div class='card shadow-sm'>";
                echo "<div class='card-header bg-light'><h5 class='mb-0'>Historial de Pagos</h5></div>";
                echo "<div class='card-body'>";
                echo "<table class='table table-bordered table-striped'>";
                
                // Encabezado de tabla
                echo "<thead><tr>
                        <th>ID Pago</th>
                        <th>ID Cuenta</th>
                        <th>Fecha de Pago</th>
                        <th>Monto Pagado</th>";
                
                if ($accion == "todos") {
                    echo "<th>Número de Apartamento</th>";
                }
        
                echo "</tr></thead><tbody>";
        
                // Cuerpo de la tabla
                foreach ($pagos as $p) {
                    echo "<tr>";
        
                    if ($accion == "todos") {
                        // $p es un array asociativo
                        echo "<td>" . $p['id_pago'] . "</td>";
                        echo "<td>" . $p['id_cuenta'] . "</td>";
                        echo "<td>" . $p['fecha_pago'] . "</td>";
                        echo "<td>$" . number_format($p['monto_pagado'], 2) . "</td>";
                        echo "<td>" . $p['numero_apartamento'] . "</td>";
                    } else {
                        // $p es un objeto Pago
                        echo "<td>" . $p->getIdPago() . "</td>";
                        echo "<td>" . $p->getIdCuenta() . "</td>";
                        echo "<td>" . $p->getFechaPago() . "</td>";
                        echo "<td>$" . number_format($p->getMontoPagado(), 2) . "</td>";
                    }
        
                    echo "</tr>";
                }
        
                echo "</tbody></table></div></div>";
            } else {
                echo "<div class='alert alert-warning'>No se encontraron pagos registrados.</div>";
            }
        }
        ?>


    </main>
</body>

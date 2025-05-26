<body>
    <?php include("presentacion/encabezadoPropietario.php") ?>

    <main class="container my-5">

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Consultar Cuentas de Cobro</h5>
            </div>
            <div class="card-body">
                <form method="get" action="" class="mb-4">
                    <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/propietario/consultarCuenta.php"); ?>">

                    <div class="mb-3">
                        <label class="form-label">Número del Apartamento (opcional)</label>
                        <input type="number" name="numeroApartamento" class="form-control" value="<?php echo $_GET['numeroApartamento'] ?? '' ?>">
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="submit" name="accion" value="buscar" class="btn btn-primary">Buscar por Apartamento</button>
                        <button type="submit" name="accion" value="todos" class="btn btn-secondary">Mostrar Todas mis Cuentas</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        require_once 'logica/CuentaCobro.php';

        if (isset($_GET['accion'])) {
            $accion = $_GET['accion'];
            $idPropietario = $_SESSION['id'];
            $cuentaCobro = new CuentaCobro();
            $resultados = [];
            $saldoGlobal = 0;

            if ($accion == "buscar" && !empty($_GET['numeroApartamento'])) {
                $numero = (int)$_GET['numeroApartamento'];
                $resultados = $cuentaCobro->consultarPorApartamento($numero,$idPropietario);
            } elseif ($accion == "todos") {
                $resultados = $cuentaCobro->consultarPorPropietario($idPropietario);
            }

            if (!empty($resultados)) {
                echo "<div class='card shadow-sm'>";
                echo "<div class='card-header bg-light'>";
                echo "<h5 class='mb-0'>Resultados de Cuentas de Cobro</h5>";
                echo "</div>";
                echo "<div class='card-body'>";
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead><tr>
                        <th>ID Cuenta</th>
                        <th>Apartamento</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr></thead><tbody>";

                foreach ($resultados as $cuenta) {
                    $idCuenta = $cuenta->getId();
                    $numeroApto = is_object($cuenta->getNumeroApartamento()) 
                                  ? $cuenta->getNumeroApartamento()->getNumero() 
                                  : $cuenta->getNumeroApartamento();
                    $fecha = $cuenta->getFechaGeneracion();
                    $valor = number_format($cuenta->getValor(), 2);
                    $estado = is_object($cuenta->getEstado()) 
                              ? $cuenta->getEstado()->getNombreEstado() 
                              : $cuenta->getEstado();

                    echo "<tr>";
                    echo "<td>$idCuenta</td>";
                    echo "<td>$numeroApto</td>";
                    echo "<td>$fecha</td>";
                    echo "<td>$$valor</td>";
                    echo "<td>$estado</td>";

                    if (strtoupper($estado) == "PENDIENTE" || strtoupper($estado) == "EN MORA") {
                        $accionLink = "<a href='?pid=" . base64_encode("presentacion/propietario/pagar.php") . "&idCuenta={$idCuenta}'>Pagar</a>";
                    } else {
                        $accionLink = "Pagada";
                    }

                    echo "<td>$accionLink</td>";
                    echo "</tr>";
                }

                echo "</tbody></table></div></div>";
            } else {
                echo "<div class='alert alert-warning'>No se encontraron resultados.</div>";
            }
            
        }
        ?>

    </main>
</body>

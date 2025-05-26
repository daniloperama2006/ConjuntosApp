<body class="bg-light">
<?php include("presentacion/encabezadoAdmin.php")?>
<?php
    require_once 'logica/Apartamento.php';
    $apartamento = new Apartamento();
    $totalApartamentos = count($apartamento->consultarTodos());
    $administracionTotal = 5000000;
    $valorEstimado = $totalApartamentos > 0 ? round($administracionTotal / $totalApartamentos) : 0;
?>

<main class="container my-5">
    <div class="row g-4">

        <section class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Generar Nueva Cuenta de Cobro</h5>
                </div>
                
                <div class="card-body">
                    <form id="formGenerarCobro" method="post" action="index.php?pid=<?php echo base64_encode("presentacion/admin/procesarCuenta.php"); ?>">
                    <?php if (isset($_GET['mensaje'])) { ?>
                        <div class="container mt-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo htmlspecialchars($_GET['mensaje']); ?>
                            </div>
                        </div>
                    <?php } elseif (isset($_GET['error'])) { ?>
                        <div class="container mt-4">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="mb-3">
                                <div class="mb-3">
                                    <label for="inputNumero" class="form-label">Número de Apartamento</label>
                                    <input id="inputNumero" name="numero" type="text" class="form-control" required>
                                </div>
                            <div class="mb-3">
                                <label for="inputFecha" class="form-label">Fecha de Generación</label>
                                <input id="inputFecha" name="fecha" type="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="valor" class="form-label">Valor</label>
    								<input id="inputValor" name="valor" type="number" step="0.01" class="form-control" value="<?php echo $valorEstimado; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Crear Cuenta</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cuentas de Cobro</h5>
                    <form method="get" class="d-flex gap-2">
                        <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/admin/crearCuenta.php"); ?>">
                        <button type="submit" name="estado" value="1" class="btn btn-sm btn-outline-dark">Pendientes</button>
                        <button type="submit" name="estado" value="2" class="btn btn-sm btn-outline-dark">Pagadas</button>
                        <button type="submit" name="estado" value="3" class="btn btn-sm btn-outline-dark">En Mora</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="tablaCuentasAdmin">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Apartamento</th>
                                <th>Fecha</th>
                                <th>Valor</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once 'logica/CuentaCobro.php';
                            require_once 'logica/Apartamento.php';
                            require_once 'logica/Estado.php';

                            $estadoSeleccionado = isset($_GET['estado']) ? intval($_GET['estado']) : 1;

                            $cuenta = new CuentaCobro();
                            $cuentas = $cuenta->consultarPorEstado($estadoSeleccionado);

                            if (empty($cuentas)) {
                                echo "<tr><td colspan='5' class='text-center'>No hay cuentas disponibles</td></tr>";
                            } else {
                                foreach ($cuentas as $cuenta) {
                                    echo "<tr>";
                                    echo "<td>" . $cuenta->getId() . "</td>";
                                    echo "<td>" . $cuenta->getNumeroApartamento() . "</td>";
                                    echo "<td>" . $cuenta->getFechaGeneracion() . "</td>";
                                    echo "<td>$" . number_format($cuenta->getValor(), 2) . "</td>";
                                    echo "<td>" . $cuenta->getEstado()->getNombreEstado() . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
</main>


</body>
</html>

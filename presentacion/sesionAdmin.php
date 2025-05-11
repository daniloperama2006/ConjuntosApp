<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img width="75" height="75" src="https://img.icons8.com/bubbles/100/building.png" alt="building"/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div>
            <p class="text-white">
                <?php
                $id = $_SESSION["id"];
                $admin = new Usuario($id);
                $admin->consultar();
                echo "Admin: " . $admin->getNombre() . " " . $admin->getApellido();
                ?>
            </p>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="?pid=<?php echo base64_encode("presentacion/cerrarSesion.php") ?>" class="nav-link">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-5">
    <div class="row g-4">

        <section class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Generar Nueva Cuenta de Cobro</h5>
                </div>
                <div class="card-body">
                    <form id="formGenerarCobro" method="post" action="procesar_cuenta.php">
                        <div class="mb-3">
                            <label for="selectApartamento" class="form-label">Apartamento</label>
                            <select id="selectApartamento" name="apartamento" class="form-select">
                                <option value="">-- Selecciona apartamento --</option>
                                <!-- Aquí puedes cargar los apartamentos disponibles -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputFecha" class="form-label">Fecha de Generación</label>
                            <input id="inputFecha" name="fecha" type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="inputValor" class="form-label">Valor</label>
                            <input id="inputValor" name="valor" type="number" step="0.01" class="form-control" placeholder="0.00">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Crear Cuenta</button>
                    </form>
                </div>
            </div>
        </section>

        <section class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cuentas de Cobro</h5>
                    <form method="get" class="d-flex gap-2">
                        <input type="hidden" name="pid" value="<?php echo base64_encode("presentacion/sesionAdmin.php"); ?>">
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
                                    echo "<td>" . $cuenta->getApartamento()->getNumero() . "</td>";
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

<footer class="bg-dark text-white text-center py-4 mt-5">
    <p>&copy; 2025 Conjunto Residencial. Todos los derechos reservados.</p>
</footer>

</body>
</html>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img width="75" height="75" src="https://img.icons8.com/bubbles/100/building.png" alt="building"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div>
                <p class="text-white"><?php
                    $id = $_SESSION["id"];
                    $propietario = new Usuario($id);
                    $propietario -> consultar();
                    echo "Propietario: " . $propietario -> getNombre() . " " . $propietario -> getApellido();
                    ?></p>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="?pid=<?php echo base64_encode("presentacion/cerrarSesion.php")?>" class="nav-link" data-bs-toggle="modal">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">

    <!-- Filtro de Cuentas -->
    <div class="d-flex justify-content-end mb-3">
      <button id="btnPropPendientes" class="btn btn-outline-dark me-2">Pendientes</button>
      <button id="btnPropPagadas"   class="btn btn-outline-dark">Pagadas</button>
    </div>

    <!-- Tabla de Cuentas de Cobro -->
    <div class="card shadow-sm">
      <div class="card-header bg-light">
        <h5 class="mb-0">Mis Cuentas de Cobro</h5>
      </div>
      <div class="card-body">
        <table class="table table-hover" id="tablaCuentasProp">
          <thead>
            <tr>
              <th>Id_Cuenta</th>
              <th>Apartamento</th>
              <th>Fecha</th>
              <th>Valor</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $id = $_SESSION["id"];
              $cuenta = new CuentaCobro();
              $cuentas = $cuenta->consultarPorPropietario($id);

              foreach ($cuentas as $cuenta) {
                  $idCuenta = $cuenta->getId();
                  $numeroApto = $cuenta->getApartamento()->getNumero();
                  $fecha = $cuenta->getFechaGeneracion();
                  $valor = $cuenta->getValor();
                  $estado = $cuenta->getEstado()->getNombreEstado();
                  $idEstado = $cuenta->getEstado()->getIdEstado();

                  echo "<tr>";
                  echo "<td>$idCuenta</td>";
                  echo "<td>$numeroApto</td>";
                  echo "<td>$fecha</td>";
                  echo "<td>$$valor</td>";
                  echo "<td>$estado</td>";

                  if ($estado == "PENDIENTE" || $estado == "EN MORA") {
                      $accion = "<a href='?pid=" . base64_encode("presentacion/pagar.php") . "&idCuenta={$cuenta->getId()}'>Pagar</a>";
                  } else {
                      $accion = "Pagada";
                  }
                  echo "<td>$accion</td>";
                  echo "</tr>";
              }

            ?>
          </tbody>
        </table>
      </div>
    </div>

  </main>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p>&copy; 2025 Conjunto Residencial. Todos los derechos reservados.</p>
    </footer>

</body>
</html>

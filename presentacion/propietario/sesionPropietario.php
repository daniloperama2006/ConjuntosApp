<body>

    <?php include("presentacion/encabezadoPropietario.php")?>

    <main class="container my-5">


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


</body>
</html>

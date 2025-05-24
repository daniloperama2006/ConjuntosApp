<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../logica/Propietario.php";
require_once __DIR__ . "/../logica/Admin.php";

$msg = "";

if (isset($_POST["autenticar"])) {
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    
    $propietario = new Propietario("", "", "", $correo, $clave);
    $admin = new Admin("", "", "", $correo, $clave);
    
    if ($propietario->autenticar()) {
        $_SESSION["id"] = $propietario->getId();
        $_SESSION["rol"] = "propietario";
        header("Location: ?pid=" . base64_encode("presentacion/propietario/sesionPropietario.php"));
        exit();
    } elseif ($admin->autenticar()) {
        $_SESSION["id"] = $admin->getId();
        $_SESSION["rol"] = "admin";
        header("Location: ?pid=" . base64_encode("presentacion/admin/inicioAdmin.php"));
        exit();
    } else {
        $msg = "Error: Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Autenticar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img width="55" height="55" src="https://img.icons8.com/ios-filled/100/ffffff/city-buildings.png" alt="Conjunto Residencial" />
      </a>
    </div>
  </nav>

  <div class="container my-5 d-flex justify-content-center align-items-start" style="min-height:70vh;">
    <div class="card shadow" style="max-width:420px; width:100%;">
      <div class="card-header bg-primary text-white text-center">
        <h4 class="mb-0">Autenticar</h4>
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="mb-3">
            <input type="email" name="correo" class="form-control" placeholder="Correo" required />
          </div>

          <div class="mb-3">
            <input type="password" name="clave" class="form-control" placeholder="Clave" required />
          </div>

          <button type="submit" class="btn btn-primary w-100" name="autenticar">Autenticar</button>
        </form>

        <div class="text-center mt-3">
          <a href="index.php?pid=<?php echo base64_encode("presentacion/nuevoPropietario.php"); ?>" class="btn btn-link">
            ¿No tienes cuenta? Regístrate como Propietario
          </a>
        </div>

        <?php if (!empty($msg)): ?>
          <div class="alert alert-danger mt-4 text-center">
            <?php echo $msg; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="card-footer text-center">
        <a href="?pid=<?php echo base64_encode("presentacion/inicio.php"); ?>" class="btn btn-secondary">Regresar</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("logica/Propietario.php");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo']) && !empty($_POST['clave'])) {
        $p = new Propietario("", $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['clave']);
        if ($p->existeCorreo($_POST['correo'])) {
            $msg = "Error: Ya existe un correo asociado a otro propietario";
        } else {
            $p->insertar();
            header("Location: ?pid=" . base64_encode("presentacion/autenticar.php"));
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registrar Nuevo Propietario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img width="60" height="60" src="https://img.icons8.com/ios-filled/100/ffffff/city-buildings.png" alt="Conjunto Residencial" />
      </a>
    </div>
  </nav>

  <div class="container my-5 d-flex justify-content-center align-items-start" style="min-height:70vh;">
    <div class="card shadow" style="max-width:420px; width:100%;">
      <div class="card-header bg-primary text-white text-center">
        <h4 class="mb-0">Registrar Nuevo Propietario</h4>
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" type="text" name="nombre" class="form-control" required />
          </div>

          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input id="apellido" type="text" name="apellido" class="form-control" required />
          </div>

          <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input id="correo" type="email" name="correo" class="form-control" required />
          </div>

          <div class="mb-3">
            <label for="clave" class="form-label">Clave</label>
            <input id="clave" type="password" name="clave" class="form-control" required />
          </div>

          <button type="submit" class="btn btn-success w-100">Crear Propietario</button>
        </form>

        <?php if (!empty($msg)): ?>
          <div class="alert alert-<?php echo (strpos($msg, "Error") !== false ? "danger" : "success"); ?> mt-4 text-center">
            <?php echo $msg; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="card-footer text-center">
        <a href="?pid=<?php echo base64_encode("presentacion/inicio.php"); ?>" class="btn btn-secondary">Regresar al inicio</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

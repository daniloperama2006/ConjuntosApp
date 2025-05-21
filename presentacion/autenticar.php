<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../logica/Propietario.php";
require_once __DIR__ . "/../logica/Admin.php";
require_once __DIR__ . "/../persistencia/Conexion.php";

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
        echo "Error: Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"><title>Autenticar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img width="55" height="55" src="https://img.icons8.com/ios-filled/100/ffffff/city-buildings.png" alt="Conjunto Residencial"/>
            </a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        </div>
    </nav>
    

    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-4">
        	<div class="container my-2">
                <a href="?pid=<?php echo base64_encode("presentacion/inicio.php")?>"><button type="button" class="btn btn-secondary">Regresar</button> </a>
            </div>
          <div class="card">
            <div class="card-header bg-primary"><h4>Autenticar</h4></div>
            <div class="card-body">
              <form method="post">
                <div class="mb-3">
                  <input type="email" class="form-control" name="correo" placeholder="Correo" required>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" name="clave" placeholder="Clave" required>
                </div>
                <button type="submit" class="btn btn-primary" name="autenticar">Autenticar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>

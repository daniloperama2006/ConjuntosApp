<?php
define("ROL_ADMIN",       "1");
define("ROL_PROPIETARIO", "2");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../logica/Usuario.php";
require_once __DIR__ . "/../persistencia/Conexion.php";


if(isset($_POST["autenticar"])){
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    $usuario = new Usuario("", "", "", $correo, $clave); 

    if($usuario -> autenticar()){
        $_SESSION["id"] = $usuario -> getIdUsuario();
        $_SESSION["rol"] = $usuario -> getIdRol(); 

        if($_SESSION["rol"] == ROL_ADMIN){
            header("Location: ?pid=" . base64_encode("presentacion/sesionAdmin.php"));
            exit();
        } elseif($_SESSION["rol"] == ROL_PROPIETARIO){
            header("Location: ?pid=" . base64_encode("presentacion/sesionPropietario.php"));
            exit();
        } else {
            echo "Error: Rol de usuario desconocido.";
        }
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">…</nav>

    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-4">
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

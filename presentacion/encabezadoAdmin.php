<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php
if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "admin") {
    echo "<p>Error: Usted no tiene Permitido este apartado.</p>";
    exit;
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo + Nombre App -->
        <a class="navbar-brand d-flex align-items-center" href="?pid=<?php echo base64_encode("presentacion/admin/inicioAdmin.php")?>">
            <img src="https://img.icons8.com/ios-filled/100/ffffff/city-buildings.png" alt="building" width="40" height="40" class="me-2">
            <span class="fs-5 fw-bold">ConjuntosApp</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
				
				<!-- Nombre Admin a la derecha -->
                <li class="nav-item ms-3">
                    <span class="text-white">
                        <?php
                        $id = $_SESSION["id"];
                        $_SESSION["rol"] = "admin";
                        $admin = new Admin($id);
                        $admin->consultar();
                        echo "<span class='text'>Administrador:</span> <span class='fw-bold'>" . $admin->getNombre() . " " . $admin->getApellido() . "</span>";
                        ?>
                    </span>
                </li>
                
                <!-- Opciones de navegación -->
                <li class="nav-item">
                    <a class="nav-link" href="?pid=<?php echo base64_encode('presentacion/admin/crearCuenta.php'); ?>">Crear Cuenta</a>
                </li>

                <!-- Dropdown Propietario -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="propietarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Propietario
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="propietarioDropdown">
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/crearPropietario.php'); ?>">Crear</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/leerPropietario.php'); ?>">Consultar</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/actualizarPropietario.php'); ?>">Actualizar</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/eliminarPropietario.php'); ?>">Eliminar</a></li>
                    </ul>
                </li>

                <!-- Dropdown Propiedad -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="propiedadDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Propiedad
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="propiedadDropdown">
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/crearApartamento.php'); ?>">Crear</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/leerApartamento.php'); ?>">Consultar</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/actualizarApartamento.php'); ?>">Actualizar</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode('presentacion/admin/eliminarApartamento.php'); ?>">Eliminar</a></li>
                    </ul>
                </li>

                <li class="nav-item ms-3">
                    <a href="?pid=<?php echo base64_encode('presentacion/cerrarSesion.php') ?>" class="btn btn-danger">
                        Cerrar sesión
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

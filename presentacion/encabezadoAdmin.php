<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img width="55" height="55" src="https://img.icons8.com/bubbles/100/building.png" alt="building"/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div>
            <p class="text-white mb-0">
                <?php
                $id = $_SESSION["id"];
                $admin = new Admin($id);
                $admin->consultar();
                echo "Administrador: " . $admin->getNombre() . " " . $admin->getApellido();
                ?>
            </p>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

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

                <li class="nav-item">
                    <a href="?pid=<?php echo base64_encode('presentacion/cerrarSesion.php') ?>" class="nav-link">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

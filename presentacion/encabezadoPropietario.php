<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="https://img.icons8.com/ios-filled/100/ffffff/city-buildings.png" alt="building" width="40" height="40" class="me-2">
            <span class="fw-bold">ConjuntosApp</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item me-3 text-white">
                    <?php
                        $id = $_SESSION["id"];
                        $_SESSION["rol"] = "propietario";
                        $propietario = new Propietario($id);
                        $propietario->consultar();
                        echo "<span class='text'>Propietario:</span> <span class='fw-bold'>" . $propietario->getNombre() . " " . $propietario->getApellido() . "</span>";    
                    ?>
                </li>
                <li class="nav-item">
                    <a href="?pid=<?php echo base64_encode("presentacion/propietario/consultarApartamento.php")?>" class="btn btn-outline-light btn-sm me-2">
                        Consultar Apartamentos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?pid=<?php echo base64_encode("presentacion/cerrarSesion.php")?>" class="btn btn-danger btn-sm">
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img width="60" height="60" src="https://img.icons8.com/ios-filled/100/ffffff/city-buildings.png" alt="building"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div>
                <p class="text-white"><?php
                    $id = $_SESSION["id"];
                    $propietario = new Propietario($id);
                    $propietario->consultar();
                    echo "Propietario: " . $propietario->getNombre() . " " . $propietario->getApellido();
                    
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
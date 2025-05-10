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
                    $admin = new Usuario($id);
                    $admin -> consultar();
                    echo "Admin: " . $admin -> getNombre() . " " . $admin -> getApellido();
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

    <section class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Bienvenido al Conjunto Residencial</h1>
            <p class="lead">Disfruta de un ambiente seguro y cómodo en tu hogar.</p>
            <a href="#" class="btn btn-light btn-lg">Explora nuestros servicios</a>
        </div>
    </section>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="./img/servicios.jpg"  class="card-img-top" alt="Servicios">
                    <div class="card-body">
                        <h5 class="card-title">Servicios</h5>
                        <p class="card-text">Descubre todos los servicios que ofrecemos para mejorar tu calidad de vida.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="./img/eventos.jpeg" class="card-img-top" alt="Eventos">
                    <div class="card-body">
                        <h5 class="card-title">Próximos eventos</h5>
                        <p class="card-text">Infórmate sobre los eventos sociales y actividades en el conjunto residencial.</p>
                        <a href="#" class="btn btn-primary">Ver eventos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="./img/noticias.jpg" class="card-img-top" alt="Noticias">
                    <div class="card-body">
                        <h5 class="card-title">Últimas noticias</h5>
                        <p class="card-text">Mantente al tanto de las últimas noticias sobre el conjunto residencial.</p>
                        <a href="#" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p>&copy; 2025 Conjunto Residencial. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0O6BIIp1pCs8M8vxa6K2oG6a0xw45Pbz5WqF22tGb6f2U93g" crossorigin="anonymous"></script>
</body>
</html>

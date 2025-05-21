<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conjunto Residencial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img width="60" height="60" src="https://img.icons8.com/ios-filled/100/ffffff/city-buildings.png" alt="Conjunto Residencial"/>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="?pid=<?php echo base64_encode('presentacion/autenticar.php') ?>" class="nav-link">Autenticar</a>
                    </li>
                </ul>
            </div
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Bienvenido al Conjunto Residencial</h1>
            <p class="lead">Disfruta de un ambiente seguro y cómodo en tu hogar.</p>
        </div>
    </section>

    <!-- Cards Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="ratio ratio-4x3">
                        <img src="./img/servicios1.jpg" class="card-img-top" alt="Servicios">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Servicios</h5>
                        <p class="card-text">Descubre todos los servicios que ofrecemos para mejorar tu calidad de vida.</p>
                        <a href="?pid=<?php echo base64_encode('presentacion/info/servicios.php') ?>" class="btn btn-primary mt-auto">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="ratio ratio-4x3">
                        <img src="./img/eventos.jpg" class="card-img-top" alt="Eventos">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Próximos eventos</h5>
                        <p class="card-text">Infórmate sobre los eventos sociales y actividades en el conjunto residencial.</p>
                        <a href="?pid=<?php echo base64_encode('presentacion/info/eventos.php') ?>" class="btn btn-primary mt-auto">Ver eventos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="ratio ratio-4x3">
                        <img src="./img/noticias.jpg" class="card-img-top" alt="Noticias">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Últimas noticias</h5>
                        <p class="card-text">Mantente al tanto de las últimas noticias sobre el conjunto residencial.</p>
                        <a href="?pid=<?php echo base64_encode('presentacion/info/noticias.php') ?>" class="btn btn-primary mt-auto">Leer más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-4 mt-5">
        <p class="mb-0">&copy; 2025 Conjunto Residencial. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

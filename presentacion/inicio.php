

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img width="75" height="75" src="https://img.icons8.com/bubbles/100/building.png" alt="building"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item">
                        <a href="?pid=<?php echo base64_encode("presentacion/autenticar.php")?>" class="nav-link" data-bs-toggle="modal">Autenticar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Bienvenido al Conjunto Residencial</h1>
            <p class="lead">Disfruta de un ambiente seguro y cómodo en tu hogar.</p>
        </div>
    </section>

    <div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="ratio ratio-4x3">
            <img src="./img/servicios.jpg" class="card-img-top" alt="Servicios">
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
            <img src="./img/eventos.jpeg" class="card-img-top" alt="Eventos">
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


    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p>&copy; 2025 Conjunto Residencial. Todos los derechos reservados.</p>
    </footer>

</body>
</html>

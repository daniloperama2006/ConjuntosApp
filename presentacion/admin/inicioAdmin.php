<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador de Conjuntos</title>
 	<style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-section {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .container {
            margin-top: 30px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1.2rem;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-light">
    <?php include("presentacion/encabezadoAdmin.php") ?>
    
    <div class="container">
        <div class="header-section">
            <h1>Bienvenido al Panel de Administrador de Conjuntos</h1>
            <p class="lead">Gestiona y organiza los conjuntos habitacionales de manera eficiente</p>
        </div>

        <div class="row">
            <!-- Card 1: Gestión de Propietarios -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Propietarios</h5>
                        <p class="card-text">Administra los propietarios de los apartamentos, modifica sus datos y gestiona sus pagos.</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Gestión de Apartamentos -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Apartamentos</h5>
                        <p class="card-text">Visualiza todos los apartamentos, asigna propietarios y lleva el control del estado de cada uno.</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Gestión de Cuentas y Pagos -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Cuentas y Pagos</h5>
                        <p class="card-text">Genera y controla las cuentas de cobro, realiza seguimientos de pagos y envía recordatorios.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de estadísticas (opcional) -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Estadísticas Generales</h5>
                        <p class="card-text">Consulta estadísticas de la gestión de propietarios, pagos y más.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Administrador de Conjuntos | Todos los derechos reservados.</p>
    </div>

    </body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Propietario de Apartamento</title>
	<style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-section {
            background-color: #007bff;
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

        .btn-custom {
            background-color: #28a745;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: #218838;
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-light">
    <?php include("presentacion/encabezadoPropietario.php") ?>

    <div class="container">
        <div class="header-section">
            <h1>Bienvenido, Propietario</h1>
            <p class="lead">Administra tu apartamento, consulta pagos y mantente al tanto de los servicios del conjunto.</p>
        </div>

        <div class="row">
            <!-- Card 1: Ver mis Apartamentos -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Ver mis Apartamentos</h5>
                        <p class="card-text">Consulta los detalles de tus apartamentos y realiza cambios si es necesario.</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Consultar Mis Pagos -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Mis Pagos</h5>
                        <p class="card-text">Revisa tu historial de pagos y las cuentas pendientes.</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Información del Conjunto -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Cuentas de Cobro</h5>
                        <p class="card-text">Consulta la información de tus Cuentas de Cobro.</p>
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

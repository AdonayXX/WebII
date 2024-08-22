<?php
include '../includes/db.php';
include '../includes/site_config.php';
include '../includes/navbar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: <?php echo $config['primary_color']; ?>;
            color: <?php echo $config['secondary_color']; ?>;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            color: #343a40;
        }

        .card-text {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="display-4 text-center">Panel de Administración</h1>
        <p class="lead text-center">Bienvenido al panel de administración. Elija una opción para continuar.</p>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Actualizar usuarios</h5>
                        <p class="card-text">actualizar el role de los usuarios.</p>
                        <a href="user_management.php" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Agregar propiedades</h5>
                        <p class="card-text">Agregar propiedades.</p>
                        <a href="property_form.php" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Borrar propiedades</h5>
                        <p class="card-text">Eliminar propiedades de la base de datos.</p>
                        <a href="property_delete.php" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Añadir nuevos usuarios</h5>
                        <p class="card-text">Crear nuevos usuarios en la base de datos.</p>
                        <a href="../formRegister.php" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Personalizar la página</h5>
                        <p class="card-text">Editar la configuración de la página.</p>
                        <a href="customize.php" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ver lista de propiedades</h5>
                        <p class="card-text">Ver la lista de propiedades en la base de datos.</p>
                        <a href="property_list.php" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
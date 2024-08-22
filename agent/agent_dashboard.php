<?php
include '../includes/navbar.php';
include '../includes/db.php';
include '../includes/site_config.php';

if ($_SESSION['role'] !== 'agent') {
    header("Location: ../index.php");
    exit();
} 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Agentes</title>
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
        .card-text {
            color: #6c757d;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        h1.display-4 {
            font-weight: bold;
            color: #343a40;
            margin-bottom: 30px;
        }
        p.lead {
            font-size: 1.25rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="display-4 text-center">Panel de Agentes</h1>
        <p class="lead text-center">Bienvenido al panel de Agentes. Elija una opción para continuar.</p>
        <div class="row justify-content-center">

            
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

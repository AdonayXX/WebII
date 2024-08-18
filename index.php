<?php
include 'includes/db.php';

// Obtener la configuración del sitio
$query = $conn->query("SELECT * FROM site_config WHERE id = 1");
$config = $query->fetch_assoc();

$direccion = $config['address'];
$telefono = $config['phone'];
$email = $config['email'];
// Obtener las propiedades
$query = $conn->query("SELECT * FROM properties ORDER BY created_at DESC");
$properties = $query->fetch_all(MYSQLI_ASSOC);


// Verificar si 'social_links' no está vacío y es un JSON válido
$social_links = !empty($config['social_links']) ? json_decode($config['social_links'], true) : [];

// Si el JSON no es válido, manejar el error
if (json_last_error() !== JSON_ERROR_NONE) {
    $social_links = []; // Opcional: también puedes manejar el error de otra manera
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTN Solutions Real Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="WEBII/css/style.css" <?php echo time(); ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: <?php echo $config['primary_color']; ?>;
            color: <?php echo $config['secondary_color']; ?>;
        }

        .hero {
            background-image: url('./img/<?php echo $config['hero_image']; ?>?<?php echo time(); ?>');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 55vh;
        }

        .section-title {
            color: #EFB820;
            margin-top: 40px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .property {
            margin-bottom: 30px;
            background-color: #1E2247;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .property:hover {
            transform: translateY(-10px);
        }

        .property img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 4px solid #EFB820;
        }

        .property-info {
            padding: 20px;
            background-color: #150D3E;
            color: white;
        }

        .property-info h3 {
            color: #EFB820;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .property-info p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/<?php echo $config['banner_image']; ?>?<?php echo time(); ?>" alt="Logo" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">QUIENES SOMOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ALQUILERES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">VENTAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CONTÁCTENOS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <h1><?php echo $config['banner_text']; ?></h1>
    </header>

    <section class="container my-5">
        <h2 class="section-title">PROPIEDADES DESTACADAS</h2>
        <div class="row">
            <?php 
            $property_count = 0; // Contador para controlar cuántas propiedades se muestran inicialmente
            foreach ($properties as $property): 
                $property_count++;
            ?>
                <div class="col-md-4 property <?php echo $property_count > 3 ? 'more-properties' : ''; ?>" style="<?php echo $property_count > 3 ? 'display: none;' : ''; ?>">
                    <img src="img/<?php echo $property['image']; ?>" alt="<?php echo $property['title']; ?>">
                    <div class="property-info">
                        <h3><?php echo $property['title']; ?></h3>
                        <p><?php echo $property['description']; ?></p>
                        <p>Precio: $<?php echo number_format($property['price'], 2); ?></p>
                        <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-warning">VER MÁS...</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($property_count > 3): // Mostrar el botón solo si hay más de 3 propiedades ?>
            <div class="text-center mt-4">
                <button id="togglePropertiesBtn" class="btn btn-primary">Ver más</button>
            </div>
        <?php endif; ?>
    </section>

    <footer class="footer py-5">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Sección de información de contacto -->
            <div>
                <p><strong>Dirección:</strong> <?php echo $direccion; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
            </div>

            <!-- Sección de redes sociales -->
            <div class="text-center">
                <img src="img/<?php echo $config['banner_image']; ?>?<?php echo time(); ?>" alt="Logo" height="50" class="mb-3">
                <ul class="list-inline">
                    <?php foreach ($social_links as $platform => $link): ?>
                        <li class="list-inline-item">
                            <a href="<?php echo $link; ?>" target="_blank" class="text-dark">
                                <i class="fab fa-<?php echo strtolower($platform); ?> fa-2x"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Sección del formulario de contacto -->
            <div class="bg-light p-4 rounded">
                <h5 class="text-center mb-3">Contáctanos</h5>
                <form action="contact_process.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar</button>
                </form>
            </div>
        </div>
    </footer>
    <div class="text-center p-5 finally">
        <p>Derechos Reservados 2024</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
    <script>
    document.getElementById('togglePropertiesBtn').addEventListener('click', function() {
        var moreProperties = document.querySelectorAll('.more-properties');
        var btn = document.getElementById('togglePropertiesBtn');
        var isShowingMore = moreProperties[0].style.display === 'block';

        for (var i = 0; i < moreProperties.length; i++) {
            moreProperties[i].style.display = isShowingMore ? 'none' : 'block';
        }

        btn.textContent = isShowingMore ? 'Ver más' : 'Ver menos';
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

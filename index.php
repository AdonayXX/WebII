<?php
include 'includes/db.php';

// Obtener la configuración del sitio
$query = $conn->query("SELECT * FROM site_config WHERE id = 1");
$config = $query->fetch_assoc();

// Obtener las propiedades
$query = $conn->query("SELECT * FROM properties ORDER BY created_at DESC");
$properties = $query->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTN Solutions Real Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/proyecto/css/style.css" <?php echo time(); ?>>
    <style>
        body {
            background-color: <?php echo $config['primary_color']; ?>;
            color: <?php echo $config['secondary_color']; ?>;
        }

        .hero {
            background-image: url('img/<?php echo $config['hero_image']; ?>?<?php echo time(); ?>');
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
            <?php foreach ($properties as $property): ?>
                <div class="col-md-4 property">
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
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 contact-info">
                    <p><strong>Dirección:</strong> <?php echo $config['address']; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $config['phone']; ?></p>
                    <p><strong>Email:</strong> <a href="mailto:<?php echo $config['email']; ?>"><?php echo $config['email']; ?></a></p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="img/<?php echo $config['banner_image']; ?>" alt="Logo" height="50">
                    <div class="social-icons mt-3">
                        <?php
                        $social_links = json_decode($config['social_links'], true);
                        if (is_array($social_links)) {
                            foreach ($social_links as $link) {
                                echo "<a href=\"$link\"><img src=\"img/facebook-icon.png\" alt=\"Red Social\" height=\"30\"></a> ";
                            }
                        } else {
                            echo "No hay enlaces de redes sociales disponibles.";
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-form">
                        <h4>Contáctanos</h4>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="phone">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje:</label>
                                <textarea class="form-control" id="message" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="text-center p-5 finally">
        <p>Derechos Reservados 2024</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
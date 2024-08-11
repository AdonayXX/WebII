<?php
include 'includes/db.php';
$query = $conn->query("SELECT * FROM site_config WHERE id = 1");
$config = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTN Solutions Real Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/proyecto/css/style.css">
    <style>
        body {
            background-color: <?php echo $config['primary_color']; ?>;
            color: <?php echo $config['secondary_color']; ?>;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/<?php echo $config['banner_image']; ?>?<?php echo time(); ?>" alt="Banner" height="50"></a>
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
        <h1 class=""><?php echo $config['banner_text']; ?></h1>
    </header>

    <section class="container my-5">
        <h2 class="section-title">QUIENES SOMOS</h2>
        <div class="row">
            <div class="col-md-8">
                <p><?php echo $config['about_text']; ?></p>
            </div>
            <div class="col-md-4">
                <img src="img/<?php echo $config['about_image']; ?>" alt="Quiénes somos" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- Aquí puedes seguir integrando las propiedades destacadas y en venta de manera similar -->

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
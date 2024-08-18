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
    <link rel="stylesheet" href="/proyecto/css/style.css?<?php echo time(); ?>">
    <style>
        body {
            background-color: <?php echo $config['primary_color']; ?>;
            color: <?php echo $config['secondary_color']; ?>;
        }

        .navbar-nav .nav-link {
            color: #EFB820 !important;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .hero {
            background-image: url('img/<?php echo $config['hero_image']; ?>?<?php echo time(); ?>');

        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <header class="hero">
        <h1><?php echo $config['banner_text']; ?></h1>
    </header>

    <section class="container my-5">
        <h2 class="section-title">Quienes Somos</h2>
        <div class="row">
            <div class="col-md-8">
                <p><?php echo $config['about_text']; ?></p>
            </div>
            <div class="col-md-4">
                <img src="img/<?php echo $config['about_image']; ?>" alt="Nosotros" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="section-title">Propiedades Destacadas</h2>
        <div class="row">
            <?php
            $property_count = 0;
            foreach ($properties as $property):
                $property_count++;
            ?>
                <div class="col-md-4 <?php echo $property_count > 3 ? 'more-properties' : ''; ?>" style="<?php echo $property_count > 3 ? 'display: none;' : ''; ?>">
                    <div class="card">
                        <img src="img/<?php echo $property['image']; ?>" class="card-img-top" alt="<?php echo $property['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $property['title']; ?></h5>
                            <p class="card-text"><?php echo $property['description']; ?></p>
                            <p class="card-text">Precio: $<?php echo number_format($property['price'], 2); ?></p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-warning">Ver más...</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($property_count > 3): ?>
            <div class="text-center mt-4">
                <button id="showMoreBtn" class="btn btn-primary">Ver más</button>
            </div>
        <?php endif; ?>
    </section>

    <section class="container my-5">
        <h2 class="section-title">Alquileres</h2>
        <div class="row">
            <?php
            $property_count = 0;
            foreach ($properties as $property):
                if ($property['type'] == 'Alquiler') {
                    $property_count++;
            ?>
                    <div class="col-md-4 <?php echo $property_count > 3 ? 'more-properties' : ''; ?>" style="<?php echo $property_count > 3 ? 'display: none;' : ''; ?>">
                        <div class="card">
                            <img src="img/<?php echo $property['image']; ?>" class="card-img-top" alt="<?php echo $property['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $property['title']; ?></h5>
                                <p class="card-text"><?php echo $property['description']; ?></p>
                                <p class="card-text">Mensualidad: $<?php echo number_format($property['price'], 2); ?></p>
                                <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-warning">Ver más...</a>
                            </div>
                        </div>
                    </div>
            <?php }
            endforeach; ?>
        </div>
        <?php if ($property_count > 3): ?>
            <div class="text-center mt-4">
                <button id="showMoreBtn" class="btn btn-primary">Ver más</button>
            </div>
        <?php endif; ?>
    </section>

    <section class="container my-5">
        <h2 class="section-title">Ventas</h2>
        <div class="row">
            <?php
            $property_count = 0;
            foreach ($properties as $property):
                if ($property['type'] == 'Venta') {
                    $property_count++;
            ?>
                    <div class="col-md-4 <?php echo $property_count > 3 ? 'more-properties' : ''; ?>" style="<?php echo $property_count > 3 ? 'display: none;' : ''; ?>">
                        <div class="card">
                            <img src="img/<?php echo $property['image']; ?>" class="card-img-top" alt="<?php echo $property['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $property['title']; ?></h5>
                                <p class="card-text"><?php echo $property['description']; ?></p>
                                <p class="card-text">Precio: $<?php echo number_format($property['price'], 2); ?></p>
                                <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-warning">Ver más...</a>
                            </div>
                        </div>
                    </div>
            <?php }
            endforeach; ?>
        </div>
        <?php if ($property_count > 3): ?>
            <div class="text-center mt-4">
                <button id="showMoreBtn" class="btn btn-primary">Ver más</button>
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

                <div class="col-md-4">
                    <div class="footer-form">
                        <h4>Contáctanos</h4>
                        <form method="POST" id="emailForm" action="form_email.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje:</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <div class="captcha mt-5">
                                <div class="g-recaptcha" data-sitekey="6Ld3QSkqAAAAAAcjkV0q4sUYp7c71Cqg_G8y_UQv">
                                </div>
                            </div>
                        </form>
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
    <div class="finally">
            <p class="text-center">Derechos Reservados 2024</p>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.getElementById('showMoreBtn').addEventListener('click', function() {
            var moreProperties = document.querySelectorAll('.more-properties');
            for (var i = 0; i < moreProperties.length; i++) {
                moreProperties[i].style.display = 'block';
            }
            this.style.display = 'none'; // Oculta el botón una vez que se muestran todas las propiedades
        });
    </script>

</body>

</html>

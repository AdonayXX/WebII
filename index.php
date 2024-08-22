<?php
include 'includes/navbar.php';
include 'includes/db.php';
include 'includes/site_config.php';

$direccion = $config['address'];
$telefono = $config['phone'];
$email = $config['email'];

$query = $conn->query("SELECT * FROM view_properties_with_agents ORDER BY created_at DESC");
$properties = $query->fetch_all(MYSQLI_ASSOC);

$social_links = !empty($config['social_links']) ? json_decode($config['social_links'], true) : [];

if (json_last_error() !== JSON_ERROR_NONE) {
    $social_links = [];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/proyecto/css/style.css?<?php echo time(); ?>">
    <style>
        body {
            background-color: <?php echo htmlspecialchars($config['primary_color']); ?>;
            color: <?php echo htmlspecialchars($config['secondary_color']); ?>;
        }

        .hero {
            background-image: url('img/<?php echo htmlspecialchars($config['hero_image']); ?>?<?php echo time(); ?>');
        }

        .social-icons a {
            color: <?php echo htmlspecialchars($config['primary_colot']); ?>;
            margin: 0 10px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-icons a:hover {
            color: <?php echo htmlspecialchars($config['highlight_color']); ?>;
            transform: scale(1.2);
        }

        .social-icons a i {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <header class="hero">
        <h1><?php echo htmlspecialchars($config['banner_text']); ?></h1>
    </header>

    <section id="inicio" class="container my-5">
        <h2 id="quienes-somos" class="section-title">Quiénes Somos</h2>
        <div class="row">
            <div class="col-md-8">
                <p><?php echo nl2br(htmlspecialchars($config['about_text'])); ?></p>
            </div>
            <div class="col-md-4">
                <img src="img/<?php echo htmlspecialchars($config['about_image']); ?>" alt="Nosotros" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </section>

    <section class="container my-5">
    <h2 class="section-title">Propiedades Destacadas</h2>
    <div class="row" id="featured-properties">
        <?php
        $property_count = 0;
        foreach ($properties as $property):
            if ($property['is_featured']) {
                $property_count++;
        ?>
                <div class="col-md-4 property <?php echo $property_count > 3 ? 'more-properties-featured' : ''; ?>" style="<?php echo $property_count > 3 ? 'display: none;' : ''; ?>">
                    <div class="card h-100">
                        <img src="img/<?php echo htmlspecialchars($property['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($property['title']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($property['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($property['description']); ?></p>
                            <p class="card-text">Agente: <?php echo htmlspecialchars($property['agent_name']); ?></p>
                            <p class="card-text mt-auto">Precio: $<?php echo number_format($property['price'], 2); ?></p>
                            <a href="property_details.php?id=<?php echo htmlspecialchars($property['id']); ?>" class="btn btn-warning mt-auto">Ver más...</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        endforeach;
        ?>
    </div>
    <?php if ($property_count > 3): ?>
        <div class="text-center mt-4">
            <button id="showMoreBtn-featured" class="btn btn-primary">Ver más</button>
            <button id="showLessBtn-featured" class="btn btn-secondary" style="display: none;">Ver menos</button>
        </div>
    <?php endif; ?>
</section>

<section id="alquileres" class="container my-5">
    <h2 class="section-title">Alquileres</h2>
    <div class="row" id="rental-properties">
        <?php
        $alquiler_count = 0;
        foreach ($properties as $property):
            if ($property['type'] == 'Alquiler') {
                $alquiler_count++;
        ?>
                <div class="col-md-4 property <?php echo $alquiler_count > 3 ? 'more-properties-alquiler' : ''; ?>" style="<?php echo $alquiler_count > 3 ? 'display: none;' : ''; ?>">
                    <div class="card h-100">
                        <img src="img/<?php echo htmlspecialchars($property['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($property['title']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($property['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($property['description']); ?></p>
                            <p class="card-text">Agente: <?php echo htmlspecialchars($property['agent_name']); ?></p>
                            <p class="card-text mt-auto">Mensualidad: $<?php echo number_format($property['price'], 2); ?></p>
                            <a href="property_details.php?id=<?php echo htmlspecialchars($property['id']); ?>" class="btn btn-warning mt-auto">Ver más...</a>
                        </div>
                    </div>
                </div>
        <?php }
        endforeach; ?>
    </div>
    <?php if ($alquiler_count > 3): ?>
        <div class="text-center mt-4">
            <button id="showMoreBtn-alquiler" class="btn btn-primary">Ver más</button>
            <button id="showLessBtn-alquiler" class="btn btn-secondary" style="display: none;">Ver menos</button>
        </div>
    <?php endif; ?>
</section>

<section id="ventas" class="container my-5">
    <h2 class="section-title">Ventas</h2>
    <div class="row" id="sales-properties">
        <?php
        $venta_count = 0;
        foreach ($properties as $property):
            if ($property['type'] == 'Venta') {
                $venta_count++;
        ?>
                    <div class="col-md-4 property <?php echo $venta_count > 3 ? 'more-properties-ventas' : ''; ?>" style="<?php echo $venta_count > 3 ? 'display: none;' : ''; ?>">
                        <div class="card h-100">
                            <img src="img/<?php echo htmlspecialchars($property['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($property['title']); ?>">
                            <div class="card-body d-flex flex-column">
                                <hr>
                                <h5 class="card-title"><?php echo htmlspecialchars($property['title']); ?></h5>
                                <p class="card-text">descripción: <?php echo htmlspecialchars($property['description']); ?></p>
                                <p class="card-text">Agente: <?php echo htmlspecialchars($property['agent_name']); ?></p>
                                <p class="card-text mt-auto">Precio: $<?php echo number_format($property['price'], 2); ?></p>
                                <a href="property_details.php?id=<?php echo htmlspecialchars($property['id']); ?>" class="btn btn-warning mt-auto">Ver más...</a>
                            </div>
                        </div>
                    </div>
        <?php }
        endforeach; ?>
    </div>
    <?php if ($venta_count > 3): ?>
        <div class="text-center mt-4">
            <button id="showMoreBtn-ventas" class="btn btn-primary">Ver más</button>
            <button id="showLessBtn-ventas" class="btn btn-secondary" style="display: none;">Ver menos</button>
        </div>
    <?php endif; ?>
</section>

    <footer id="contactenos" class="footer py-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="contact-info">
                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            </div>
            <div class="text-center social-icons">
                <img src="img/<?php echo htmlspecialchars($config['banner_image']); ?>?<?php echo time(); ?>" alt="Logo" height="50" class="mb-3">
                <ul class="list-inline">
                    <?php foreach ($social_links as $platform => $link): ?>
                        <li class="list-inline-item">
                            <a href="<?php echo htmlspecialchars($link); ?>" target="_blank">
                                <i class="bi bi-<?php echo strtolower($platform); ?>"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-form col-md-4">
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
                        <div class="g-recaptcha" data-sitekey="6Ld3QSkqAAAAAAcjkV0q4sUYp7c71Cqg_G8y_UQv"></div>
                    </div>
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
    function toggleShowMoreLess(sectionClass, showMoreBtnId, showLessBtnId) {
    const showMoreBtn = document.getElementById(showMoreBtnId);
    const showLessBtn = document.getElementById(showLessBtnId);
    const properties = document.querySelectorAll(`.${sectionClass}`);

    if (showMoreBtn && showLessBtn) {  // Asegurarse de que los botones existen
        showMoreBtn.addEventListener('click', function() {
            properties.forEach(function(property) {
                property.style.display = 'block';
            });
            showMoreBtn.style.display = 'none';
            showLessBtn.style.display = 'inline-block';
        });

        showLessBtn.addEventListener('click', function() {
            properties.forEach(function(property) {
                property.style.display = 'none';
            });
            showLessBtn.style.display = 'none';
            showMoreBtn.style.display = 'inline-block';
        });
    }
}

// Configura cada sección con sus respectivos botones
toggleShowMoreLess('more-properties-featured', 'showMoreBtn-featured', 'showLessBtn-featured');
toggleShowMoreLess('more-properties-alquiler', 'showMoreBtn-alquiler', 'showLessBtn-alquiler');
toggleShowMoreLess('more-properties-ventas', 'showMoreBtn-ventas', 'showLessBtn-ventas');

</script>
</body>

</html>
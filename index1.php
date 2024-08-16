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
    <link rel="stylesheet" href="/proyecto/css/style.css">
</head>
<style>
    .property {
  background-color: #f7f7f7; /* fondo blanco */
  padding: 20px; /* espacio entre el contenido y el borde */
  border: 1px solid #ddd; /* borde gris claro */
  border-radius: 10px; /* borde redondeado */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* sombra leve */
  margin-bottom: 20px; /* espacio entre las propiedades */
}

.property img {
  width: 100%; /* ancho del 100% del contenedor */
  height: 150px; /* alto fijo de 150px */
  object-fit: cover; /* ajusta la imagen para que se ajuste al contenedor */
  border-radius: 10px 10px 0 0; /* borde redondeado solo en la parte superior */
}

.property-info {
  padding: 20px; /* espacio entre el contenido y el borde */
}

.property-info h3 {
  font-weight: bold; /* título en negrita */
  margin-top: 0; /* no espacio entre el título y el borde superior */
}

.property-info p {
  font-size: 16px; /* tamaño de fuente */
  color: #666; /* color de texto gris claro */
}

.property-info .btn {
  background-color: #ffc107; /* botón amarillo */
  color: #fff; /* texto blanco */
  padding: 10px 20px; /* espacio entre el texto y el borde */
  border-radius: 10px; /* borde redondeado */
  cursor: pointer; /* cursor de mano */
}

.property-info .btn:hover {
  background-color: #ffa07a; /* botón amarillo claro al pasar el mouse */
}
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="ruta/a/logo.jpg" alt="Logo" height="50"></a>
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
        <h1 class="">PERMÍTENOS AYUDARTE A CUMPLIR TUS SUEÑOS</h1>
    </header>

    <section class="container my-5">
        <h2 class="section-title">QUIENES SOMOS</h2>
        <div class="row">
            <div class="col-md-8">
                <p>Curabitur congue eleifend orci, at molestie nisl rutrum nec. Phasellus vestibulum nibh nisi. Donec ac
                    velit nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                    himenaeos. Morbi pretium erat a auctor tristique.</p>
            </div>
            <div class="col-md-4">
                <img src="ruta/a/imagen.jpg" alt="Quiénes somos" class="img-fluid">
            </div>
        </div>
    </section>

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
                    <p><strong>Dirección:</strong> Cañas Guanacaste, 100 mts Este Parque de Cañas</p>
                    <p><strong>Teléfono:</strong> 8890-2030</p>
                    <p><strong>Email:</strong> info@utnrealstate.com</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="ruta/a/logo.jpg" alt="Logo" height="50">
                    <div class="social-icons mt-3">
                        <a href="#"><img src="ruta/a/facebook-icon.png" alt="Facebook" height="30"></a>
                        <a href="#"><img src="ruta/a/twitter-icon.png" alt="Twitter" height="30"></a>
                        <a href="#"><img src="ruta/a/instagram-icon.png" alt="Instagram" height="30"></a>
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

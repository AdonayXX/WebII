<?php include 'includes/navbar.php';
include 'includes/site_config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Registro</title>
</head>
<style>
    body {
        background-color: <?php echo $config['primary_color']; ?>;
        color: <?php echo $config['secondary_color']; ?>;
    }
</style>

<body>
    <div class="container p-5">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card rounded-3 ">
                    <div class="card-header loginHeader rounded-4">
                        <h4 class="text-center">Registro</h4>
                    </div>
                    <div class="card-body" id="loginForm">
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="name">Nombre Completo:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="username">Nombre de Usuario:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <!-- volver a index.php -->
                            <a href="index.php" class="btn btn-secondary mt-3">Volver</a>

                            <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
                        </form>
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>



</html>
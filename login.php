<?php
session_start();
include 'includes/db.php';

$showToast = false; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $query->bind_param("ss", $username, $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: index.php");
            } elseif ($user['role'] === 'agent') {
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $errorMessage = "Contraseña incorrecta.";
            $showToast = true;
        }
    } else {
        $errorMessage = "Usuario o correo no encontrado.";
        $showToast = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body id="body">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card rounded-3">
                    <div class="card-header loginHeader rounded-4">
                        <h4 class="text-center">Iniciar sesión</h4>
                    </div>
                    <div class="card-body" id="loginForm">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Nombre de Usuario o Correo</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center mt-3">
                                <a href="formRegister.php">¿No tienes una cuenta? Regístrate</a>
                            </div>
                            <div class="text-center mt-2">
                                <a href="index.php">Volver al inicio</a>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100 buttonLogin">Iniciar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast de error -->
    <?php if ($showToast): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $errorMessage; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>

    <?php if ($showToast): ?>
    var toastEl = document.getElementById('errorToast');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
    <?php endif; ?>
    </script>
</body>

</html>

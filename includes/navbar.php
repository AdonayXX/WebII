<?php
include 'includes/db.php';
if (!isset($_SESSION)) {
    session_start();
}else{
    session_destroy();
}
?>
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
                    <!--- inciar sesión --->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">INICIAR SESIÓN</a>
                    </li>
                    <!--- cierra sesión --->
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">CERRAR SESIÓN</a>
                    </li>
                    <!--- registro --->
                    <li class="nav-item">
                        <a class="nav-link" href="formRegister.php">REGISTRO</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

</body>

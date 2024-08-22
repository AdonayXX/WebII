<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/db.php';
include __DIR__ . '/site_config.php';

$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['role']);
$role = $_SESSION['role'] ?? null;

ob_end_flush();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="http://localhost/proyecto/index.php">
            <img src="http://localhost/proyecto/img/<?php echo $config['banner_image']; ?>?<?php echo time(); ?>" alt="Logo" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/proyecto/index.php">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#quienes-somos">QUIENES SOMOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#alquileres">ALQUILERES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ventas">VENTAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contactenos">CONTÁCTENOS</a>
                </li>

                <?php if ($isLoggedIn): ?>
                    <?php if ($role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/proyecto/admin/admin_dashboard.php">ADMIN DASHBOARD</a>
                        </li>
                    <?php elseif ($role === 'agent'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/proyecto/agent/agent_dashboard.php">AGENTE DASHBOARD</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Rol no identificado</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyecto/logout.php">CERRAR SESIÓN</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyecto/login.php">INICIAR SESIÓN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyecto/formRegister.php">REGISTRO</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
</nav>
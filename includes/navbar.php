<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/db.php';
include __DIR__ . '/site_config.php';

$banner_image = $config['banner_image'] ?? 'default_banner.jpg';
$primary_color = $config['primary_color'] ?? '#000000';
$highlight_color = $config['highlight_color'] ?? '#FFFFFF';

$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['role']);
$role = $_SESSION['role'] ?? null;

ob_end_flush();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/proyecto/index.php">
            <img src="http://localhost/proyecto/img/<?php echo htmlspecialchars($banner_image); ?>?<?php echo time(); ?>" alt="Logo" height="40" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/proyecto/index.php"><i class="bi bi-house-door"></i> INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#quienes-somos"><i class="bi bi-info-circle"></i> QUIÉNES SOMOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#alquileres"><i class="bi bi-key"></i> ALQUILERES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ventas"><i class="bi bi-cash"></i> VENTAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contactenos"><i class="bi bi-envelope"></i> CONTÁCTENOS</a>
                </li>
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyecto/ed_profile_form.php"><i class="bi bi-person"></i> PERFIL</a>
                    </li>
                    <?php if ($role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/proyecto/admin/admin_dashboard.php"><i class="bi bi-speedometer2"></i> ADMIN DASHBOARD</a>
                        </li>
                    <?php elseif ($role === 'agent'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/proyecto/agent/agent_dashboard.php"><i class="bi bi-briefcase"></i> AGENTE DASHBOARD</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#"><i class="bi bi-exclamation-circle"></i> Rol no identificado</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyecto/logout.php"><i class="bi bi-box-arrow-right"></i> CERRAR SESIÓN</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyecto/login.php"><i class="bi bi-box-arrow-in-right"></i> INICIAR SESIÓN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyecto/formRegister.php"><i class="bi bi-pencil-square"></i> REGISTRO</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
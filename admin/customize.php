<?php
session_start();
include '../includes/db.php';

// Asegúrate de que solo el administrador pueda acceder a esta página
// if ($_SESSION['role'] !== 'admin') {
//     header("Location: ../index.php");
//     exit();
// }

// Obtener la configuración actual desde la base de datos
$query = $conn->query("SELECT * FROM site_config WHERE id = 1");
$config = $query->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $primary_color = $_POST['primary_color'];
    $secondary_color = $_POST['secondary_color'];
    $banner_text = $_POST['banner_text'];
    $about_text = $_POST['about_text'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $social_links = json_encode($_POST['social_links']);
    
    $banner_image = $config['banner_image'];
    $about_image = $config['about_image'];
    
    if (!empty($_FILES['banner_image']['name'])) {
        $banner_image = $_FILES['banner_image']['name'];
        move_uploaded_file($_FILES['banner_image']['tmp_name'], "../img/$banner_image");
    }
    
    if (!empty($_FILES['about_image']['name'])) {
        $about_image = $_FILES['about_image']['name'];
        move_uploaded_file($_FILES['about_image']['tmp_name'], "../img/$about_image");
    }

    $query = $conn->prepare("UPDATE site_config SET primary_color = ?, secondary_color = ?, banner_text = ?, about_text = ?, address = ?, phone = ?, email = ?, social_links = ?, banner_image = ?, about_image = ? WHERE id = 1");
    $query->bind_param("ssssssssss", $primary_color, $secondary_color, $banner_text, $about_text, $address, $phone, $email, $social_links, $banner_image, $about_image);

    if ($query->execute()) {
        $success_message = "Configuración actualizada con éxito.";
    } else {
        $error_message = "Error al actualizar la configuración.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalizar Página - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Personalizar Página</h2>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="customize.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="primary_color" class="form-label">Color Primario</label>
            <input type="color" class="form-control" id="primary_color" name="primary_color" value="<?php echo $config['primary_color']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="secondary_color" class="form-label">Color Secundario</label>
            <input type="color" class="form-control" id="secondary_color" name="secondary_color" value="<?php echo $config['secondary_color']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="banner_text" class="form-label">Texto del Banner</label>
            <input type="text" class="form-control" id="banner_text" name="banner_text" value="<?php echo $config['banner_text']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="banner_image" class="form-label">Imagen del Banner</label>
            <input type="file" class="form-control" id="banner_image" name="banner_image">
            <img src="../img/<?php echo $config['banner_image']; ?>" alt="Imagen del Banner" class="img-thumbnail mt-2" width="200">
        </div>
        <div class="mb-3">
            <label for="about_text" class="form-label">Texto de "Quiénes Somos"</label>
            <textarea class="form-control" id="about_text" name="about_text" required><?php echo $config['about_text']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="about_image" class="form-label">Imagen de "Quiénes Somos"</label>
            <input type="file" class="form-control" id="about_image" name="about_image">
            <img src="../img/<?php echo $config['about_image']; ?>" alt="Imagen de 'Quiénes Somos'" class="img-thumbnail mt-2" width="200">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $config['address']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $config['phone']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $config['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="social_links" class="form-label">Enlaces a Redes Sociales (JSON)</label>
            <textarea class="form-control" id="social_links" name="social_links" required><?php echo $config['social_links']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include '../includes/navbar.php';
include '../includes/site_config.php';
include '../includes/db.php';


if ($_SESSION['role'] !== 'agent' && $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$query = $conn->prepare("SELECT * FROM properties WHERE user_id = ?");
$query->bind_param("i", $_SESSION['user_id']);
$query->execute();
$properties = $query->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Propiedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: <?php echo $config['primary_color']; ?>;
            color: <?php echo $config['secondary_color']; ?>;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2>Mis Propiedades</h2>

    <a href="property_form.php" class="btn btn-primary mb-3">Agregar Nueva Propiedad</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Destacada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($properties as $property): ?>
                <tr>
                    <td><?php echo $property['id']; ?></td>
                    <td><?php echo $property['title']; ?></td>
                    <td><?php echo $property['type']; ?></td>
                    <td><?php echo $property['price']; ?></td>
                    <td><?php echo $property['is_featured'] ? 'Sí' : 'No'; ?></td>
                    <td>
                        <a href="property_form.php?id=<?php echo $property['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="property_delete.php?id=<?php echo $property['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta propiedad?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>

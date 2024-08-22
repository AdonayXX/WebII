<?php
include '../includes/navbar.php';
include '../includes/db.php';
include '../includes/site_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];

    $query = $conn->prepare("SELECT * FROM properties WHERE id = ?");
    $query->bind_param("i", $property_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $delete_query = $conn->prepare("DELETE FROM properties WHERE id = ?");
        $delete_query->bind_param("i", $property_id);
        if ($delete_query->execute()) {
            $success_message = "Propiedad eliminada exitosamente.";
        } else {
            $error_message = "Error al eliminar la propiedad.";
        }
    } else {
        $error_message = "La propiedad no existe.";
    }
}

$query = $conn->query("SELECT * FROM properties");
$properties = $query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Propiedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: <?php echo $config['primary_color']; ?>;
            color: <?php echo $config['secondary_color']; ?>;
        }
    </style>
</head>

<body>
    <div class="container mt-5 p-3">
        <h2>Lista de Propiedades</h2>

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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?php echo $property['id']; ?></td>
                        <td><?php echo $property['title']; ?></td>
                        <td><?php echo $property['description']; ?></td>
                        <td><?php echo $property['price']; ?></td>
                        <td>
                            <form action="" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?');">
                                <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
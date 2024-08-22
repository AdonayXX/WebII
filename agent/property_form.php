
<?php
include '../includes/navbar.php';    
include '../includes/db.php';
include '../includes/site_config.php';
include 'property_save.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $is_editing ? 'Editar Propiedad' : 'Nueva Propiedad'; ?></title>
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
    <h2><?php echo $is_editing ? 'Editar Propiedad' : 'Nueva Propiedad'; ?></h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="property_form.php<?php echo $is_editing ? '?id=' . $property_id : ''; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Título:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $property['title'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción:</label>
            <textarea class="form-control" id="description" name="description" required><?php echo $property['description'] ?? ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $property['price'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo:</label>
            <select class="form-control" id="type" name="type" required>
                <option value="Venta" <?php echo isset($property['type']) && $property['type'] == 'Venta' ? 'selected' : ''; ?>>Venta</option>
                <option value="Alquiler" <?php echo isset($property['type']) && $property['type'] == 'Alquiler' ? 'selected' : ''; ?>>Alquiler</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="is_featured" class="form-label">Destacada:</label>
            <input type="checkbox" id="is_featured" name="is_featured" <?php echo isset($property['is_featured']) && $property['is_featured'] ? 'checked' : ''; ?>>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="image" name="image">
            <?php if (isset($property['image']) && $property['image']): ?>
                <img src="../img/<?php echo $property['image']; ?>" alt="Imagen actual" height="100">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $is_editing ? 'Actualizar Propiedad' : 'Crear Propiedad'; ?></button>
    </form>
</div>
</body>
</html>

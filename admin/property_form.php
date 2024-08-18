<?php
session_start();
include '../includes/db.php';


$property = null;

if (isset($_GET['id'])) {
    // Si se proporciona un ID, se está intentando editar una propiedad
    $property_id = $_GET['id'];
    var_dump($property_id);
    $query = $conn->prepare("SELECT * FROM properties WHERE id = ? AND (user_id = ? OR ? = 'admin')");
    $query->bind_param("iis", $property_id, $_SESSION['user_id'], $_SESSION['role']);
    $query->execute();
    $property = $query->get_result()->fetch_assoc();

    if (!$property) {
        die('No tienes permiso para editar esta propiedad.');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($property) ? 'Editar Propiedad' : 'Nueva Propiedad'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            margin-top: 50px;
        }

        .form-label {
            color: #150D3E;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #150D3E;
            border-color: #150D3E;
        }

        .btn-primary:hover {
            background-color: #0f0a29;
            border-color: #0f0a29;
        }

        .form-control, .form-select {
            border-color: #150D3E;
        }

        .form-check-input:checked {
            background-color: #EFB820;
            border-color: #EFB820;
        }

        .btn-primary, .btn-primary:hover, .btn-primary:focus {
            background-color: #150D3E;
            border-color: #150D3E;
        }

        .image-preview {
            margin-top: 15px;
        }

        .image-preview img {
            max-height: 100px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4"><?php echo isset($property) ? 'Editar Propiedad' : 'Nueva Propiedad'; ?></h2>
        
        <form action="property_save.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 border rounded">
            <input type="hidden" name="property_id" value="<?php echo isset($property['id']) ? $property['id'] : ''; ?>">
            
            <div class="mb-3">
                <label for="title" class="form-label">Título:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo isset($property['title']) ? $property['title'] : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required><?php echo isset($property['description']) ? $property['description'] : ''; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Precio:</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?php echo isset($property['price']) ? $property['price'] : ''; ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipo:</label>
                <select id="type" name="type" class="form-select" required>
                    <option value="sale" <?php echo isset($property['type']) && $property['type'] == 'Venta' ? 'selected' : ''; ?>>Venta</option>
                    <option value="rent" <?php echo isset($property['type']) && $property['type'] == 'Alquiler' ? 'selected' : ''; ?>>Alquiler</option>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" id="is_featured" name="is_featured" class="form-check-input" <?php echo isset($property['is_featured']) && $property['is_featured'] ? 'checked' : ''; ?>>
                <label for="is_featured" class="form-check-label">Destacada</label>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Imagen:</label>
                <input type="file" id="image" name="image" class="form-control">
                <?php if (isset($property['image']) && $property['image']): ?>
                    <div class="image-preview">
                        <p>Imagen actual:</p>
                        <img src="../img/<?php echo $property['image']; ?>" alt="Imagen actual">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary"><?php echo isset($property) ? 'Actualizar Propiedad' : 'Crear Propiedad'; ?></button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

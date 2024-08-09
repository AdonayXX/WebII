<?php
session_start();
include '../includes/db.php';

$query = $conn->query("SELECT * FROM properties ORDER BY created_at DESC");
$properties = $query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista de Propiedades</title>
</head>
<body>

<div class="container">
    <h2 class="my-4">Lista de Propiedades</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Precio</th>
                <th>Tipo</th>
                <th>Destacada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($properties as $property): ?>
            <tr>
                <td><?php echo $property['title']; ?></td>
                <td><?php echo $property['price']; ?></td>
                <td><?php echo $property['type']; ?></td>
                <td><?php echo $property['is_featured'] ? 'Sí' : 'No'; ?></td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                        data-id="<?php echo $property['id']; ?>"
                        data-title="<?php echo $property['title']; ?>"
                        data-description="<?php echo $property['description']; ?>"
                        data-price="<?php echo $property['price']; ?>"
                        data-type="<?php echo $property['type']; ?>"
                        data-is_featured="<?php echo $property['is_featured']; ?>"
                        data-image="<?php echo $property['image']; ?>">
                        Editar
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para Editar Propiedad -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Propiedad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" action="property_save.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="property_id" id="modalPropertyId">
            
            <div class="mb-3">
                <label for="modalTitle" class="form-label">Título</label>
                <input type="text" class="form-control" id="modalTitle" name="title" required>
            </div>
            
            <div class="mb-3">
                <label for="modalDescription" class="form-label">Descripción</label>
                <textarea class="form-control" id="modalDescription" name="description" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="modalPrice" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="modalPrice" name="price" required>
            </div>
            
            <div class="mb-3">
                <label for="modalType" class="form-label">Tipo</label>
                <select class="form-select" id="modalType" name="type" required>
                    <option value="Venta">Venta</option>
                    <option value="Alquiler">Alquiler</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="modalIsFeatured" class="form-label">Destacada</label>
                <input type="checkbox" id="modalIsFeatured" name="is_featured">
            </div>
            
            <div class="mb-3">
                <label for="modalImage" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="modalImage" name="image">
                <img id="currentImage" src="" alt="Imagen actual" height="100" style="margin-top: 10px;">
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
 <script src="../js/app.js"></script>
</body>
</html>

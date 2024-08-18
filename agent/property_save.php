<?php
session_start();
include '../includes/db.php';

$property = null;
$is_editing = false;

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Ajustar la consulta para los agentes: solo pueden editar sus propias propiedades.
    $query = $conn->prepare("SELECT * FROM properties WHERE id = ? AND (user_id = ? OR ? = 'admin')");
    $query->bind_param("iis", $property_id, $_SESSION['user_id'], $_SESSION['role']);
    $query->execute();
    $property = $query->get_result()->fetch_assoc();

    if (!$property) {
        die('No tienes permiso para editar esta propiedad.');
    }

    $is_editing = true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $image = $_FILES['image']['name'];

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], "../img/$image");
    } else {
        $image = $property['image'] ?? '';  // Mantener la imagen existente en caso de edición
    }

    if ($is_editing) {
        // Actualizar propiedad existente
        $query = $conn->prepare("UPDATE properties SET title = ?, description = ?, price = ?, type = ?, is_featured = ?, image = ? WHERE id = ? AND (user_id = ? OR ? = 'admin')");
        $query->bind_param("ssdsisiis", $title, $description, $price, $type, $is_featured, $image, $property_id, $_SESSION['user_id'], $_SESSION['role']);
    } else {
        // Crear nueva propiedad
        $query = $conn->prepare("INSERT INTO properties (title, description, price, type, is_featured, image, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssdsisi", $title, $description, $price, $type, $is_featured, $image, $_SESSION['user_id']);
    }

    if ($query->execute()) {
    } else {
        $error = "Error al guardar la propiedad.";
    }
}
?>
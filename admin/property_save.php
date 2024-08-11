<?php
session_start();
include '../includes/db.php';
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$type = $_POST['type'];
$is_featured = isset($_POST['is_featured']) ? 1 : 0;
$image = $_FILES['image']['name'];
$user_id = $_SESSION['user_id'];

if ($image) {
    move_uploaded_file($_FILES['image']['tmp_name'], "../img/$image");
} else {
    // Si no se carga una nueva imagen, mantener la imagen existente si es una actualización
    if (isset($_POST['property_id']) && $_POST['property_id'] != '') {
        $query = $conn->prepare("SELECT image FROM properties WHERE id = ?");
        $query->bind_param("i", $_POST['property_id']);
        $query->execute();
        $result = $query->get_result();
        if ($row = $result->fetch_assoc()) {
            $image = $row['image'];
        }
    }
}

if (isset($_POST['property_id']) && $_POST['property_id'] != '') {
    // Actualizar propiedad existente
    $property_id = $_POST['property_id'];
    $query = $conn->prepare("UPDATE properties SET title = ?, description = ?, price = ?, type = ?, is_featured = ?, image = ? WHERE id = ? AND (user_id = ? OR ? = 'admin')");
    $query->bind_param("ssdsisiss", $title, $description, $price, $type, $is_featured, $image, $property_id, $user_id, $_SESSION['role']);
} else {
    $query = $conn->prepare("INSERT INTO properties (title, description, price, type, is_featured, image, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssdsisi", $title, $description, $price, $type, $is_featured, $image, $user_id);
}

if ($query->execute()) {
    echo "Propiedad guardada con éxito.";
} else {
    echo "Error al guardar la propiedad.";
}

header("Location: property_list.php");
exit();
?>

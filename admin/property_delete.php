<?php
include '../includes/db.php';

$property_id = $_GET['id'];

$query = $conn->prepare("DELETE FROM properties WHERE id = ?");
$query->bind_param("i", $property_id);

if ($query->execute()) {
    echo "Propiedad eliminada con éxito.";
} else {
    echo "Error al eliminar la propiedad.";
}
?>

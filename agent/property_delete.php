<?php
session_start();
include '../includes/db.php';

if ($_SESSION['role'] !== 'agent' && $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    $query = $conn->prepare("DELETE FROM properties WHERE id = ? AND (user_id = ? OR ? = 'admin')");
    $query->bind_param("iis", $property_id, $_SESSION['user_id'], $_SESSION['role']);

    if ($query->execute()) {
        header("Location: property_list.php");
        exit();
    } else {
        echo "Error al eliminar la propiedad.";
    }
} else {
    header("Location: property_list.php");
    exit();
}

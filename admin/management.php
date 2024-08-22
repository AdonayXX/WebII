<?php
include '../includes/db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    $query = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $query->bind_param("si", $new_role, $user_id);

    if ($query->execute()) {
        $success = "Rol de usuario actualizado con éxito.";
    } else {
        $error = "Error al actualizar el rol de usuario.";
    }
}

$query = $conn->query("SELECT * FROM users");
$users = $query->fetch_all(MYSQLI_ASSOC);
?>
<?php
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$user = $query->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $query = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ? WHERE id = ?");
        $query->bind_param("ssssi", $name, $email, $phone, $password, $user_id);
    } else {
        $query = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
        $query->bind_param("sssi", $name, $email, $phone, $user_id);
    }

    if ($query->execute()) {
        $_SESSION['success'] = "Perfil actualizado correctamente.";
    } else {
        $_SESSION['error'] = "Hubo un problema al actualizar el perfil.";
    }

    header("Location: edit_profile.php");
    exit();
}
?>

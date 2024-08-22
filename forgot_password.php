<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->bind_param("ss", $hashed_password, $email);
            if ($update->execute()) {
                $message = "Tu contraseña ha sido actualizada correctamente.";
            } else {
                $message = "Ocurrió un error al actualizar la contraseña. Inténtalo de nuevo.";
            }
        } else {
            $message = "No se encontró ninguna cuenta asociada a ese correo.";
        }
    } else {
        $message = "Las contraseñas no coinciden.";
    }
}
?>

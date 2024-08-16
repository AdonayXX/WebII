<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';  

    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $error = "El correo electrónico ya está registrado.";
    } else {

        $query = $conn->prepare("INSERT INTO users (name, phone, email, username, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssss", $name, $phone, $email, $username, $password, $role);

        if ($query->execute()) {
            $success = "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            $error = "Error al registrar el usuario.";
        }
    }
}
?>

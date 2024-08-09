<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = 'user';  

    $query = $conn->prepare("INSERT INTO users (name, phone, email, username, password, role) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssss", $name, $phone, $email, $username, $password, $role);

    if ($query->execute()) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        echo "Error: " . $query->error;
    }
}
?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['role'] == 'admin') {
    include 'admin_dashboard.php';
} else {
    include 'agent_dashboard.php';
}
?>

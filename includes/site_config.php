<?php
include __DIR__ . '/db.php';
$query = $conn->query("SELECT * FROM site_config WHERE id = 1");
$config = $query->fetch_assoc();
?>
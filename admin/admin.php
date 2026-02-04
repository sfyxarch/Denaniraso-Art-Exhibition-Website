<?php
require 'auth.php';
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lobi Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
</html>

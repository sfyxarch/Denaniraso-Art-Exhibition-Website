<?php
session_start();
$conn = new mysqli("localhost", "root", "", "epen");

$nama_pengguna = "Admin";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $result = $conn->query("SELECT nama FROM login WHERE username = '$username'");
    if ($result && $row = $result->fetch_assoc()) {
        $nama_pengguna = $row['nama'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Sistem Epen</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="logout-top-right">
        <a href="login.php" class="button">Logout</a>
    </div>

    <div class="welcome-container">
        <h1>Sistem Informasi Tiket Epen</h1>
        <p>Halo, <strong><?= htmlspecialchars($nama_pengguna) ?></strong>! Selamat datang di sistem informasi pemesanan
            tiket.</p>
        <a href="data_tiket.php" class="button">Data Tiket</a><br>
        <a href="pembayaran.php" class="button">Data Pembayaran</a><br>
    </div>
</body>



</html>
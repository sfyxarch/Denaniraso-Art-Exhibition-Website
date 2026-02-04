<?php
$conn = new mysqli("localhost", "root", "", "epen");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST["nama"]);
    $no_hp = $conn->real_escape_string($_POST["no_hp"]);
    $gmail = $conn->real_escape_string($_POST["gmail"]);
    $alamat = $conn->real_escape_string($_POST["alamat"]);
    $tanggal_kunjung = $conn->real_escape_string($_POST["tanggal_kunjung"]);
    $jumlah = (int) $_POST["jumlah"];
    $harga = (int) $_POST["harga"];

    $sql = "INSERT INTO data_tiket (nama, no_hp, gmail, alamat, tanggal_kunjung, jumlah, harga) 
            VALUES ('$nama', '$no_hp', '$gmail', '$alamat', '$tanggal_kunjung', $jumlah, $harga)";

    if ($conn->query($sql)) {
        header("Location: data_tiket.php");
        exit();
    } else {
        echo "<center>Gagal menambahkan data: " . $conn->error . "</center>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Data Tiket</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <h2 style="text-align:center;">Tambah Data Tiket</h2>

    <form method="post" action="">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="no_hp" required>
            </div>

            <div class="form-group">
                <label>Gmail:</label>
                <input type="email" name="gmail" required>
            </div>

            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" name="alamat" required>
            </div>

            <div class="form-group">
                <label>Tanggal Kunjung:</label>
                <input type="date" name="tanggal_kunjung" required>
            </div>

            <div class="form-group">
                <label>Jumlah:</label>
                <input type="number" name="jumlah" min="1" required>
            </div>

            <div class="form-group">
                <label>Harga:</label>
                <input type="number" name="harga" min="0" required>
            </div>

            <div class="form-actions">
            <input type="submit" value="Simpan">
            <input type="button" value="Batal" onclick="window.location.href='pembayaran.php'">
            </div>

    </form>

</body>

</html>
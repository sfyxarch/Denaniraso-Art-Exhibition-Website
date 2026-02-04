<?php
$conn = new mysqli("localhost", "root", "", "epen");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = $_POST["id_pelanggan"];
    $metode = $_POST["metode"];
    $jumlah = $_POST["jumlah"];
    $total_bayar = $_POST["total_bayar"];
    $tanggal_kunjung = $_POST["tanggal_kunjung"];
    $gambar = null;

    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        $gambar = basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "uploads/" . $gambar);
    }

    $sql = "INSERT INTO pembayaran (id_pelanggan, metode, gambar, jumlah, total_bayar, tanggal_kunjung)
            VALUES ('$id_pelanggan', '$metode', '$gambar', '$jumlah', '$total_bayar', '$tanggal_kunjung')";

    if ($conn->query($sql)) {
        header("Location: pembayaran.php");
        exit();
    } else {
        echo "Gagal menambahkan data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Pembayaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Tambah Data Pembayaran</h2>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>ID Pelanggan:</label>
            <input type="number" min="1" name="id_pelanggan" required>
        </div>

        <div class="form-group">
            <label>Metode:</label>
            <select name="metode">
                <option value="qris">QRIS</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

        <div class="form-group">
            <label>Gambar Bukti:</label>
            <input type="file" name="gambar" accept="image/*" required>
        </div>


        <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" min="1" required>
        </div>

        <div class="form-group">
            <label>Total Bayar:</label>
            <input type="number" min="1" name="total_bayar" required>
        </div>

        <div class="form-group">
            <label>Tanggal Kunjung:</label>
            <input type="date" name="tanggal_kunjung" min="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="form-actions">
    <input type="submit" value="Simpan">
    <input type="button" value="Batal" onclick="window.location.href='pembayaran.php'">
</div>

    </form>

</body>
</html>

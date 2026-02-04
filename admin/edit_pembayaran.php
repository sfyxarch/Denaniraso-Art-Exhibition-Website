<?php
$conn = new mysqli("localhost", "root", "", "epen");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$data = null;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM pembayaran WHERE id_bayar = $id");
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "<center>Data tidak ditemukan.</center>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bayar        = (int)$_POST['id_bayar'];
    $id_pelanggan    = $conn->real_escape_string($_POST['id_pelanggan']);
    $metode          = $conn->real_escape_string($_POST['metode']);
    $jumlah          = (int)$_POST['jumlah'];
    $total_bayar     = (int)$_POST['total_bayar'];
    $tanggal_kunjung = $conn->real_escape_string($_POST['tanggal_kunjung']);
    
    $gambar = $data['gambar'] ?? '';

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/$gambar");
    }

    $sql = "UPDATE pembayaran SET 
            id_pelanggan = '$id_pelanggan',
            metode = '$metode',
            gambar = '$gambar',
            jumlah = $jumlah,
            total_bayar = $total_bayar,
            tanggal_kunjung = '$tanggal_kunjung'
            WHERE id_bayar = $id_bayar";

    if ($conn->query($sql)) {
        header("Location: pembayaran.php");
        exit();
    } else {
        echo "<center>Gagal mengedit data: " . $conn->error . "</center>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Pembayaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Pembayaran</h2>

        <?php if ($data): ?>
        <form method="POST" enctype="multipart/form-data" class="form">
            <input type="hidden" name="id_bayar" value="<?= htmlspecialchars($data['id_bayar']) ?>">

            <div class="form-group">
                <label for="id_pelanggan">ID Pelanggan:</label>
                <input type="number" id="id_pelanggan" name="id_pelanggan" value="<?= htmlspecialchars($data['id_pelanggan']) ?>" required>
            </div>

            <div class="form-group">
                <label for="metode">Metode:</label>
                <select id="metode" name="metode" required>
                    <option value="qris" <?= $data['metode'] === 'qris' ? 'selected' : '' ?>>QRIS</option>
                    <option value="transfer" <?= $data['metode'] === 'transfer' ? 'selected' : '' ?>>Transfer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="gambar">Upload Bukti (jika diubah):</label>
                <input type="file" id="gambar" name="gambar" accept="image/*">
                <?php if (!empty($data['gambar'])): ?>
                    <small>Gambar saat ini: <?= htmlspecialchars($data['gambar']) ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" id="jumlah" name="jumlah" value="<?= htmlspecialchars($data['jumlah']) ?>" min="1" required>
            </div>

            <div class="form-group">
                <label for="total_bayar">Total Bayar:</label>
                <input type="number" id="total_bayar" name="total_bayar" value="<?= htmlspecialchars($data['total_bayar']) ?>" min="0" required>
            </div>

            <div class="form-group">
                <label for="tanggal_kunjung">Tanggal Kunjung:</label>
                <input type="date" id="tanggal_kunjung" name="tanggal_kunjung" value="<?= htmlspecialchars($data['tanggal_kunjung']) ?>" min="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Simpan</button>
                <button type="button" class="btn" onclick="window.location.href='pembayaran.php'">Batal</button>
            </div>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>

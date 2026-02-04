<?php
$conn = new mysqli("localhost", "root", "", "epen");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$data = null;

// Ambil data jika ada ID di URL
if (isset($_GET["id"])) {
    $id = (int)$_GET["id"]; // casting ke int agar lebih aman
    $result = $conn->query("SELECT * FROM data_tiket WHERE id_pelanggan = $id");
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
}

// Proses form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST["id"];
    $nama = $conn->real_escape_string($_POST["nama"]);
    $no_hp = $conn->real_escape_string($_POST["no_hp"]);
    $gmail = $conn->real_escape_string($_POST["gmail"]);
    $alamat = $conn->real_escape_string($_POST["alamat"]);
    $tanggal_kunjung = $conn->real_escape_string($_POST["tanggal_kunjung"]);
    $jumlah = (int)$_POST["jumlah"];
    $harga = (int)$_POST["harga"];

    $sql = "UPDATE data_tiket SET 
            nama='$nama', no_hp='$no_hp', gmail='$gmail', alamat='$alamat',
            tanggal_kunjung='$tanggal_kunjung', jumlah=$jumlah, harga=$harga
            WHERE id_pelanggan = $id";

    if ($conn->query($sql)) {
        header("Location: data_tiket.php");
        exit();
    } else {
        echo "Gagal mengedit data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Data Tiket</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <h2>Edit Data Tiket</h2>

    <?php if ($data): ?>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id_pelanggan']) ?>">

        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>

        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" value="<?= htmlspecialchars($data['no_hp']) ?>" required>
        </div>

        <div class="form-group">
            <label>Gmail:</label>
            <input type="email" name="gmail" value="<?= htmlspecialchars($data['gmail']) ?>" required>
        </div>

        <div class="form-group">
            <label>Alamat:</label>
            <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required>
        </div>

        <div class="form-group">
            <label>Tanggal Kunjung:</label>
            <input type="date" name="tanggal_kunjung" value="<?= htmlspecialchars($data['tanggal_kunjung']) ?>" required>
        </div>

        <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" min="1" value="<?= htmlspecialchars($data['jumlah']) ?>" required>
        </div>

        <div class="form-group">
            <label>Harga:</label>
            <input type="number" name="harga" min="0" value="<?= htmlspecialchars($data['harga']) ?>" required>
        </div>

        <div class="form-actions">
            <input type="submit" class="button" value="Simpan Perubahan">
            <input type="button" class="button" value="Batal" onclick="window.location.href='data_tiket.php'">
        </div>
    </form>
    <?php endif; ?>

</body>
</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "epen");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("ID pelanggan tidak ditemukan.");
}

$id_pelanggan = (int)$_GET['id'];

$q = mysqli_query($conn, "SELECT * FROM data_tiket WHERE id_pelanggan = $id_pelanggan");
$data = mysqli_fetch_assoc($q);
if (!$data) {
    die("Data pelanggan tidak ditemukan.");
}

$jumlah = $data['jumlah'];
$harga_per_tiket = 25000;
$total_bayar = $jumlah * $harga_per_tiket;
$tanggal_kunjung = $data['tanggal_kunjung'];

$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true); // buat folder jika belum ada
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metode = $_POST['metode'];
    $tmp_name = $_FILES['bukti']['tmp_name'];
    $original_name = $_FILES['bukti']['name'];

    $allowed_ext = ['jpg', 'jpeg', 'png'];
    $file_ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_ext)) {
        echo "<script>alert('Hanya file JPG, JPEG, atau PNG yang diperbolehkan.');</script>";
        exit;
    }

    // Buat nama file baru yang aman dan unik
    $bukti_bayar = uniqid('bukti_', true) . '.' . $file_ext;
    $target_file = $upload_dir . $bukti_bayar;

    if (move_uploaded_file($tmp_name, $target_file)) {
        $insert = mysqli_query($conn, "INSERT INTO pembayaran 
            (id_pelanggan, metode, gambar, jumlah, total_bayar, tanggal_kunjung)
            VALUES ('$id_pelanggan', '$metode', '$bukti_bayar', '$jumlah', '$total_bayar', '$tanggal_kunjung')
        ");
        if ($insert) {
            echo "<script>
                alert('Bukti pembayaran berhasil dikirim!');
                window.location.href = '../../denaniraso/tiketing/print.html?id=$id_pelanggan';
            </script>";
            exit;
        } else {
            echo "<script>alert('Gagal menyimpan ke database.');</script>";
        }
    } else {
        echo "<script>alert('Upload bukti pembayaran gagal. Periksa permission folder uploads/.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Tiket Pameran</title>
    <link rel="stylesheet" href="pembayaran-bukti.css">
</head>
<body>
<div class="container">
    <div class="header-box">
        <div class="header-logo">
            <img src="DENANIRASO.png" alt="Logo">
        </div>
        <div class="header-title">
            <h2>Konfirmasi Pembayaran Tiket Pameran</h2>
        </div>
    </div>

    <p><span class="label">ID Pelanggan:</span> <?= $data['id_pelanggan'] ?></p>
    <p><span class="label">Nama:</span> <?= htmlspecialchars($data['nama']) ?></p>
    <p><span class="label">Tanggal Kunjung:</span> <?= date('d-m-Y', strtotime($tanggal_kunjung)) ?></p>
    <p><span class="label">Jumlah Tiket:</span> <?= $jumlah ?></p>
    <p><span class="label">Total Harga:</span> Rp <?= number_format($total_bayar, 0, ',', '.') ?></p>

    <form method="post" enctype="multipart/form-data">
        <label for="metode">Metode Pembayaran:</label>
        <select name="metode" id="metode" required onchange="togglePaymentOptions(this.value)">
            <option value="">-- Pilih Metode --</option>
            <option value="qris">QRIS</option>
            <option value="transfer">Transfer Bank</option>
        </select>

        <div id="qris-box" style="display: none;">
            <p style="text-align:center;">Silakan scan QRIS berikut:</p>
            <img src="qris.jpg" alt="QRIS Code" class="qris-img">
        </div>

        <div id="transfer-box" style="display: none;">
            <p style="text-align:center;">
                Silakan transfer ke rekening berikut:<br><br>
                <strong>Bank BRI</strong><br>
                Nomor Rekening: <strong>1234567890</strong><br>
                Atas Nama: <strong>PANITIA PAMERAN</strong>
            </p>
        </div>

        <label for="bukti">Upload Bukti Pembayaran:</label>
        <input type="file" name="bukti" id="bukti" accept="image/*" required>

        <button type="submit" class="btn">Kirim Bukti Pembayaran</button>
    </form>
</div>

<script>
function togglePaymentOptions(value) {
    const qrisBox = document.getElementById("qris-box");
    const transferBox = document.getElementById("transfer-box");

    qrisBox.style.display = value === "qris" ? "block" : "none";
    transferBox.style.display = value === "transfer" ? "block" : "none";
}
</script>
</body>
</html>
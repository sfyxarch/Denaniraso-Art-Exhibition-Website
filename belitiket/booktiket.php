<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "epen");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tgkj'];
    $jumlah = $_POST['jumlah'];
    $sesi = $_POST['sesi'];
    $harga_per_tiket = 25000;
    $total = $jumlah * $harga_per_tiket;

    $query = "INSERT INTO data_tiket (nama, nohp, email, alamat, tanggal_kunjung, jumlah, sesi)
              VALUES ('$nama', '$nohp', '$email', '$alamat', '$tanggal', '$jumlah', '$sesi')";
    mysqli_query($conn, $query);

    $id_pelanggan = mysqli_insert_id($conn);

    $_SESSION['id_pelanggan'] = $id_pelanggan;
    $_SESSION['nama'] = $nama;
    $_SESSION['tanggal'] = $tanggal;
    $_SESSION['jumlah'] = $jumlah;
    $_SESSION['total'] = $total;

    header("Location: pembayaran.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Ticket Now | Denaniraso Art Exhibition</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background">
        <div class="booking-form">
            <h2>Denaniraso Art Exhibition</h2>
            <form action="" method="POST">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required>
                <small id="nama-error" style="color: red; display: none;">Hanya boleh huruf (A–Z atau a–z).</small>

                <label for="nohp">No Handphone:</label>
                <input type="tel" name="nohp" id="nohp" required>
                <small id="nohp-error" style="color: red; display: none;">Hanya boleh angka.</small>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" required></textarea>

                <label for="tgkj">Tanggal Kunjungan:</label>
                <input type="date" name="tgkj" id="tgkj" required>

                <label for="jumlah">Jumlah Pengunjung:</label>
                <input type="number" name="jumlah" id="jumlah" min="1" max="3" required>
                <p id="total-harga" style="color: white; font-weight: bold;"></p>

                <label for="sesi">Pilih Sesi Kunjungan:</label>
                <select name="sesi" id="sesi" required>
                    <option value="">-- Pilih Sesi --</option>
                    <option value="Sesi 1">Sesi 1 - 09:00 - 10:30</option>
                    <option value="Sesi 2">Sesi 2 - 11:00 - 12:30</option>
                    <option value="Sesi 3">Sesi 3 - 13:00 - 14:30</option>
                    <option value="Sesi 4">Sesi 4 - 15:00 - 16:30</option>
                </select>

                <button type="submit">BOOK NOW</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>

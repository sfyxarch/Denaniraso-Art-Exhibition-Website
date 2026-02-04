<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "epen";

$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $no_hp = $_POST["nohp"];
    $gmail = $_POST["email"];
    $alamat = $_POST["alamat"];
    $tanggal_kunjung = $_POST["tgkj"];
    $jumlah = (int)$_POST["jumlah"];
    $harga_per_tiket = 25000; // Contoh harga
    $harga_total = $jumlah * $harga_per_tiket;

    $sql = "INSERT INTO data_tiket (nama, no_hp, gmail, alamat, tanggal_kunjung, jumlah, harga)
            VALUES ('$nama', '$no_hp', '$gmail', '$alamat', '$tanggal_kunjung', $jumlah, $harga_total)";

    if ($conn->query($sql) === TRUE) {
    $id_pelanggan = $conn->insert_id; // Ambil ID yang baru dimasukkan
    header("Location: ../../denaniraso/pembayaran/pembayaran.php?id=$id_pelanggan");
    exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
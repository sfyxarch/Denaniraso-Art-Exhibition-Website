<?php
$conn = new mysqli("localhost", "root", "", "epen");

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    // Hapus pembayaran terkait terlebih dahulu
    $conn->query("DELETE FROM pembayaran WHERE id_pelanggan = $id");

    // Setelah itu baru hapus data pelanggan
    $sql = "DELETE FROM data_tiket WHERE id_pelanggan = $id";
    if ($conn->query($sql)) {
        header("Location: data_tiket.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
}
?>

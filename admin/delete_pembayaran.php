<?php
$conn = new mysqli("localhost", "root", "", "epen");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // hapus gambar dulu (optional)
    $res = $conn->query("SELECT gambar FROM pembayaran WHERE id_bayar = $id");
    if ($res && $row = $res->fetch_assoc()) {
        $gambar = $row["gambar"];
        if ($gambar && file_exists("uploads/" . $gambar)) {
            unlink("uploads/" . $gambar);
        }
    }

    $sql = "DELETE FROM pembayaran WHERE id_bayar = $id";
    if ($conn->query($sql)) {
        header("Location: pembayaran.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
}
?>

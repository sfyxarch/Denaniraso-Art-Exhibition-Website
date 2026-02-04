<?php
$conn = new mysqli("localhost", "root", "", "epen");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM pembayaran");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pembayaran</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Data Pembayaran</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pelanggan</th>
                <th>Metode</th>
                <th>Bukti</th>
                <th>Jumlah</th>
                <th>Total Bayar</th>
                <th>Tanggal Kunjung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_bayar'] ?></td>
                    <td><?= $row['id_pelanggan'] ?></td>
                    <td><?= htmlspecialchars($row['metode']) ?></td>
                    <td>
                        <?php if (!empty($row['gambar'])): ?>
                            <a href="#img<?= $row['id_bayar'] ?>">
                                <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="preview-img" alt="Bukti">
                            </a>

                            <!-- Gambar popup -->
                            <div id="img<?= $row['id_bayar'] ?>" class="overlay">
                                <a href="#" class="close-btn">&times;</a>
                                <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Bukti Bayar">
                            </div>
                        <?php else: ?>
                            Tidak ada
                        <?php endif; ?>
                    </td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['total_bayar'] ?></td>
                    <td><?= $row['tanggal_kunjung'] ?></td>
                    <td>
                        <a href="edit_pembayaran.php?id=<?= $row['id_bayar'] ?>" class="button">Edit</a>
                        <a href="delete_pembayaran.php?id=<?= $row['id_bayar'] ?>" class="button"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br><br>
    <a href="add_pembayaran.php" class="button">+ Tambah Data Pembayaran</a>
    <input type="button" class="button" value="Batal" onclick="window.location.href='index.php'">

</body>

</html>
<?php
$conn = new mysqli("localhost", "root", "", "epen");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM data_tiket");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tiket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Data Tiket</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Gmail</th>
                <th>Alamat</th>
                <th>Tanggal Kunjung</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_pelanggan'] ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['no_hp']) ?></td>
                    <td><?= htmlspecialchars($row['gmail']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= $row['tanggal_kunjung'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td>
                        <a href="edit_tiket.php?id=<?= $row['id_pelanggan'] ?>" class="button">Edit</a>
                        <a href="delete_tiket.php?id=<?= $row['id_pelanggan'] ?>" class="button"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br><br>
    <a href="add_tiket.php" class="button">+ Tambah Data Tiket</a>
    <a href="index.php" class="button">Batal</a>

</body>
</html>

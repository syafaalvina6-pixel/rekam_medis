<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM obat WHERE id_obat='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama   = $_POST['nama_obat'];
    $satuan = $_POST['satuan'];
    $stok   = $_POST['stok'];

    mysqli_query($koneksi, "UPDATE obat SET nama_obat='$nama', satuan='$satuan', stok='$stok' WHERE id_obat='$id'");
    header("location:obat.php?pesan=update");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Obat - Rekam Medis</title>
    <link rel="stylesheet" href="style.css?v=8">
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            <div class="brand-icon">+</div>
            <h2>MedisCare</h2>
        </div>
        <ul class="nav-menu">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="pasien.php">Data Pasien</a></li>
            <li><a href="dokter.php">Data Dokter</a></li>
            <li><a href="obat.php" class="active">Data Obat</a></li>
            <li><a href="rekam_medis.php">Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1>Edit Data Obat</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Ubah Informasi Obat</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" value="<?= $d['nama_obat'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" value="<?= $d['satuan'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input type="number" name="stok" value="<?= $d['stok'] ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                    <a href="obat.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama         = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    mysqli_query($koneksi, "UPDATE dokter SET nama_dokter='$nama', spesialisasi='$spesialisasi' WHERE id_dokter='$id'");
    header("location:dokter.php?pesan=update");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Dokter - Rekam Medis</title>
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
            <li><a href="dokter.php" class="active">Data Dokter</a></li>
            <li><a href="obat.php">Data Obat</a></li>
            <li><a href="rekam_medis.php">Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1>Edit Data Dokter</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Ubah Informasi Dokter</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Nama Dokter</label>
                    <input type="text" name="nama_dokter" value="<?= $d['nama_dokter'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Spesialisasi</label>
                    <input type="text" name="spesialisasi" value="<?= $d['spesialisasi'] ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                    <a href="dokter.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
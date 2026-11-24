<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $no_rm  = $_POST['no_rm'];
    $nama   = $_POST['nama_pasien'];
    $jk     = $_POST['jenis_kelamin'];
    $tgl    = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "UPDATE pasien SET no_rm='$no_rm', nama_pasien='$nama', jenis_kelamin='$jk', tanggal_lahir='$tgl', alamat='$alamat' WHERE id_pasien='$id'");
    header("location:pasien.php?pesan=update");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pasien - Rekam Medis</title>
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
            <li><a href="pasien.php" class="active">Data Pasien</a></li>
            <li><a href="dokter.php">Data Dokter</a></li>
            <li><a href="obat.php">Data Obat</a></li>
            <li><a href="rekam_medis.php">Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1>Edit Data Pasien</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Ubah Informasi Pasien</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>No RM</label>
                    <input type="text" name="no_rm" value="<?= $d['no_rm'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama_pasien" value="<?= $d['nama_pasien'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="L" <?= $d['jenis_kelamin']=='L'?'selected':''; ?>>Laki-laki (L)</option>
                        <option value="P" <?= $d['jenis_kelamin']=='P'?'selected':''; ?>>Perempuan (P)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="<?= $d['tanggal_lahir'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" required><?= $d['alamat'] ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                    <a href="pasien.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
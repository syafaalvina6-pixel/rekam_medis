<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $no_rm = $_POST['no_rm'];
    $nama  = $_POST['nama_pasien'];
    $jk    = $_POST['jenis_kelamin'];
    $tgl   = $_POST['tanggal_lahir'];
    $alamat= $_POST['alamat'];
    
    // Query INSERT yang spesifik tanpa mengisi ID secara manual
    $query = "INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat) 
              VALUES ('$no_rm', '$nama', '$jk', '$tgl', '$alamat')";
    
    $hasil = mysqli_query($koneksi, $query);

    if($hasil){
        header("location:pasien.php");
        exit();
    } else {
        die("Gagal menyimpan data pasien: " . mysqli_error($koneksi));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pasien - Rekam Medis</title>
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
            <h1>Tambah Data Pasien</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Input Informasi Pasien</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>No Rekam Medis (No RM)</label>
                    <input type="text" name="no_rm" placeholder="Contoh: RM-001" required>
                </div>

                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama_pasien" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki (L)</option>
                        <option value="P">Perempuan (P)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" required>
                </div>

                <div class="form-group">
                    <label>Alamat Pasien</label>
                    <textarea name="alamat" placeholder="Masukkan alamat domisili" required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                    <a href="pasien.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
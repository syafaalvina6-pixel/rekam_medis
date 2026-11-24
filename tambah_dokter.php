<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nama         = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];
    
    // Query INSERT spesifik menyebutkan nama kolom
    $query = "INSERT INTO dokter (nama_dokter, spesialisasi) 
              VALUES ('$nama', '$spesialisasi')";
    
    $hasil = mysqli_query($koneksi, $query);

    if($hasil){
        header("location:dokter.php");
        exit();
    } else {
        die("Gagal menyimpan data dokter: " . mysqli_error($koneksi));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Dokter - Rekam Medis</title>
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
            <h1>Tambah Data Dokter</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Input Dokter Baru</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Nama Dokter</label>
                    <input type="text" name="nama_dokter" placeholder="Contoh: dr. Andi Wijaya" required>
                </div>

                <div class="form-group">
                    <label>Spesialisasi</label>
                    <input type="text" name="spesialisasi" placeholder="Contoh: Dokter Umum / Spesialis Anak" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                    <a href="dokter.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
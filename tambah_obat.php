<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nama   = $_POST['nama_obat'];
    $satuan = $_POST['satuan'];
    $stok   = $_POST['stok'];
    
    // Query INSERT spesifik sebutkan kolom tanpa menyertakan ID (Auto Increment)
    $query = "INSERT INTO obat (nama_obat, satuan, stok) 
              VALUES ('$nama', '$satuan', '$stok')";
    
    $hasil = mysqli_query($koneksi, $query);

    if($hasil){
        header("location:obat.php");
        exit();
    } else {
        die("Gagal menyimpan data obat: " . mysqli_error($koneksi));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Obat - Rekam Medis</title>
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
            <h1>Tambah Data Obat</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Input Data Obat</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" placeholder="Contoh: Paracetamol 500mg" required>
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" placeholder="Contoh: Tablet / Kapsul / Botol" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input type="number" name="stok" placeholder="Masukkan jumlah stok awal" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                    <a href="obat.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
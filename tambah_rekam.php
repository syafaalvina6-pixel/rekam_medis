<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $id_obat   = $_POST['id_obat'];
    $tgl       = $_POST['tanggal_periksa'];
    $keluhan   = $_POST['keluhan'];
    $diagnosa  = $_POST['diagnosa'];
    $tindakan  = $_POST['tindakan'];
    $resep     = $_POST['resep'];

    // Query INSERT spesifik menyebutkan kolom tanpa mengganggu ID Auto Increment
    $query = "INSERT INTO rekam_medis (id_pasien, id_dokter, id_obat, tanggal_periksa, keluhan, diagnosa, tindakan, resep) 
              VALUES ('$id_pasien', '$id_dokter', '$id_obat', '$tgl', '$keluhan', '$diagnosa', '$tindakan', '$resep')";
    
    $hasil = mysqli_query($koneksi, $query);

    if($hasil){
        header("location:rekam_medis.php");
        exit();
    } else {
        die("Gagal menyimpan rekam medis: " . mysqli_error($koneksi));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Rekam Medis - Rekam Medis</title>
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
            <li><a href="obat.php">Data Obat</a></li>
            <li><a href="rekam_medis.php" class="active">Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1>Input Rekam Medis</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Catatan Pemeriksaan Baru</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Tanggal Periksa</label>
                    <input type="date" name="tanggal_periksa" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group">
                    <label>Pilih Pasien</label>
                    <select name="id_pasien" required>
                        <option value="">-- Pilih Pasien --</option>
                        <?php
                        $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                        while($p = mysqli_fetch_array($pasien)){
                            echo "<option value='".$p['id_pasien']."'>".$p['no_rm']." - ".$p['nama_pasien']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Dokter</label>
                    <select name="id_dokter" required>
                        <option value="">-- Pilih Dokter --</option>
                        <?php
                        $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                        while($d = mysqli_fetch_array($dokter)){
                            echo "<option value='".$d['id_dokter']."'>".$d['nama_dokter']." (".$d['spesialisasi'].")</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Obat</label>
                    <select name="id_obat" required>
                        <option value="">-- Pilih Obat --</option>
                        <?php
                        $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                        while($o = mysqli_fetch_array($obat)){
                            echo "<option value='".$o['id_obat']."'>".$o['nama_obat']." (Stok: ".$o['stok'].")</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keluhan Pasien</label>
                    <textarea name="keluhan" placeholder="Keluhan yang dirasakan pasien" required></textarea>
                </div>

                <div class="form-group">
                    <label>Hasil Diagnosa</label>
                    <textarea name="diagnosa" placeholder="Hasil diagnosa dokter" required></textarea>
                </div>

                <div class="form-group">
                    <label>Tindakan Medis</label>
                    <textarea name="tindakan" placeholder="Tindakan yang diberikan" required></textarea>
                </div>

                <div class="form-group">
                    <label>Resep & Aturan Pakai</label>
                    <input type="text" name="resep" placeholder="Contoh: 3x1 sesudah makan" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Rekam Medis</button>
                    <a href="rekam_medis.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
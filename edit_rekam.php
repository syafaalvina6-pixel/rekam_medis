<?php
include 'koneksi.php';
$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM rekam_medis WHERE id_rekam='$id'");
$rm = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $id_obat   = $_POST['id_obat'];
    $tgl       = $_POST['tanggal_periksa'];
    $keluhan   = $_POST['keluhan'];
    $diagnosa  = $_POST['diagnosa'];
    $tindakan  = $_POST['tindakan'];
    $resep     = $_POST['resep'];

    mysqli_query($koneksi, "UPDATE rekam_medis SET id_pasien='$id_pasien', id_dokter='$id_dokter', id_obat='$id_obat', tanggal_periksa='$tgl', keluhan='$keluhan', diagnosa='$diagnosa', tindakan='$tindakan', resep='$resep' WHERE id_rekam='$id'");
    header("location:rekam_medis.php?pesan=update");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Rekam Medis - Rekam Medis</title>
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
            <h1>Edit Rekam Medis</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <div class="container form-container">
            <div class="header-title">
                <h3>Ubah Catatan Pemeriksaan</h3>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Tanggal Periksa</label>
                    <input type="date" name="tanggal_periksa" value="<?= $rm['tanggal_periksa'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Pilih Pasien</label>
                    <select name="id_pasien" required>
                        <?php
                        $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                        while($p = mysqli_fetch_array($pasien)){
                            $sel = ($p['id_pasien'] == $rm['id_pasien']) ? 'selected' : '';
                            echo "<option value='".$p['id_pasien']."' $sel>".$p['no_rm']." - ".$p['nama_pasien']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Dokter</label>
                    <select name="id_dokter" required>
                        <?php
                        $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                        while($d = mysqli_fetch_array($dokter)){
                            $sel = ($d['id_dokter'] == $rm['id_dokter']) ? 'selected' : '';
                            echo "<option value='".$d['id_dokter']."' $sel>".$d['nama_dokter']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Obat</label>
                    <select name="id_obat" required>
                        <?php
                        $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                        while($o = mysqli_fetch_array($obat)){
                            $sel = ($o['id_obat'] == $rm['id_obat']) ? 'selected' : '';
                            echo "<option value='".$o['id_obat']."' $sel>".$o['nama_obat']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea name="keluhan" required><?= $rm['keluhan'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Diagnosa</label>
                    <textarea name="diagnosa" required><?= $rm['diagnosa'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Tindakan</label>
                    <textarea name="tindakan" required><?= $rm['tindakan'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Resep</label>
                    <input type="text" name="resep" value="<?= $rm['resep'] ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">Update Rekam Medis</button>
                    <a href="rekam_medis.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include 'koneksi.php';

$p_pasien = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pasien");
$total_pasien = mysqli_fetch_assoc($p_pasien)['total'];

$p_dokter = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM dokter");
$total_dokter = mysqli_fetch_assoc($p_dokter)['total'];

$p_obat = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM obat");
$total_obat = mysqli_fetch_assoc($p_obat)['total'];

$p_rekam = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM rekam_medis");
$total_rekam = mysqli_fetch_assoc($p_rekam)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Rekam Medis Soft Lilac</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>
    <!-- Sidebar Kiri (Persis Preview) -->
    <div class="sidebar">
        <div class="brand">
            <div class="brand-icon">+</div>
            <h2>MedisCare</h2>
        </div>
        
        <ul class="nav-menu">
            <li><a href="index.php" class="active">Dashboard</a></li>
            <li><a href="pasien.php">Data Pasien</a></li>
            <li><a href="dokter.php">Data Dokter</a></li>
            <li><a href="obat.php">Data Obat</a></li>
            <li><a href="rekam_medis.php">Rekam Medis</a></li>
        </ul>
    </div>

    <!-- Area Konten Utama -->
    <div class="main-content">
        <div class="top-bar">
            <h1>Dashboard Sistem Informasi</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
            </div>
        </div>

        <!-- Kartu Statistik -->
        <div class="cards">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">TOTAL PASIEN</span>
                    <div class="card-icon">P</div>
                </div>
                <h2><?= $total_pasien ?></h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <span class="card-title">TOTAL DOKTER</span>
                    <div class="card-icon">D</div>
                </div>
                <h2><?= $total_dokter ?></h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <span class="card-title">TOTAL OBAT</span>
                    <div class="card-icon">O</div>
                </div>
                <h2><?= $total_obat ?></h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <span class="card-title">REKAM MEDIS</span>
                    <div class="card-icon">R</div>
                </div>
                <h2><?= $total_rekam ?></h2>
            </div>
        </div>

        <!-- Tabel Ringkasan Rekam Medis Terbaru -->
        <div class="container">
            <div class="header-title">
                <h3>Pemeriksaan Terbaru</h3>
                <a href="tambah_rekam.php" class="btn btn-primary">+ Tambah Rekam Medis</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Obat</th>
                        <th>Diagnosa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT rekam_medis.*, pasien.nama_pasien, dokter.nama_dokter, obat.nama_obat 
                            FROM rekam_medis 
                            INNER JOIN pasien ON rekam_medis.id_pasien = pasien.id_pasien
                            INNER JOIN dokter ON rekam_medis.id_dokter = dokter.id_dokter
                            INNER JOIN obat ON rekam_medis.id_obat = obat.id_obat
                            ORDER BY rekam_medis.id_rekam DESC LIMIT 5";
                    $query = mysqli_query($koneksi, $sql);
                    $no = 1;

                    if(mysqli_num_rows($query) > 0){
                        while($d = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['tanggal_periksa']; ?></td>
                        <td><strong><?= $d['nama_pasien']; ?></strong></td>
                        <td><?= $d['nama_dokter']; ?></td>
                        <td><span class="badge badge-purple"><?= $d['nama_obat']; ?></span></td>
                        <td><?= $d['diagnosa']; ?></td>
                    </tr>
                    <?php 
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 24px;">
                            Belum ada riwayat pemeriksaan. Klik <strong>+ Tambah Rekam Medis</strong> untuk mencatat.
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
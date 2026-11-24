<?php
include 'koneksi.php';

$sql = "SELECT rekam_medis.*, pasien.nama_pasien, dokter.nama_dokter, obat.nama_obat 
        FROM rekam_medis 
        INNER JOIN pasien ON rekam_medis.id_pasien = pasien.id_pasien
        INNER JOIN dokter ON rekam_medis.id_dokter = dokter.id_dokter
        INNER JOIN obat ON rekam_medis.id_obat = obat.id_obat
        ORDER BY rekam_medis.id_rekam DESC";

$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekam Medis - Rekam Medis</title>
    <link rel="stylesheet" href="style.css?v=10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1>Riwayat Rekam Medis</h1>
            <div class="top-right-group">
                <div class="datetime-badge">
                    <span id="tanggal-live">Memuat tanggal...</span>
                    <span>•</span>
                    <span id="jam-live">00:00:00</span>
                </div>
                <div class="user-profile">
                    <div class="avatar">A</div>
                    <span style="font-weight: 600; font-size: 14px;">Admin Medis</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="header-title">
                <h3>Catatan Pemeriksaan</h3>
                <a href="tambah_rekam.php" class="btn btn-primary">+ Tambah Catatan Medis</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl Periksa</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th>Obat & Resep</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($query) > 0){
                        while($d = mysqli_fetch_array($query)){ 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['tanggal_periksa']; ?></td>
                        <td><strong><?= $d['nama_pasien']; ?></strong></td>
                        <td><?= $d['nama_dokter']; ?></td>
                        <td><?= $d['keluhan']; ?></td>
                        <td><?= $d['diagnosa']; ?></td>
                        <td><?= $d['tindakan']; ?></td>
                        <td><span class="badge badge-purple"><?= $d['nama_obat']; ?></span><br><small style="color:var(--text-muted);"><?= $d['resep']; ?></small></td>
                        <td>
                            <a href="edit_rekam.php?id=<?= $d['id_rekam']; ?>" class="btn btn-warning">Edit</a>
                            <a href="javascript:void(0)" onclick="konfirmasiHapus('hapus_rekam.php?id=<?= $d['id_rekam']; ?>')" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                    <tr>
                        <td colspan="9" style="text-align: center; color: var(--text-muted); padding: 32px;">
                            Belum ada riwayat rekam medis. Klik <strong>+ Tambah Catatan Medis</strong> di atas.
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function updateWaktu() {
        const sekarang = new Date();
        const opsiTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('tanggal-live').textContent = sekarang.toLocaleDateString('id-ID', opsiTanggal);
        
        const jam   = String(sekarang.getHours()).padStart(2, '0');
        const menit = String(sekarang.getMinutes()).padStart(2, '0');
        const detik = String(sekarang.getSeconds()).padStart(2, '0');
        document.getElementById('jam-live').textContent = `${jam}:${menit}:${detik} WIB`;
    }
    updateWaktu();
    setInterval(updateWaktu, 1000);

    function konfirmasiHapus(urlHapus) {
        Swal.fire({
            title: 'Hapus Rekam Medis?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8B5CF6',
            cancelButtonColor: '#EF4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#FFFFFF',
            color: '#2E1065'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlHapus;
            }
        });
    }
    </script>

    <?php if(isset($_GET['pesan'])): ?>
    <script>
        <?php if($_GET['pesan'] == 'update'): ?>
            Swal.fire({ title: 'Berhasil!', text: 'Catatan rekam medis berhasil diperbarui.', icon: 'success', confirmButtonColor: '#8B5CF6', background: '#FFFFFF', color: '#2E1065' });
        <?php elseif($_GET['pesan'] == 'hapus'): ?>
            Swal.fire({ title: 'Terhapus!', text: 'Catatan rekam medis berhasil dihapus.', icon: 'success', confirmButtonColor: '#8B5CF6', background: '#FFFFFF', color: '#2E1065' });
        <?php elseif($_GET['pesan'] == 'gagal_hapus'): ?>
            Swal.fire({ title: 'Gagal Menghapus!', text: 'Terjadi kesalahan saat menghapus data.', icon: 'error', confirmButtonColor: '#8B5CF6', background: '#FFFFFF', color: '#2E1065' });
        <?php endif; ?>
        window.history.replaceState(null, null, window.location.pathname);
    </script>
    <?php endif; ?>
</body>
</html>
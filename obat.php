<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM obat");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Obat - Rekam Medis</title>
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
            <li><a href="obat.php" class="active">Data Obat</a></li>
            <li><a href="rekam_medis.php">Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1>Manajemen Data Obat</h1>
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
                <h3>Data Obat</h3>
                <a href="tambah_obat.php" class="btn btn-primary">+ Tambah Obat</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th>Nama Obat</th>
                        <th>Satuan</th>
                        <th width="15%">Stok</th>
                        <th width="20%">Aksi</th>
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
                        <td><strong><?= $d['nama_obat']; ?></strong></td>
                        <td><?= $d['satuan']; ?></td>
                        <td><span class="badge badge-purple"><?= $d['stok']; ?> item</span></td>
                        <td>
                            <a href="edit_obat.php?id=<?= $d['id_obat']; ?>" class="btn btn-warning">Edit</a>
                            <a href="javascript:void(0)" onclick="konfirmasiHapus('hapus_obat.php?id=<?= $d['id_obat']; ?>')" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 32px;">
                            Belum ada data obat. Klik <strong>+ Tambah Obat</strong> di atas untuk menambah data baru.
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
            title: 'Hapus Data Obat?',
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
            Swal.fire({ title: 'Berhasil!', text: 'Data obat berhasil diperbarui.', icon: 'success', confirmButtonColor: '#8B5CF6', background: '#FFFFFF', color: '#2E1065' });
        <?php elseif($_GET['pesan'] == 'hapus'): ?>
            Swal.fire({ title: 'Terhapus!', text: 'Data obat berhasil dihapus.', icon: 'success', confirmButtonColor: '#8B5CF6', background: '#FFFFFF', color: '#2E1065' });
        <?php elseif($_GET['pesan'] == 'gagal_hapus'): ?>
            Swal.fire({ title: 'Gagal Menghapus!', text: 'Data obat ini masih terhubung dengan riwayat Rekam Medis.', icon: 'error', confirmButtonColor: '#8B5CF6', background: '#FFFFFF', color: '#2E1065' });
        <?php endif; ?>
        window.history.replaceState(null, null, window.location.pathname);
    </script>
    <?php endif; ?>
</body>
</html>
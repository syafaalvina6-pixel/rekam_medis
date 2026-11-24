<?php
include 'koneksi.php';

if(isset($_GET['id'])){$id = mysqli_real_escape_string($koneksi,$_GET['id']);
    
    // Nonaktifkan pelaporan exception fatal agar tidak blank screen saat terkena Foreign Key
    mysqli_report(MYSQLI_REPORT_OFF);
    $query = mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien='$id'");

    if($query && mysqli_affected_rows($koneksi) > 0){
        header("location:pasien.php?pesan=hapus");
    } else {
        header("location:pasien.php?pesan=gagal_hapus");
    }
    exit();
}
?>
<?php
include 'koneksi.php';

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    mysqli_report(MYSQLI_REPORT_OFF);
    $query = mysqli_query($koneksi, "DELETE FROM obat WHERE id_obat='$id'");

    if($query && mysqli_affected_rows($koneksi) > 0){
        header("location:obat.php?pesan=hapus");
    } else {
        header("location:obat.php?pesan=gagal_hapus");
    }
    exit();
}
?>
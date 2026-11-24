<?php
include 'koneksi.php';

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    mysqli_report(MYSQLI_REPORT_OFF);
    $query = mysqli_query($koneksi, "DELETE FROM dokter WHERE id_dokter='$id'");

    if($query && mysqli_affected_rows($koneksi) > 0){
        header("location:dokter.php?pesan=hapus");
    } else {
        header("location:dokter.php?pesan=gagal_hapus");
    }
    exit();
}
?>
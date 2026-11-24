<?php
include 'koneksi.php';

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    mysqli_report(MYSQLI_REPORT_OFF);
    $query = mysqli_query($koneksi, "DELETE FROM rekam_medis WHERE id_rekam='$id'");

    if($query && mysqli_affected_rows($koneksi) > 0){
        header("location:rekam_medis.php?pesan=hapus");
    } else {
        header("location:rekam_medis.php?pesan=gagal_hapus");
    }
    exit();
}
?>
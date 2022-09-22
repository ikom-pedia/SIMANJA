<?php
session_start();
include('../koneksi.php');

// HAPUS DETAIL PENGAJUAN
if ($_GET['act'] == 'hapus-pengajuan') {
    $nopengajuan = $_GET['id'];
    $nim = $_SESSION['id'];

    $hapus = "DELETE FROM detail_pengajuan WHERE nopengajuan='$nopengajuan' AND nim='$nim'";
    if (mysqli_query($koneksi, $hapus)) {
        echo '<script>alert("Data Berhasil Dihapus!"); document.location="pengajuan.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Dihapus!"); document.location="pengajuan.php";</script>';
    }
}

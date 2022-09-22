<?php
session_start();
include('koneksi.php');
session_destroy();
echo "<script>alert('Berhasil logout!'); document.location='login.php?pesan=logout';</script>";

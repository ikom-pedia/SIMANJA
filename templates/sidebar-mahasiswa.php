<?php
include('../templates/header.php');
include('../templates/model-mahasiswa.php');
$hak_akses = $_SESSION['hakakses'];

if ($hak_akses != "mahasiswa") {
    echo '<script>alert("Maaf, anda bukan mahasiswa!"); document.location="' . $base_url . $hak_akses . '";</script>';
    // header("location:javascript://history.go(-1)");
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <img src="<?= $base_url ?>assets/uploads/foto/default/logo-lp3i.png" style="width:23%">
        <div class="sidebar-brand-text mx-3">SIMANJA <sup>v1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php
    if ($page == "LP3I Banten") {
        echo '<li class="nav-item active">';
    } else {
        echo '<li class="nav-item">';
    } ?>
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Profil -->
    <?php
    if ($page == "Profil") {
        echo '<li class="nav-item active">';
    } else {
        echo '<li class="nav-item">';
    } ?>
    <a class="nav-link" href="<?= $base_url ?>mahasiswa/profil.php">
        <i class="fas fa-address-card"></i>
        <span>Profil</span></a>
    </li>

    <!-- Nav Item - Akun -->
    <?php
    if ($page == "Akun") {
        echo '<li class="nav-item active">';
    } else {
        echo '<li class="nav-item">';
    } ?>
    <a class="nav-link" href="<?= $base_url ?>mahasiswa/akun.php">
        <i class="fas fa-user"></i>
        <span>Akun</span></a>
    </li>

    <!-- Nav Item - Ajukan Magang -->
    <?php
    if ($page == "Pengajuan") {
        echo '<li class="nav-item active">';
    } else {
        echo '<li class="nav-item">';
    } ?>
    <a class="nav-link" href="<?= $base_url ?>mahasiswa/pengajuan.php">
        <i class="fas fa-clipboard"></i>
        <span>Ajukan Magang</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<?php
include('../templates/topbar-mahasiswa.php');
?>
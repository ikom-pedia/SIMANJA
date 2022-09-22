<?php
include('../templates/header.php');
include('../templates/collapse.php');
include('../templates/model-data.php');
$hak_akses = $_SESSION['hakakses'];

if ($hak_akses != "admin") {
    echo '<script>alert("Maaf, anda bukan admin!"); document.location="' . $base_url . $hak_akses . '";</script>';
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
    <a class="nav-link" href="dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Data Master -->
    <?= $collapse1 ?>
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="<?= $list1_item1 ?>" href="<?= $base_url ?>admin/user.php">User</a>
        <a class="<?= $list1_item2 ?>" href="<?= $base_url ?>admin/mahasiswa.php">Mahasiswa</a>
        <a class="<?= $list1_item3 ?>" href="<?= $base_url ?>admin/nilai.php">Nilai</a>
        <a class="<?= $list1_item4 ?>" href="<?= $base_url ?>admin/perusahaan.php">Relasi Perusahaan</a>
        <a class="<?= $list1_item5 ?>" href="<?= $base_url ?>admin/kelas.php">Kelas</a>
    </div>
    </div>
    </li>

    <!-- Nav Item - Pages Collapse Status -->
    <?= $collapse2 ?>
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="<?= $list2_item1 ?>" href="<?= $base_url ?>admin/kerja.php">Kerja</a>
        <a class="<?= $list2_item2 ?>" href="<?= $base_url ?>admin/magang.php">Magang</a>
        <a class="<?= $list2_item3 ?>" href="<?= $base_url ?>admin/free.php">Free</a>
        <a class="<?= $list2_item4 ?>" href="<?= $base_url ?>admin/gugur.php">Gugur</a>
    </div>
    </div>
    </li>

    <!-- Nav Item - Pages Collapse Pengajuan -->
    <?= $collapse3 ?>
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="<?= $list3_item1 ?>" href="<?= $base_url ?>admin/pengajuan.php">Pengajuan</a>
        <a class="<?= $list3_item2 ?>" href="<?= $base_url ?>admin/konfirmasi.php">Konfirmasi</a>
    </div>
    </div>
    </li>

    <!-- Nav Item - Laporan -->
    <?php
    if ($page == "Laporan") {
        echo '<li class="nav-item active">';
    } else {
        echo '<li class="nav-item">';
    } ?>
    <a class="nav-link" href="<?= $base_url ?>admin/laporan.php">
        <i class="fas fa-print"></i>
        <span>Laporan</span></a>
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
include('../templates/topbar.php');
?>
<?php
$page = "Laporan";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan FR004</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <p>Pilih/Input nama <strong>Mahasiswa</strong> yang akan di cetak:</p>

                    <div class="card-body">
                        <!-- <form action="cetak-fr0042.php" target="_blank" class="form-horizontal" method="GET"> -->
                        <form action="cetak-fr004.php" target="_blank" class="form-horizontal" method="GET">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2bs4" name="nim" style="width: 100%;" required>
                                        <option value="" disabled selected=selected></option>
                                        <?php
                                        $carimahasiswa =  mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN user u JOIN kelas k WHERE m.nim=u.id
                                                                              AND m.idkelas=k.idkelas AND thnajaran='$tahun'");
                                        foreach ($carimahasiswa as $list) {
                                        ?>
                                            <option value="<?= $list['nim']; ?>"><?= ucwords($list['nama']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fas fa-print"></i> Cetak
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan Persentase</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <p>Klik tombol <strong>Cetak</strong> untuk mencetak laporan :</p>

                    <div class="card-body">
                        <a href="cetak-persentase.php" target="_blank" class="btn btn-secondary">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
include('../templates/footer.php');
?>
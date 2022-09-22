<?php
$page = "Kerja";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mahasiswa Status Kerja</h1>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>JURUSAN</th>
                            <th>TEMPAT KERJA</th>
                            <th>SEBAGAI</th>
                            <th>NOMOR HP</th>
                            <th>STATUS</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($mahasiswakerja as $data) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $data['nim'] ?></td>
                                <td><?= ucwords($data['nama']) ?></td>
                                <td class=""><?= ucwords($data['jurusan']) ?></td>
                                <td><?= strtoupper($data['namapt']) ?></td>
                                <td class="text-center"><?= ucwords($data['posisi_sbg']) ?></td>
                                <td class="text-center"><?= $data['nohp'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($data['statuspengajuan'] == 1) {
                                        echo '<a href="detail-pengajuan.php?id=' . $data['nopengajuan'] . '" class="btn btn-sm btn-success">Kerja</a>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="detail.php?nim=<?= $data['nim'] ?>" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-address-card"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
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
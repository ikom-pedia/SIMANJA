<?php
$page = "Konfirmasi";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Konfirmasi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Magang Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NAMA</th>
                            <th>TANGGAL</th>
                            <th>PERIHAL</th>
                            <th>PERUSAHAAN</th>
                            <th>SEBAGAI</th>
                            <th>TGL MULAI</th>
                            <th>TGL SELESAI</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $konfirmasi = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN user u JOIN perusahaan pt
                        WHERE dp.nim=u.id AND p.nopengajuan=dp.nopengajuan AND p.idperusahaan=pt.idperusahaan AND statuspengajuan=2");
                        foreach ($konfirmasi as $data) {
                        ?>
                            <tr>
                                <td class="text-center"><?= ucwords($data['nama']) ?></td>
                                <td class="text-center"><?= $data['tanggal'] ?></td>
                                <td class="text-center"><?= ucwords($data['perihal']) ?></td>
                                <td><?= strtoupper($data['namapt']) ?></td>
                                <td class="text-center"><?= ucwords($data['posisi_sbg']) ?></td>
                                <td class="text-center"><?= $data['tglmulai'] ?></td>
                                <td class="text-center"><?= $data['tglselesai'] ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-warning">Menunggu</button>
                                        <button type="button" class="btn btn-sm btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class='btn btn-sm btn-success dropdown-item' href='aksi-get.php?id=<?= $data['nopengajuan'] ?>&act=status-konfirmasi'>Konfirmasi</a>
                                            <a class='btn btn-sm btn-danger dropdown-item' href='aksi-get.php?id=<?= $data['nopengajuan'] ?>&act=status-tolak'>Tolak</a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#hapus-pengajuan<?= $data['nopengajuan'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>


                                    <!-- ###########  IKI BARIS KODE MODAL (FORM HAPUS USER) CUY..  ########### -->
                                    <div class="modal fade text-left" id="hapus-pengajuan<?= $data['nopengajuan'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Konfirmasi Hapus</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hiden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Pengajuan Magang dari <strong><?= $data['nama'] ?></strong>?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <a href="aksi-get.php?act=hapus-pengajuan&id=<?= $data['nopengajuan'] ?>" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ######################################################################## -->
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
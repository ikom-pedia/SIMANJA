<?php
$page = "Pengajuan";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pengajuan</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Magang</h6>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#tambah-pengajuan"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NO PENGAJUAN</th>
                            <th>TANGGAL</th>
                            <th>PERIHAL</th>
                            <th>PERUSAHAAN</th>
                            <th>STATUS</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pengajuan as $data) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $data['nopengajuan'] ?></td>
                                <td class="text-center"><?= $data['tanggal'] ?></td>
                                <td class="text-center"><?= ucwords($data['perihal']) ?></td>
                                <td><?= strtoupper($data['namapt']) ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php
                                        $nopengajuan = $data['nopengajuan'];
                                        $caridetail = mysqli_query($koneksi, "SELECT * FROM detail_pengajuan WHERE nopengajuan='$nopengajuan'");
                                        $cek = mysqli_num_rows($caridetail);

                                        if ($cek < 1) {
                                            echo '<button type="button" class="btn btn-sm btn-danger">DATA KOSONG</button>';
                                        } elseif ($data['statuspengajuan'] == 1 && $data['perihal'] == 'Magang') {
                                            echo '<button type="button" class="btn btn-sm btn-warning">SEDANG MAGANG</button>
                                                  <button type="button" class="btn btn-sm btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <div class="dropdown-menu" role="menu">
                                                    <a class="btn btn-sm btn-success dropdown-item" href="aksi-get.php?id=' . $data['nopengajuan'] . '&act=status-selesai">SELESAI</a>
                                                  </div>';
                                        } elseif ($data['statuspengajuan'] == 1 && $data['perihal'] == 'Kerja') {
                                            echo '<button type="button" class="btn btn-sm btn-info">SEDANG KERJA</button>
                                                  <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <div class="dropdown-menu" role="menu">
                                                    <a class="btn btn-sm btn-success dropdown-item" href="aksi-get.php?id=' . $data['nopengajuan'] . '&act=status-selesai">SELESAI</a>
                                                  </div>';
                                        } elseif ($data['statuspengajuan'] == 4) {
                                            echo '<button type="button" class="btn btn-sm btn-success">SELESAI</button>';
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="detail-pengajuan.php?id=<?= $data['nopengajuan'] ?>" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapus" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#hapus-pengajuan<?= $data['nopengajuan'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <!-- ###########  IKI BARIS KODE MODAL (FORM HAPUS PENGAJUAN) CUY..  ########### -->
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
                                                    <p>Apakah anda yakin ingin menghapus pengajuan magang dengan No. Pengajuan <strong><?= $data['nopengajuan'] ?></strong>?</p>
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


<!-- ###########  IKI BARIS KODE MODAL (FORM TAMBAH PENGAJUAN) CUY..  ########### -->
<div class="modal fade text-left" id="tambah-pengajuan" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Form Pengajuan Magang</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hiden="true">&times;</span>
                </button>
            </div>
            <form action="aksi-post.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <?php
                            $carinopengajuan = mysqli_query($koneksi, "SELECT max(nopengajuan) AS kodeTerbesar FROM pengajuan");
                            $kode = mysqli_fetch_array($carinopengajuan);
                            $nopengajuan = substr(date('d-m-Y'), -2) . substr(date('d-m-Y'), 3, 2) . sprintf("%02s", 1);

                            if (substr($kode['kodeTerbesar'], 0, 4) == substr($nopengajuan, 0, 4)) {
                                $nopengajuan = $kode['kodeTerbesar'] + 1;
                            }
                            ?>
                            <label><strong>No. Pengajuan :</strong></label>
                            <input name="nopengajuan" id="nopengajuan" class="form-control" value="<?= $nopengajuan ?>" readonly>
                        </div>

                        <div class="form-group col-6">
                            <label><strong>Tanggal :</strong></label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label><strong>Perihal :</strong></label>
                            <select class="form-control" name="perihal" required>
                                <option value="" disabled selected=selected></option>
                                <option value="Magang">Magang</option>
                                <option value="Kerja">Kerja</option>
                            </select>
                        </div>

                        <div class="form-group col-8">
                            <label><strong>Nama Perusahaan :</strong></label>
                            <select class="form-control select2bs4" name="idperusahaan" style="width: 100%;" required>
                                <option value="" disabled selected=selected></option>
                                <?php
                                foreach ($optperusahaan as $list) {
                                ?>
                                    <option value="<?= $list['idperusahaan']; ?>"><?= strtoupper($list['namapt']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah-pengajuan" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ######################################################################## -->

<?php
include('../templates/footer.php');
?>
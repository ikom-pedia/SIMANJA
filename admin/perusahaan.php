<?php
$page = "Relasi";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Relasi Perusahaan</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary">Data Relasi</h6>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#tambah-relasi"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NAMA PERUSAHAAN</th>
                            <th>ALAMAT</th>
                            <th>TELEPON</th>
                            <th>BERGERAK DIBIDANG</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($relasi as $data) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= strtoupper($data['namapt']) ?></td>
                                <td><?= ucwords($data['alamatpt']) ?></td>
                                <td class="text-center"><?= $data['telepon'] ?></td>
                                <td><?= ucwords($data['bidang']) ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#ubah-data-perusahaan<?= $data['idperusahaan'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#hapus-perusahaan<?= $data['idperusahaan'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <!-- ###########  IKI BARIS KODE MODAL (FORM UBAH DATA PERUSAHAAN) CUY..  ########### -->
                                    <div class="modal fade text-left" id="ubah-data-perusahaan<?= $data['idperusahaan'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Ubah Data</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hiden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="aksi-post.php" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <div class="row no-gutters">
                                                                <div class="form-group col-md-4">
                                                                    <?php
                                                                    $logo = $data['logo'];
                                                                    if ($logo == "") {
                                                                        echo '<img class="card-img" src="' . $base_url . 'assets/uploads/foto/default/avatar.png">';
                                                                    } else {
                                                                        echo '<img class="card-img img-responsive img-thumbnail" src="' . $base_url . 'assets/uploads/foto/perusahaan/' . $logo . '">';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <input type="hidden" name="idperusahaan" value="<?= $data['idperusahaan'] ?>">
                                                                        <div class="form-group">
                                                                            <label><strong>Nama Perusahaan :</strong></label>
                                                                            <input type="text" class="form-control" maxlength="50" name="namapt" value="<?= strtoupper($data['namapt']) ?>" required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Alamat :</strong></label>
                                                                            <textarea type="text" class="form-control" maxlength="100" name="alamatpt" rows="2" required><?= ucwords($data['alamatpt']) ?></textarea>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Telepon :</strong></label>
                                                                            <input type="number" class="form-control" onkeypress="if(this.value.length==15)return false" name="telepon" value="<?= $data['telepon'] ?>">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Bergerak Dibidang :</strong></label>
                                                                            <input type="text" class="form-control" maxlength="30" name="bidang" value="<?= ucwords($data['bidang']) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="logo">
                                                                <label class="custom-file-label">Ubah Logo...</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="ubah-data-perusahaan" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ######################################################################## -->

                                    <!-- ###########  IKI BARIS KODE MODAL (FORM HAPUS PERUSAHAAN) CUY..  ########### -->
                                    <div class="modal fade text-left" id="hapus-perusahaan<?= $data['idperusahaan'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Konfirmasi Hapus</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hiden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Perusahaan <strong><?= strtoupper($data['namapt']) ?></strong> dari relasi?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <a href="aksi-get.php?act=hapus-perusahaan&id=<?= $data['idperusahaan'] ?>" class="btn btn-danger">Hapus</a>
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

<!-- ###########  IKI BARIS KODE MODAL (FORM TAMBAH RELASI) CUY..  ########### -->
<div class="modal fade text-left" id="tambah-relasi" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Tambah Relasi</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hiden="true">&times;</span>
                </button>
            </div>
            <form action="aksi-post.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>Nama Perusahaan :</strong></label>
                        <input type="text" class="form-control" maxlength="50" name="namapt" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Alamat :</strong></label>
                        <textarea type="text" class="form-control" maxlength="100" name="alamatpt" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label><strong>Telepon :</strong></label>
                        <input type="number" class="form-control" onkeypress="if(this.value.length==15)return false" name="telepon">
                    </div>

                    <div class="form-group">
                        <label><strong>Bergerak Dibidang :</strong></label>
                        <input type="text" class="form-control" maxlength="30" name="bidang">
                    </div>

                    <div align="center">
                        <div class="form-group">
                            <label><strong>Logo :</strong></label>
                            <div class="col-sm-6">
                                <img class="img-responsive img-thumbnail" src="<?= $base_url ?>assets/uploads/foto/default/avatar.png" style="max-width: 33%;">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="logo">
                                <label class="custom-file-label">Pilih Logo...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah-relasi" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ######################################################################## -->

<?php
include('../templates/footer.php');
?>
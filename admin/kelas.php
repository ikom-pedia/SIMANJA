<?php
$page = "Kelas";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelas</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#tambah-kelas"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NAMA KELAS</th>
                            <th>JURUSAN</th>
                            <th>TAHUN AJARAN</th>
                            <th>JUMLAH SISWA</th>
                            <th>WARNA</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kelas as $data) {
                            $idkelas = $data['idkelas'];
                            $totalsiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k WHERE m.idkelas=k.idkelas AND k.idkelas='$idkelas'");
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= strtoupper($data['namakelas']) ?></td>
                                <td><?= ucwords($data['jurusan']) ?></td>
                                <td class="text-center"><?= $data['thnajaran'] ?></td>
                                <td class="text-center"><?= mysqli_num_rows($totalsiswa) ?></td>
                                <td class="text-center">
                                    <div class="row">
                                        <div class="col">
                                            <div class="p-3 <?= $data['warna'] ?>"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#ubah-kelas<?= $data['idkelas'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#hapus-kelas<?= $data['idkelas'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <!-- ###########  IKI BARIS KODE MODAL (FORM UBAH DATA KELAS) CUY..  ########### -->
                                    <div class="modal fade text-left" id="ubah-kelas<?= $data['idkelas'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                        <div class="form-group">
                                                            <input type="hidden" name="idkelas" value="<?= $data['idkelas'] ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label><strong>Nama Kelas :</strong></label>
                                                            <input type="text" class="form-control" maxlength="10" name="namakelas" value="<?= strtoupper($data['namakelas']) ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label><strong>Jurusan :</strong></label>
                                                            <input type="text" class="form-control" maxlength="23" name="jurusan" value="<?= ucwords($data['jurusan']) ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label><strong>Tahun Ajaran :</strong></label>
                                                            <input type="number" class="form-control" name="thnajaran" onkeypress="if(this.value.length==4)return false" value="<?= $data['thnajaran'] ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label><strong>Warna :</strong></label>
                                                            <div class="row">
                                                                <?php
                                                                $cariwarna = mysqli_query($koneksi, "SELECT * FROM kelas");
                                                                while ($row = mysqli_fetch_array($cariwarna)) {
                                                                    if ($data['warna'] == $row['warna']) {
                                                                        $ceklis = "checked";
                                                                    } else {
                                                                        $ceklis = "";
                                                                    }
                                                                ?>
                                                                    <div class="form-group col-2">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="warna" id="<?= $row['warna'] ?>" type="radio" value="<?= $row['warna'] ?>" <?= $ceklis ?>>
                                                                            <div class="p-3 <?= $row['warna'] ?>" for="<?= $row['warna'] ?>"></div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="ubah-kelas" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ######################################################################## -->

                                    <!-- ###########  IKI BARIS KODE MODAL (FORM HAPUS KELAS) CUY..  ########### -->
                                    <div class="modal fade text-left" id="hapus-kelas<?= $data['idkelas'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Konfirmasi Hapus</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hiden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Kelas <strong><?= strtoupper($data['namakelas']) ?></strong>?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <a href="aksi-get.php?act=hapus-kelas&id=<?= $data['idkelas'] ?>" class="btn btn-danger">Hapus</a>
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

<!-- ###########  IKI BARIS KODE MODAL (FORM TAMBAH KELAS) CUY..  ########### -->
<div class="modal fade text-left" id="tambah-kelas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Tambah User</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hiden="true">&times;</span>
                </button>
            </div>
            <form action="aksi-post.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>Nama Kelas :</strong></label>
                        <input type="text" class="form-control" maxlength="10" name="namakelas" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Jurusan :</strong></label>
                        <input type="text" class="form-control" maxlength="23" name="jurusan" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Tahun Ajaran :</strong></label>
                        <input type="number" class="form-control" name="thnajaran" onkeypress="if(this.value.length==4)return false" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Warna :</strong></label>
                        <div class="row">
                            <?php
                            $cariwarna = mysqli_query($koneksi, "SELECT * FROM kelas");
                            while ($row = mysqli_fetch_array($cariwarna)) {
                            ?>
                                <div class="form-group col-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="warna" id="<?= $row['warna'] ?>" type="radio" value="<?= $row['warna'] ?>" required>
                                        <div class="p-3 <?= $row['warna'] ?>" for="<?= $row['warna'] ?>"></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah-kelas" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ######################################################################## -->

<?php
include('../templates/footer.php');
?>
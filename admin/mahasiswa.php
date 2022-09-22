<?php
$page = "Mahasiswa";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mahasiswa</h1>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                </div>
                <div class="form-inline col-4">
                    <label>Jurusan &nbsp;&nbsp;</label>
                    <select name="fJurusan" id="fJurusan" class="form-control">
                        <option value="" disabled selected=selected></option>
                        <?php
                        foreach ($optjurusan as $list) {
                        ?>
                            <option value="<?= $list['jurusan']; ?>"><?= strtoupper($list['jurusan']) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#tambah-mahasiswa"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body" id="table-mahasiswa">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>KELAS</th>
                            <th>ALAMAT</th>
                            <th>DOMISILI</th>
                            <th>SIM</th>
                            <th>NOMOR HP</th>
                            <th>STATUS</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($mahasiswa as $data) {
                            $nim = $data['nim'];
                            $caristatus = mysqli_query($koneksi, "SELECT * FROM vpengajuan WHERE nim='$nim' ORDER BY tanggal DESC, statuspengajuan");
                            $statusgugur = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE nim='$nim'");
                            $rows = mysqli_fetch_array($statusgugur);

                            $cek = mysqli_num_rows($caristatus);
                            if ($cek > 0) {
                                $row = mysqli_fetch_array($caristatus);

                                if ($row['perihal'] == "Kerja") {
                                    $status = '<button type="button" class="btn btn-sm btn-success">Kerja</button>';
                                } elseif ($row['perihal'] == "Magang") {
                                    $status = '<button type="button" class="btn btn-sm btn-info">Sedang Magang</button>';
                                }
                            } elseif ($rows['totalipk'] < 2.50) {
                                $status = '<button type="button" class="btn btn-sm btn-danger">Gugur</button>';
                            } else {
                                $status = '<button type="button" class="btn btn-sm btn-warning">Free</button>';
                            }
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $data['nim'] ?></td>
                                <td><?= ucwords($data['nama']) ?></td>
                                <td class="text-center"><?= strtoupper($data['namakelas']) ?></td>
                                <td><?= ucwords($data['alamat']) ?></td>
                                <td class="text-center"><?= ucwords($data['domisili']) ?></td>
                                <td class="text-center"><?= $data['sim'] ?></td>
                                <td class="text-center"><?= $data['nohp'] ?></td>
                                <td class="text-center"><?= $status ?></td>
                                <td class="text-center">
                                    <a href="detail.php?nim=<?= $data['nim'] ?>" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-address-card"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#hapus-mahasiswa<?= $data['nim'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <!-- ###########  IKI BARIS KODE MODAL (FORM HAPUS MAHASISWA) CUY..  ########### -->
                                    <div class="modal fade text-left" id="hapus-mahasiswa<?= $data['nim'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Konfirmasi Hapus</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hiden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus Mahasiswa dengan nama <strong><?= ucwords($data['nama']) ?></strong>?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <a href="aksi-get.php?act=hapus-mahasiswa&nim=<?= $data['nim'] ?>" class="btn btn-danger">Hapus</a>
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

<!-- ###########  IKI BARIS KODE MODAL (FORM TAMBAH MAHASISWA) CUY..  ########### -->
<div class="modal fade text-left" id="tambah-mahasiswa" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Form Tambah Mahasiswa</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hiden="true">&times;</span>
                </button>
            </div>
            <form action="aksi-post.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row no-gutters">
                            <div class="form-group col-md-4">
                                <img class="card-img" src="<?= $base_url ?>assets/uploads/foto/default/avatar.png">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><strong>NIM :</strong></label>
                                        <input type="number" class="form-control" onkeypress="if(this.value.length==13)return false" name="nim" required>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Nama Lengkap :</strong></label>
                                        <input type="text" class="form-control" maxlength="30" name="nama" required>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label><strong>Jenis Kelamin :</strong></label>
                                            <select class="form-control" name="jeniskelamin" required>
                                                <option value="" disabled selected=selected>Pilih</option>
                                                <option value="l">Laki-laki</option>
                                                <option value="p">Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-4">
                                            <label><strong>Tempat Lahir :</strong></label>
                                            <input type="text" class="form-control" maxlength="15" name="tmplahir" required>
                                        </div>

                                        <div class="form-group col-4">
                                            <label><strong>Tgl Lahir :</strong></label>
                                            <input type="date" class="form-control" name="tgllahir" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>E-Mail :</strong></label>
                                        <input type="email" class="form-control" maxlength="50" name="email" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <label><strong>Kelas :</strong></label>
                                <select class="form-control select2bs4" name="idkelas" style="width: 100%;" required>
                                    <option value="" disabled selected=selected></option>
                                    <?php
                                    foreach ($kelas as $list) {
                                    ?>
                                        <option value="<?= $list['idkelas']; ?>"><?= strtoupper($list['namakelas']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-9">
                                <label><strong>Alamat :</strong></label>
                                <input type="text" class="form-control" maxlength="100" name="alamat" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label><strong>Agama :</strong></label>
                                <input type="text" class="form-control" maxlength="8" name="agama">
                            </div>

                            <div class="form-group col-4">
                                <label><strong>Status Nikah :</strong></label>
                                <select class="form-control" name="statusnikah" required>
                                    <option value="" disabled selected=selected>Pilih</option>
                                    <option value="1">Belum Menikah</option>
                                    <option value="2">Menikah</option>
                                </select>
                            </div>

                            <div class="form-group col-4">
                                <label><strong>Nomor HP :</strong></label>
                                <input type="number" class="form-control" onkeypress="if(this.value.length==13)return false" name="nohp" required>
                            </div>
                        </div>

                        <div id="tampil-form">
                            <p class="btn" id="lengkapi-data" style="text-decoration: underline;">Klik untuk melengkapi Data</p>
                            <input type="hidden" value="kosong" name="lengkapi-data">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah-mahasiswa" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ######################################################################## -->

<?php
include('../templates/footer.php');
?>
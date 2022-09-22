<?php
$page = "Nilai";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Nilai</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai IPK Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th rowspan="2" style="vertical-align: middle;">NO</th>
                            <th rowspan="2" style="vertical-align: middle;">NIM</th>
                            <th rowspan="2" style="vertical-align: middle;">NAMA</th>
                            <th rowspan="2" style="vertical-align: middle;">KELAS</th>
                            <th colspan="4">IPK PER SEMESTER</th>
                            <th rowspan="2" style="vertical-align: middle;">TOTAL</th>
                            <th rowspan="2" style="vertical-align: middle;">KRITERIA</th>
                            <th rowspan="2" style="vertical-align: middle;">OPTION</th>
                        </tr>
                        <tr class="text-center" style="background-color: #5a5c69; color: #fff;">
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($nilai as $data) {
                            $totalipk = $data['totalipk'];
                            if ($totalipk >= 3.00) {
                                $kriteria = "<button type='button' class='btn btn-sm btn-success'>Wajib</button>";
                            } elseif ($totalipk >= 2.50) {
                                $kriteria = "<button type='button' class='btn btn-sm btn-info'>Dibantu</button>";
                            } else {
                                $kriteria = "<button type='button' class='btn btn-sm btn-danger'>Gugur</button>";
                            }
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $data['nim'] ?></td>
                                <td><?= ucwords($data['nama']) ?></td>
                                <td class="text-center"><?= strtoupper($data['namakelas']) ?></td>
                                <td class="text-center"><?= $data['ipk1'] ?></td>
                                <td class="text-center"><?= $data['ipk2'] ?></td>
                                <td class="text-center"><?= $data['ipk3'] ?></td>
                                <td class="text-center"><?= $data['ipk4'] ?></td>
                                <td class="text-center"><?= $totalipk ?></td>
                                <td class="text-center"><?= $kriteria ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#ubah-nilai<?= $data['nim'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- ###########  IKI BARIS KODE MODAL (FORM UBAH DATA NILAI) CUY..  ########### -->
                                    <div class="modal fade text-left" id="ubah-nilai<?= $data['nim'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Form Ubah Nilai IPK</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hiden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="aksi-post.php" method="POST">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <div class="row no-gutters">
                                                                <div class="form-group col-md-4">
                                                                    <?php
                                                                    if ($data['foto'] == "") {
                                                                        echo '<img class="card-img" src="' . $base_url . 'assets/uploads/foto/default/avatar.png">';
                                                                    } else {
                                                                        echo '<img class="card-img img-responsive img-thumbnail" src="' . $base_url . 'assets/uploads/foto/user/' . $data['foto'] . '">';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <input class="form-control" name="nim" value="<?= $data['nim'] ?>" readonly>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Nama Lengkap :</strong></label>
                                                                            <input type="text" class="form-control" value="<?= ucwords($data['nama']) ?>" readonly>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Kelas :</strong></label>
                                                                            <input type="text" class="form-control" value="<?= strtoupper($data['namakelas']) ?>" readonly>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Status Nikah :</strong></label>
                                                                            <select class="form-control" name="statusnikah">
                                                                                <?php
                                                                                if ($data['statusnikah'] == 1) {
                                                                                    echo "<option value='1'>Belum Menikah</option>";
                                                                                    echo "<option value='2'>Menikah</option>";
                                                                                } else {
                                                                                    echo "<option value='2'>Menikah</option>";
                                                                                    echo "<option value='1'>Belum Menikah</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <label><strong>Nilai IPK :</strong></label>
                                                                <div class="row">
                                                                    <div class="form-group col-3">
                                                                        <input type="number" min="0" step="0.01" class="form-control" name="ipk1" placeholder="Semester 1" value="<?= $data['ipk1'] ?>">
                                                                    </div>
                                                                    <div class="form-group col-3">
                                                                        <input type="number" min="0" step="0.01" class="form-control" name="ipk2" placeholder="Semester 2" value="<?= $data['ipk2'] ?>">
                                                                    </div>
                                                                    <div class="form-group col-3">
                                                                        <input type="number" min="0" step="0.01" class="form-control" name="ipk3" placeholder="Semester 3" value="<?= $data['ipk3'] ?>">
                                                                    </div>
                                                                    <div class="form-group col-3">
                                                                        <input type="number" min="0" step="0.01" class="form-control" name="ipk4" placeholder="Semester 4" value="<?= $data['ipk4'] ?>">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="ubah-nilai" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
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
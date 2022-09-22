<?php
$page = "User";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary">Data User Login</h6>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#tambah-user"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>E-MAIL</th>
                            <th>HAK AKSES</th>
                            <th>STATUS AKUN</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($user as $data) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= ucwords($data['nama']) ?></td>
                                <td><?= $data['email'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($data['hakakses'] == 1) {
                                        echo "Admin";
                                    } else {
                                        echo "Mahasiswa";
                                    }
                                    ?>
                                </td>
                                <td class="text-center">

                                    <div class="btn-group">
                                        <?php
                                        $id = $data['id'];
                                        if ($data['statusakun'] == 1) {
                                            $status = '<button type="button" class="btn btn-sm btn-success">AKTIF</button>';
                                            $dropdown = '<button type="button" class="btn btn-sm btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">';
                                            $link = "<a class='btn btn-sm btn-danger dropdown-item' href='aksi-get.php?id=$id&act=status-nonaktif'>NONAKTIF</a>";
                                        } else {
                                            $status = '<button type="button" class="btn btn-sm btn-danger">NONAKTIF</button>';
                                            $dropdown = '<button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">';
                                            $link = "<a class='btn btn-sm btn-success dropdown-item' href='aksi-get.php?id=$id&act=status-aktif'>AKTIF</a>";
                                        }
                                        ?>

                                        <?= $status ?>
                                        <?= $dropdown ?>
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <?= $link ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($data['hakakses'] == 1) {
                                        if ($data['id'] == $iduser) {
                                            echo '<a href="#" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#ubah-data-user' . $data['id'] . '">
                                                    <i class="fas fa-edit"></i>
                                                  </a>';
                                        } else {
                                            echo '<a href="#" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#ubah-data-user' . $data['id'] . '">
                                                    <i class="fas fa-edit"></i>
                                                  </a>
                                                  <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#hapus-user' . $data['id'] . '">
                                                      <i class="fas fa-trash"></i>
                                                  </a>';
                                        }
                                    } else {
                                        echo '<a href="#" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#ubah-data-user' . $data['id'] . '">
                                            <i class="fas fa-edit"></i>
                                        </a>';
                                    }
                                    ?>
                                    <!-- ###########  IKI BARIS KODE MODAL (FORM UBAH DATA USER) CUY..  ########### -->
                                    <div class="modal fade text-left" id="ubah-data-user<?= $data['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                            <input class="form-control" name="id" value="<?= $data['id'] ?>" readonly>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Nama Lengkap :</strong></label>
                                                                            <input type="text" class="form-control" maxlength="30" name="nama" value="<?= ucwords($data['nama']) ?>" required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>E-Mail :</strong></label>
                                                                            <input type="email" class="form-control" maxlength="50" name="email" value="<?= $data['email'] ?>" required>
                                                                            <input type="hidden" name="email-lama" value="<?= $data['email'] ?>">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label><strong>Password :</strong></label>
                                                                            <input type="password" class="form-control" maxlength="100" name="password" value="<?= $data['password'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label><strong>Akses :</strong></label>
                                                                <select class="form-control" name="hakakses" required>
                                                                    <?php
                                                                    if ($data['hakakses'] == 1) {
                                                                        echo "<option value='1'>Admin</option>";
                                                                        echo "<option value='2'>Mahasiswa</option>";
                                                                    } else {
                                                                        echo "<option value='2'>Mahasiswa</option>";
                                                                        echo "<option value='1'>Admin</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-6">
                                                                <label><strong>Status Akun :</strong></label>
                                                                <select class="form-control" name="statusakun" required>
                                                                    <?php
                                                                    if ($data['statusakun'] == 1) {
                                                                        echo "<option value='1'>AKTIF</option>";
                                                                        echo "<option value='2'>NONAKTIF</option>";
                                                                    } else {
                                                                        echo "<option value='2'>NONAKTIF</option>";
                                                                        echo "<option value='1'>AKTIF</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="foto">
                                                                <label class="custom-file-label">Ubah Foto...</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="ubah-data-user" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ######################################################################## -->

                                    <!-- ###########  IKI BARIS KODE MODAL (FORM HAPUS USER) CUY..  ########### -->
                                    <div class="modal fade text-left" id="hapus-user<?= $data['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Konfirmasi Hapus</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hiden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus User dengan nama <strong><?= $data['nama'] ?></strong>?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <a href="aksi-get.php?act=hapus-user&id=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
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

<!-- ###########  IKI BARIS KODE MODAL (FORM TAMBAH USER) CUY..  ########### -->
<div class="modal fade text-left" id="tambah-user" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Tambah User</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hiden="true">&times;</span>
                </button>
            </div>
            <form action="aksi-post.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>ID :</strong></label>
                        <input type="number" class="form-control" onkeypress="if(this.value.length==13)return false" name="id" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Nama Lengkap :</strong></label>
                        <input type="text" class="form-control" maxlength="30" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label><strong>E-Mail :</strong></label>
                        <input type="email" class="form-control" maxlength="30" name="email" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Password :</strong></label>
                        <input type="password" class="form-control" maxlength="100" name="password" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label><strong>Akses :</strong></label>
                            <select class="form-control" name="hakakses" required>
                                <option value="" disabled selected=selected></option>
                                <option value="1">Admin</option>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label><strong>Status Akun :</strong></label>
                            <select class="form-control" name="statusakun" required>
                                <option value="" disabled selected=selected></option>
                                <option value="1">AKTIF</option>
                                <option value="2">NONAKTIF</option>
                            </select>
                        </div>
                    </div>

                    <div align="center">
                        <div class="form-group">
                            <label><strong>Foto :</strong></label>
                            <div class="col-sm-6">
                                <img class="img-responsive img-thumbnail" src="<?= $base_url ?>assets/uploads/foto/default/avatar.png" style="max-width: 33%;">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto">
                                <label class="custom-file-label">Pilih Foto...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah-user" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ######################################################################## -->

<?php
include('../templates/footer.php');
?>
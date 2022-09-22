<?php
$page = "Akun";
include('../templates/sidebar-mahasiswa.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Info Akun</h6>
        </div>
        <div class="card-body">
            <?php
            // $user = mysqli_fetch_array($user);
            ?>
            <!-- Page Heading -->
            <form action="aksi-post.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row no-gutters">
                            <div class="form-group col-md-4">
                                <?php
                                if ($user['foto'] == "") {
                                    echo '<img class="card-img" src="' . $base_url . 'assets/uploads/foto/default/avatar.png">';
                                } else {
                                    echo '<img class="card-img img-responsive img-thumbnail" src="' . $base_url . 'assets/uploads/foto/user/' . $user['foto'] . '">';
                                }
                                ?>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input class="form-control" name="id" value="<?= $user['id'] ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Nama Lengkap :</strong></label>
                                        <input type="text" class="form-control" maxlength="30" name="nama" value="<?= ucwords($user['nama']) ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>E-Mail :</strong></label>
                                        <input type="email" class="form-control" maxlength="50" name="email" value="<?= $user['email'] ?>" required>
                                        <input type="hidden" name="email-lama" value="<?= $user['email'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Password :</strong></label>
                                        <input type="password" class="form-control" maxlength="100" name="password" value="<?= $user['password'] ?>">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label><strong>Akses :</strong></label>
                                            <select class="form-control" name="hakakses" required>
                                                <?php
                                                if ($user['hakakses'] == 1) {
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
                                                if ($user['statusakun'] == 1) {
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="ubah-akun" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php
include('../templates/footer.php');
?>
<?php
$page = "Profil";
include('../templates/sidebar-mahasiswa.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Info Profil</h6>
        </div>
        <div class="card-body">
            <?php
            $data = mysqli_fetch_array($mahasiswa);

            // CARI STATUS
            $caristatus = mysqli_query($koneksi, "SELECT * FROM vpengajuan WHERE nim='$nim' ORDER BY tanggal DESC");
            $statusgugur = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE nim='$nim'");
            $rows = mysqli_fetch_array($statusgugur);
            $totalipk = $rows['totalipk'];

            $cekstatus = mysqli_num_rows($caristatus);

            if ($cekstatus > 0) {
                $row = mysqli_fetch_array($caristatus);

                if ($row['perihal'] == "Kerja") {
                    $status = 'Kerja';
                } elseif ($row['perihal'] == "Magang") {
                    $status = 'Sedang Magang';
                }
            } elseif ($totalipk < 2.50) {
                $status = 'Gugur';
            } else {
                $status = 'Free';
            }

            ?>
            <!-- Page Heading -->
            <form action="aksi-post.php" method="POST">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row no-gutters">
                            <div class="form-group col-md-4">
                                <?php
                                $foto = $data['foto'];
                                if ($foto == "") {
                                    echo '<img class="card-img img-responsive img-thumbnail" src="' . $base_url . 'assets/uploads/foto/default/avatar.png">';
                                } else {
                                    echo '<img class="card-img img-responsive img-thumbnail" src="' . $base_url . 'assets/uploads/foto/user/' . $foto . '">';
                                }
                                ?>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <input name="nim" class="form-control" value="<?= $data['nim'] ?>" readonly>
                                        </div>
                                        <div class="form-group col-4">
                                            <input type="text" class="form-control" value="<?= $status ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Nama Lengkap :</strong></label>
                                        <input type="text" class="form-control" name="nama" maxlength="30" value="<?= ucwords($data['nama']) ?>" required>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label><strong>Jenis Kelamin :</strong></label>
                                            <select class="form-control" name="jeniskelamin" required>
                                                <?php
                                                if ($data['jeniskelamin'] == "l") {
                                                    echo "<option value='l'>Laki-laki</option>";
                                                    echo "<option value='p'>Perempuan</option>";
                                                } else {
                                                    echo "<option value='p'>Perempuan</option>";
                                                    echo "<option value='l'>Laki-laki</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-4">
                                            <label><strong>Tempat Lahir :</strong></label>
                                            <input type="text" name="tmplahir" class="form-control" maxlength="30" value="<?= ucwords($data['tmplahir']) ?>" required>
                                        </div>

                                        <div class="form-group col-4">
                                            <label><strong>Tanggal Lahir :</strong></label>
                                            <input type="date" name="tgllahir" class="form-control" value="<?= $data['tgllahir'] ?>" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-5">
                                            <label><strong>Agama :</strong></label>
                                            <input type="text" name="agama" class="form-control" maxlength="8" value="<?= ucwords($data['agama']) ?>" required>
                                        </div>

                                        <div class="form-group col-7">
                                            <label><strong>Status Nikah :</strong></label>
                                            <select class="form-control" name="statusnikah" required>
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

                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label><strong>Kelas :</strong></label>
                                            <input class="form-control" value="<?= strtoupper($data['namakelas']) ?>" readonly>
                                        </div>

                                        <div class="form-group col-8" id="jurusan">
                                            <label><strong>Jurusan :</strong></label>
                                            <input class="form-control" value="<?= ucwords($data['jurusan']) ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Alamat :</strong></label>
                                        <textarea type="text" name="alamat" class="form-control" maxlength="100" rows="2" required><?= ucwords($data['alamat']) ?></textarea>
                                    </div>
                                </div> <!-- Card Body -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label><strong>Domisili :</strong></label>
                                <input type="text" name="domisili" class="form-control" maxlength="20" value="<?= ucwords($data['domisili']) ?>">
                            </div>

                            <div class="form-group col-5">
                                <label><strong>Kendaraan :</strong></label>
                                <select class="form-control" name="kendaraan">
                                    <?php
                                    if ($data['kendaraan'] == 1) {
                                        echo '<option value="1">Motor</option>';
                                        echo '<option value="2">Mobil</option>';
                                        echo '<option value="3">Umum</option>';
                                    } elseif ($data['kendaraan'] == 2) {
                                        echo '<option value="2">Mobil</option>';
                                        echo '<option value="1">Motor</option>';
                                        echo '<option value="3">Umum</option>';
                                    } else {
                                        echo '<option value="3">Umum</option>';
                                        echo '<option value="1">Motor</option>';
                                        echo '<option value="2">Mobil</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label><strong>SIM :</strong></label>
                                <input type="text" name="sim" class="form-control" maxlength="7" value="<?= strtoupper($data['sim']) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label><strong>Posisi Yang Diinginkan :</strong></label>
                            <input type="text" name="posisi" class="form-control" maxlength="20" value="<?= $data['posisi'] ?>">
                        </div>

                        <div class="form-group col-4">
                            <label><strong>Nomor HP :</strong></label>
                            <input type="number" name="nohp" class="form-control" onkeypress="if(this.value.length==15)return false" value="<?= $data['nohp'] ?>" required>
                        </div>

                        <div class="form-group col-4">
                            <label><strong>Bahasa Asing :</strong></label>
                            <input type="text" name="bahasa" class="form-control" maxlength="30" value="<?= ucwords($data['bahasa']) ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label><strong>SMA :</strong></label>
                            <input type="text" name="sma" class="form-control" maxlength="40" value="<?= $data['sma'] ?>">
                        </div>

                        <div class="form-group col-8">
                            <label><strong>Jurusan SMA :</strong></label>
                            <input type="text" name="jurusansma" class="form-control" maxlength="25" value="<?= ucwords($data['jurusansma']) ?>">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label><strong style="text-decoration: underline;">Riwayat Magang :</strong></label>
                        <div class="table-responsive-lg">
                            <table class="table table-bordered" id="riwayatMagang" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Perusahaan</th>
                                        <th>Posisi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($riwayatmagang)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $row['tanggal'] ?></td>
                                            <td><?= strtoupper($row['namapt']) ?></td>
                                            <td class="text-center"><?= ucwords($row['posisi_sbg']) ?></td>
                                            <td class="text-center"><?= ucfirst($row['perihal']) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-right" style="margin-right: 20px;">
                    <a href="profil.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="ubah-profil" class="btn btn-primary">Simpan</button>
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
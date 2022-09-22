<?php
$page = "Pengajuan";
if (!isset($_GET['id'])) {
    header("location:dashboard.php");
}

include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan</h6>
        </div>
        <div class="card-body">
            <?php
            $nopengajuan = $_GET['id'];
            $caridata = mysqli_query($koneksi, "SELECT * FROM detail_pengajuan WHERE nopengajuan='$nopengajuan'");
            $hint = mysqli_fetch_array($caridata);
            if (!$hint) {
                $posisi = "";
                $tglmulai = "";
                $tglselesai = "";
                $disable = "";
            } else {
                $posisi = $hint['posisi_sbg'];
                $tglmulai = $hint['tglmulai'];
                $tglselesai = $hint['tglselesai'];
                $disable = "readonly";
            }


            $result = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN perusahaan pt WHERE nopengajuan='$nopengajuan' AND p.idperusahaan=pt.idperusahaan");
            $data = mysqli_fetch_array($result);
            ?>

            <form action="aksi-post.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <input name="nopengajuan" id="nopengajuan" class="form-control" value="<?= $nopengajuan ?>" readonly>
                        </div>

                        <div class="form-group col-6">
                            <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label><strong>Perihal :</strong></label>
                            <select class="form-control" name="perihal" required>
                                <?php
                                if ($data['perihal'] == "Magang") {
                                    echo '<option value="Magang">Magang</option>';
                                    echo '<option value="Kerja">Kerja</option>';
                                } else {
                                    echo '<option value="Kerja">Kerja</option>';
                                    echo '<option value="Magang">Magang</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-8">
                            <label><strong>Nama Perusahaan :</strong></label>
                            <select class="form-control select2bs4" name="idperusahaan" style="width: 100%;" required>
                                <option value="<?= $data['idperusahaan'] ?>"><?= strtoupper($data['namapt']) ?></option>
                                <?php
                                $idpt = $data['idperusahaan'];
                                $caript = mysqli_query($koneksi, "SELECT idperusahaan, namapt FROM perusahaan WHERE idperusahaan != '$idpt'");
                                foreach ($caript as $list) {
                                ?>
                                    <option value="<?= $list['idperusahaan']; ?>"><?= strtoupper($list['namapt']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label><strong>Posisi Sebagai :</strong></label>
                            <input type="text" name="posisi_sbg" maxlength="15" value="<?= $posisi ?>" class="form-control" required>
                        </div>

                        <div class="form-group col-3">
                            <label><strong>Tgl Mulai :</strong></label>
                            <input type="date" name="tglmulai" class="form-control" value="<?= $tglmulai ?>" required <?= $disable ?>>
                        </div>

                        <div class="form-group col-3">
                            <label><strong>Tgl Selesai :</strong></label>
                            <input type="date" name="tglselesai" class="form-control" value="<?= $tglselesai ?>" required <?= $disable ?>>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <?php
                            $caridata = mysqli_query($koneksi, "SELECT * FROM detail_pengajuan WHERE nopengajuan='$nopengajuan'");
                            $cek = mysqli_num_rows($caridata);
                            if ($cek < 0) {
                                $required = "required";
                            } else {
                                $required = "";
                            }
                            ?>
                            <label><strong>Nama Mahasiswa :</strong></label>
                            <select class="form-control select2bs4" name="nim" style="width: 100%;" <?= $required ?>>
                                <option value="" disabled selected=selected></option>
                                <?php
                                $carimahasiswa =  mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN user u JOIN kelas k WHERE m.nim=u.id
                                                                          AND m.idkelas=k.idkelas AND thnajaran='$tahun' GROUP BY m.nim");
                                foreach ($carimahasiswa as $list) {
                                    $nim = $list['nim'];
                                    $caristatus = mysqli_query($koneksi, "SELECT * FROM vpengajuan WHERE nim='$nim' ORDER BY tanggal DESC ");
                                    $statusgugur = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE nim='$nim'");
                                    $rows = mysqli_fetch_array($statusgugur);

                                    $cek2 = mysqli_num_rows($caristatus);
                                    if ($cek2 > 0) {
                                        $row = mysqli_fetch_array($caristatus);

                                        if ($row['perihal'] == "Kerja" && $row['statuspengajuan'] == 1) {
                                            echo '<option value="' . $list['nim'] . '" disabled>' . ucwords($list['nama']) . ' (Sudah Kerja)' . '</option>';
                                        } elseif ($row['perihal'] == "Kerja" && $row['statuspengajuan'] == 4) {
                                            echo '<option value="' . $list['nim'] . '">' . ucwords($list['nama']) . '</option>';
                                        } elseif ($row['perihal'] == "Magang" && $row['statuspengajuan'] == 1) {
                                            echo '<option value="' . $list['nim'] . '" disabled>' . ucwords($list['nama']) . ' (Sedang Magang)' . '</option>';
                                        } elseif ($row['perihal'] == "Magang" && $row['statuspengajuan'] == 4) {
                                            echo '<option value="' . $list['nim'] . '">' . ucwords($list['nama']) . '</option>';
                                        }
                                    } elseif ($rows['totalipk'] < 2.50) {
                                        echo '<option value="' . $list['nim'] . '" disabled>' . ucwords($list['nama']) . ' (Gugur)' . '</option>';
                                    } else {
                                        echo '<option value="' . $list['nim'] . '">' . ucwords($list['nama']) . '</option>';
                                    }
                                ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-inline">
                            <button type="submit" class="btn btn-info" name="add-detailPengajuan" style="margin-top: 15px;">Tambah</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><strong style="text-decoration: underline;">Keterangan :</strong></label>
                        <div class="table-responsive-lg">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>NAMA MAHASISWA</th>
                                        <th>JURUSAN</th>
                                        <th>TGL MULAI</th>
                                        <th>TGL SELESAI</th>
                                        <th>POSISI</th>
                                        <th>OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $carinim = mysqli_query($koneksi, "SELECT * FROM detail_pengajuan dp JOIN user u JOIN mahasiswa m JOIN kelas k WHERE
                                                                       nopengajuan='$nopengajuan' AND dp.nim=m.nim AND u.id=m.nim AND m.idkelas=k.idkelas");

                                    while ($row = mysqli_fetch_array($carinim)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $row['nim'] ?></td>
                                            <td><?= ucwords($row['nama']) ?></td>
                                            <td class=""><?= ucwords($row['jurusan']) ?></td>
                                            <td class="text-center"><?= $row['tglmulai'] ?></td>
                                            <td class="text-center"><?= $row['tglselesai'] ?></td>
                                            <td class="text-center"><?= $row['posisi_sbg'] ?></td>
                                            <td class="text-center">
                                                <a href="aksi-get.php?act=hapus-detailpengajuan&nim=<?= $row['nim'] ?>&id=<?= $data['nopengajuan'] ?>" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                    $cekdetail_pengajuan = mysqli_num_rows($caridata);
                    if ($cekdetail_pengajuan > 0) {
                        echo '<a href="pengajuan.php" class="btn btn-secondary">Tutup</a>';
                    } else {
                        echo '<a href="aksi-get.php?act=batalkan-pengajuan&id=' . $nopengajuan . '" class="btn btn-warning">Batal</a>';
                    }
                    ?>
                    <button type="submit" name="ubah-pengajuan" class="btn btn-primary">Simpan</button>
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
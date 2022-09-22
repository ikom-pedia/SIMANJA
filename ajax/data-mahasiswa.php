<?php
session_start();
include '../koneksi.php';

$iduser = $_SESSION['id'];
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE id='$iduser'"));
$tahun = $user['setting'];

$fJurusan = $_POST['jurusan'];
?>
<div class="table-responsive-lg">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>NO</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>JURUSAN</th>
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
            $mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN user u JOIN kelas k WHERE m.nim=u.id AND m.idkelas=k.idkelas
                                                 AND jurusan='$fJurusan' AND thnajaran='$tahun'");
            foreach ($mahasiswa as $data) {
                $nim = $data['nim'];
                $caristatus = mysqli_query($koneksi, "SELECT * FROM vpengajuan WHERE nim='$nim'");
                $statusgugur = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE nim='$nim'");
                $rows = mysqli_fetch_array($statusgugur);

                $cek = mysqli_num_rows($caristatus);
                if ($cek > 0) {
                    $row = mysqli_fetch_array($caristatus);

                    if ($row['perihal'] == "Kerja") {
                        $status = '<button type="button" class="btn btn-sm btn-success">Kerja</button>';
                    } elseif ($row['perihal'] = "Magang") {
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
                    <td class="text-center"><?= ucwords($data['jurusan']) ?></td>
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
                                        <p>Apakah anda yakin ingin menghapus Mahasiswa dengan nama <strong><?= $data['nama'] ?></strong>?</p>
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

<script>
    // DataTable
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
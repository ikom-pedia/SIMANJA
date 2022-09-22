<?php
$page = "Free";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mahasiswa Status Free</h1>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>JURUSAN</th>
                            <th>POSISI YANG DIINGINKAN</th>
                            <th>DOMISILI</th>
                            <th>NOMOR HP</th>
                            <th>SIM</th>
                            <th>OPTION</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        $carimahasiswa =  mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN user u JOIN kelas k WHERE m.nim=u.id
                                                                          AND m.idkelas=k.idkelas AND thnajaran='$tahun' GROUP BY m.nim");
                        foreach ($carimahasiswa as $data) {
                            $nim = $data['nim'];
                            $caristatus = mysqli_query($koneksi, "SELECT * FROM vpengajuan WHERE nim='$nim' ORDER BY tanggal DESC ");
                            $statusgugur = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE nim='$nim'");
                            $rows = mysqli_fetch_array($statusgugur);

                            $cek2 = mysqli_num_rows($caristatus);
                            if ($cek2 > 0) {
                                $row = mysqli_fetch_array($caristatus);

                                if ($row['perihal'] == "Kerja" && $row['statuspengajuan'] == 1) {
                                    echo '<tr>
                                    
                                </tr>';
                                } elseif ($row['perihal'] == "Kerja" && $row['statuspengajuan'] == 4) {
                                    echo '<tr>
                                    <td class="text-center">' . $no++ . '</td>
                                    <td class="text-center">' . $data['nim'] . '</td>
                                    <td>' . ucwords($data['nama']) . '</td>
                                    <td class="">' . ucwords($data['jurusan']) . '</td>
                                    <td>' . $data['posisi'] . '</td>
                                    <td class="text-center">' . ucwords($data['domisili']) . '</td>
                                    <td class="text-center">' . $data['nohp'] . '</td>
                                    <td class="text-center">' . $data['sim'] . '</td>
                                    <td class="text-center">
                                        <a href="detail.php?nim=' . $data['nim'] . '" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-address-card"></i>
                                        </a>
                                    </td>
                                </tr>';
                                } elseif ($row['perihal'] == "Magang" && $row['statuspengajuan'] == 1) {
                                    echo '<tr></tr>';
                                } elseif ($row['perihal'] == "Magang" && $row['statuspengajuan'] == 4) {
                                    echo '<tr>
                                    <td class="text-center">' . $no++ . '</td>
                                    <td class="text-center">' . $data['nim'] . '</td>
                                    <td>' . ucwords($data['nama']) . '</td>
                                    <td class="">' . ucwords($data['jurusan']) . '</td>
                                    <td>' . $data['posisi'] . '</td>
                                    <td class="text-center">' . ucwords($data['domisili']) . '</td>
                                    <td class="text-center">' . $data['nohp'] . '</td>
                                    <td class="text-center">' . $data['sim'] . '</td>
                                    <td class="text-center">
                                        <a href="detail.php?nim=' . $data['nim'] . '" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-address-card"></i>
                                        </a>
                                    </td>
                                </tr>';
                                }
                            } elseif ($rows['totalipk'] < 2.50) {
                                echo '<tr></tr>';
                            } else {
                                echo '<tr>
                                <td class="text-center">' . $no++ . '</td>
                                <td class="text-center">' . $data['nim'] . '</td>
                                <td>' . ucwords($data['nama']) . '</td>
                                <td class="">' . ucwords($data['jurusan']) . '</td>
                                <td>' . $data['posisi'] . '</td>
                                <td class="text-center">' . ucwords($data['domisili']) . '</td>
                                <td class="text-center">' . $data['nohp'] . '</td>
                                <td class="text-center">' . $data['sim'] . '</td>
                                <td class="text-center">
                                    <a href="detail.php?nim=' . $data['nim'] . '" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-address-card"></i>
                                    </a>
                                </td>
                            </tr>';
                            }
                        ?>

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
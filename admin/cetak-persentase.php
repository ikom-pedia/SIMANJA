<?php
session_start();
include('../koneksi.php');

$iduser = $_SESSION['id'];
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE id='$iduser'"));
$tahun = $user['setting'];

require_once __DIR__ . '/../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'orientation' => 'P'
]);

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PERSENTASE MAGANG</title>

    <style>
        .font {
            font-family: "Arial, sHelvetica, sans-serif";
        }

        body,
        tr,
        td {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .table-border tr td {
            border: 1px solid black;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
        }

        thead tr td {
            /* font-weight: bold; */
            padding-top: 8px;
            padding-bottom: 8px;
            padding-left: 8px;
            padding-right: 8px;
        }
    </style>
</head>

<body class="font">
    <h3 align="center">DATA PERSENTASE MAGANG LP3I BANTEN</h3>
    <h3 align="center">T.A <?= $tahun ?></h3>
    <br>
    <?php
    $looping = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
            AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' GROUP BY month(tglmulai)");
    foreach ($looping as $data) {
        $bulan = substr($data['tglmulai'], 5, 2);

        if ($bulan == "01") {
            $namabulan = "Januari";
        } elseif ($bulan == "02") {
            $namabulan = "Februari";
        } elseif ($bulan == "03") {
            $namabulan = "Maret";
        } elseif ($bulan == "04") {
            $namabulan = "April";
        } elseif ($bulan == "05") {
            $namabulan = "Mei";
        } elseif ($bulan == "06") {
            $namabulan = "Juni";
        } elseif ($bulan == "07") {
            $namabulan = "Juli";
        } elseif ($bulan == "08") {
            $namabulan = "Agustus";
        } elseif ($bulan == "09") {
            $namabulan = "September";
        } elseif ($bulan == "10") {
            $namabulan = "Oktober";
        } elseif ($bulan == "11") {
            $namabulan = "November";
        } else {
            $namabulan = "Desember";
        }


        $caribulan_min = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(tglmulai) AS bulanMin FROM detail_pengajuan"));
        $bulanawal = $caribulan_min['bulanMin'];
        $bulanakhir = substr($data['tglmulai'], 0, 8) . '31';
    ?>
        <p><b><?= strtoupper($namabulan) ?></b></p>
        <table class="table-border">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>KELAS</td>
                    <td>JUMLAH</td>
                    <td>MAGANG</td>
                    <td>PERSENTASE</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $carikelas = mysqli_query($koneksi, "SELECT * FROM kelas k JOIN mahasiswa m JOIN detail_pengajuan dp WHERE k.idkelas=m.idkelas AND thnajaran='$tahun' AND month(tglmulai)='$bulan' GROUP BY k.idkelas");

                foreach ($carikelas as $row) {
                    $idkelas = $row['idkelas'];
                    $jumlahsiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k WHERE m.idkelas=k.idkelas AND k.idkelas='$idkelas'");
                    $jumlahmagang = mysqli_query($koneksi, "SELECT * FROM vpersentase WHERE tglmulai BETWEEN '$bulanawal' AND '$bulanakhir' AND idkelas='$idkelas'");
                    $persentase = (mysqli_num_rows($jumlahmagang) / mysqli_num_rows($jumlahsiswa) * 100);

                    echo '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . strtoupper($row['namakelas']) . '</td>
                    <td>' . mysqli_num_rows($jumlahsiswa) . '</td>
                    <td>' . mysqli_num_rows($jumlahmagang) . '</td>
                    <td>' . round($persentase) . '</td>
                </tr>';
                }

                $totalsiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k WHERE m.idkelas=k.idkelas AND thnajaran='$tahun'");
                $totalmagang = mysqli_query($koneksi, "SELECT * FROM vpersentase WHERE tglmulai BETWEEN '$bulanawal' AND '$bulanakhir'");

                $cektotalmagang = mysqli_num_rows($totalmagang);
                if ($cektotalmagang > 0) {
                    $totalpersentase = (mysqli_num_rows($totalmagang) / mysqli_num_rows($totalsiswa) * 100);
                } else {
                    $totalpersentase = 0;
                }

                echo '<tr>
                    <td colspan="2"><strong>TOTAL</strong></td>
                    <td><strong>' . mysqli_num_rows($totalsiswa) . '</strong></td>
                    <td><strong>' . mysqli_num_rows($totalmagang) . '</strong></td>
                    <td><strong>' . round($totalpersentase) . '%' . '</strong></td>
                </tr>';

                ?>
            </tbody>
        </table>
    <?php } ?>
</body>

</html>

<?php
$mpdf->setFooter('{PAGENO}');
$namafile = 'Persentase_update_' . date('d-m-Y');
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($namafile . ".pdf", 'I');
exit;
?>
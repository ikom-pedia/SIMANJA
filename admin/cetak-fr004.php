<?php
include('../koneksi.php');

$nim = $_GET['nim'];
$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN user u JOIN kelas k JOIN vnilai n WHERE m.nim=u.id AND m.nim=n.nim AND m.idkelas=k.idkelas AND m.nim='$nim'");
$data = mysqli_fetch_array($result);

$totalipk = $data['totalipk'];
if ($totalipk >= 3.00) {
    $kriteria = "Wajib Magang/<strike>Dibantu Magang</strike>/<strike>Gugur</strike>";
} elseif ($totalipk >= 2.50) {
    $kriteria = "<strike>Wajib Magang</strike>/Dibantu Magang/<strike>Gugur</strike>";
} else {
    $kriteria = "<strike>Wajib Magang</strike>/<strike>Dibantu Magang</strike>/Gugur";
}

if ($data['kendaraan'] == 1) {
    $kendaraan = "Motor";
} elseif ($data['kendaraan'] == 2) {
    $kendaraan = "Mobil";
} else {
    $kendaraan = "Umum";
}

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
    <title>FORM FR004</title>

    <style>
        .font {
            font-family: "Arial, sHelvetica, sans-serif";
        }

        body,
        td,
        th {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-border tr td {
            border: 1px solid black;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
        }

        thead tr td {
            text-align: center;
            /* font-weight: bold; */
            padding-top: 8px;
            padding-bottom: 8px;
            padding-left: 8px;
            padding-right: 8px;
        }
    </style>
</head>

<body class="font">
    <h3 align="center">DATA PROSES PENEMPATAN MAGANG/KERJA</h3>
    <h3 align="center">Form FR-C&P-004</h3>
    <br>

    <table>
        <tr>
            <td width="25%">Nama Mahasiswa</td>
            <td width="35%">: <?= $data['nama'] ?></td>
            <td width="19%" rowspan="5">
                <?php
                if ($data['foto'] == "") {
                    echo '<img src="../assets/uploads/foto/default/foto-3x4.jpg" alt="Foto 3x4" width="130" height="175">';
                } else {
                    echo '<img src="../assets/uploads/foto/user/' . $data['foto'] . '" alt="Foto 3x4" width="130" height="175">';
                }
                ?>
            </td>
            <td width="21%">Karakter/Masalah :</td>
        </tr>
        <tr>
            <td valign="top">Alamat Asal</td>
            <td>: <?= $data['alamat'] ?></td>
            <td width="20%" rowspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>Domisili</td>
            <td>: <?= $data['domisili'] ?></td>
        </tr>
        <tr>
            <td>Telp Rumah</td>
            <td>: -</td>
        </tr>
        <tr>
            <td>Handphone</td>
            <td>: <?= $data['nohp'] ?></td>
        </tr>
        <tr>
            <td>SMA/Jurusan</td>
            <td colspan="3">: <?= $data['sma'] ?> / <?= $data['jurusansma'] ?></td>
        </tr>
        <tr>
            <td>Program</td>
            <td colspan="3">: <?= ucwords($data['jurusan']) ?></td>
        </tr>
        <tr>
            <td>IPK</td>
            <td colspan="3">: <?= $totalipk ?></td>
        </tr>
        <tr>
            <td>Kendaraan</td>
            <td colspan="3">: <?= $kendaraan ?></td>
        </tr>
        <tr>
            <td>Status Agama</td>
            <td colspan="3">: <?= $data['agama'] ?></td>
        </tr>
        <tr>
            <td>Bhs. Asing</td>
            <td colspan="3">: <?= $data['bahasa'] ?></td>
        </tr>
        <tr>
            <td>SIM</td>
            <td colspan="3">: <?= $data['sim'] ?></td>
        </tr>
        <tr>
            <td>Posisi Yang Diinginkan</td>
            <td colspan="3">: <?= $data['posisi'] ?></td>
        </tr>
        <tr>
            <td>Status Penempatan</td>
            <td colspan="3">: <?= $kriteria ?></td>
        </tr>
    </table>

    <p style="text-decoration: underline;">Keterangan :</p>
    <table>
        <tr>
            <td>
                <table class="table-border">
                    <thead>
                        <tr>
                            <td width="50%">Magang</td>
                            <td>Kerja</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nim = $data['nim'];
                        $keterangan = mysqli_query($koneksi, "SELECT CASE WHEN
                        `perihal` = 'Kerja' THEN `namapt`
                        END AS `kerja`,
                        CASE WHEN `perihal` = 'Magang' THEN `namapt`
                        END AS `magang`
                        FROM
                        detail_pengajuan dp
                        JOIN pengajuan p JOIN perusahaan pt WHERE
                        p.nopengajuan = dp.nopengajuan AND p.idperusahaan = pt.idperusahaan AND nim = '$nim' AND (statuspengajuan=1 OR statuspengajuan=4)
                        ORDER BY
                        p.nopengajuan
                        ASC");

                        $arrkerja = new ArrayObject();
                        $arrmagang = new ArrayObject();
                        foreach ($keterangan as $column) {
                            if ($column['magang'] !== null) {
                                $arrmagang->append($column['magang']);
                            }
                            if ($column['kerja'] !== null) {
                                $arrkerja->append($column['kerja']);
                            }
                        }
                        for ($i = 0; $i < 6; $i++) {
                            echo '<tr>';
                            if (isset($arrmagang[$i])) {
                                echo '<td>' . $arrmagang[$i] . '</td>';
                            } else {
                                echo '<td>&nbsp;</td>';
                            }
                            if (isset($arrkerja[$i])) {
                                echo '<td>' . $arrkerja[$i] . '</td>';
                            } else {
                                echo '<td>&nbsp;</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="table-border">
        <thead>
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Perusahaan</td>
                <td>Posisi</td>
                <td>Paraf</td>
                <td>Keterangan</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $nim = $data['nim'];
            $detail = mysqli_query($koneksi, "SELECT * FROM detail_pengajuan dp JOIN pengajuan p JOIN perusahaan pt WHERE p.nopengajuan=dp.nopengajuan
            AND p.idperusahaan=pt.idperusahaan AND nim='$nim' AND (statuspengajuan=1 OR statuspengajuan=4) ORDER BY p.nopengajuan ASC");
            $totaldata = mysqli_num_rows($detail);

            foreach ($detail as $row) {
                echo '<tr>
                <td align="center">' . $no++ . '</td>
                <td align="center">' . $row['tanggal'] . '</td>
                <td>' . $row['namapt'] . '</td>
                <td align="center">' . $row['posisi_sbg'] . '</td>
                <td>&nbsp;</td>
                <td align="center">' . $row['perihal'] . '</td>
            </tr>';
            }

            if ($totaldata == 0) {
                $baris = 6;
            } elseif ($totaldata == 1) {
                $baris = 5;
            } elseif ($totaldata == 2) {
                $baris = 4;
            } elseif ($totaldata == 3) {
                $baris = 3;
            } elseif ($totaldata == 4) {
                $baris = 2;
            } elseif ($totaldata == 5) {
                $baris = 1;
            } else {
                $baris = 0;
            }

            $awal = 0;
            while ($awal < $baris) {
                echo '<tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>';
                $awal++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
$namafile = 'FR004-' . $data['nama'];
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($namafile . ".pdf", 'I');
exit;
?>
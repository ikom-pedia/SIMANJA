<?php
$nim = $_SESSION['id'];
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE id='$nim'"));
$nama = $user['nama'];
$foto = $user['foto'];

$mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN user u JOIN kelas k WHERE m.nim=u.id AND m.idkelas=k.idkelas AND nim='$nim'");

$riwayatmagang = mysqli_query($koneksi, "SELECT * FROM detail_pengajuan dp JOIN pengajuan p JOIN perusahaan pt WHERE p.nopengajuan=dp.nopengajuan
                              AND p.idperusahaan=pt.idperusahaan AND nim='$nim' AND (statuspengajuan=1 OR statuspengajuan=4) ORDER BY p.nopengajuan DESC");

// $pengajuan = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN user u JOIN perusahaan pt
//                         WHERE dp.nim=u.id AND p.nopengajuan=dp.nopengajuan AND dp.nim='$nim' AND p.idperusahaan=pt.idperusahaan AND (statuspengajuan=2 OR statuspengajuan=3)");

$pengajuan = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN user u JOIN perusahaan pt
                        WHERE dp.nim=u.id AND p.nopengajuan=dp.nopengajuan AND dp.nim='$nim' AND p.idperusahaan=pt.idperusahaan AND (statuspengajuan=2 OR statuspengajuan=3)");

$optperusahaan = mysqli_query($koneksi, "SELECT idperusahaan, namapt FROM perusahaan");
$optjurusan = mysqli_query($koneksi, "SELECT * FROM kelas GROUP BY jurusan");

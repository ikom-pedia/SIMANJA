<?php
$iduser = $_SESSION['id'];
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE id='$iduser'"));
$nama = $user['nama'];
$tahun = $user['setting'];
$foto = $user['foto'];

$user = mysqli_query($koneksi, "SELECT * FROM user");
$mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN user u JOIN kelas k WHERE m.nim=u.id AND m.idkelas=k.idkelas AND thnajaran='$tahun' ORDER BY nama");
$nilai = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE thnajaran='$tahun'");

$kelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE thnajaran='$tahun'");
$relasi = mysqli_query($koneksi, "SELECT * FROM perusahaan");

$pengajuan = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN perusahaan pt WHERE p.idperusahaan=pt.idperusahaan ORDER BY nopengajuan DESC");

$optjurusan = mysqli_query($koneksi, "SELECT * FROM kelas GROUP BY jurusan");
$optkelas = mysqli_query($koneksi, "SELECT namakelas FROM kelas");
$optperusahaan = mysqli_query($koneksi, "SELECT idperusahaan, namapt FROM perusahaan");

// STATUS
$mahasiswakerja = mysqli_query($koneksi, "SELECT * FROM user u JOIN mahasiswa m JOIN kelas k JOIN pengajuan p JOIN detail_pengajuan dp JOIN perusahaan pt
                                          WHERE u.id=m.nim AND m.idkelas=k.idkelas AND p.nopengajuan=dp.nopengajuan AND dp.nim=m.nim AND p.idperusahaan=pt.idperusahaan
                                          AND perihal='Kerja' AND statuspengajuan=1 AND thnajaran='$tahun'");
$mahasiswamagang = mysqli_query($koneksi, "SELECT * FROM user u JOIN mahasiswa m JOIN kelas k JOIN pengajuan p JOIN detail_pengajuan dp JOIN perusahaan pt
                                          WHERE u.id=m.nim AND m.idkelas=k.idkelas AND p.nopengajuan=dp.nopengajuan AND dp.nim=m.nim AND p.idperusahaan=pt.idperusahaan
                                          AND perihal='Magang' AND statuspengajuan=1 AND thnajaran='$tahun'");
$mahasiswagugur = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE totalipk < 2.50 AND thnajaran='$tahun'");

// DASHBOARD
$sum_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k WHERE m.idkelas=k.idkelas AND thnajaran='$tahun'");

$sudahkerja = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k JOIN pengajuan p JOIN detail_pengajuan dp WHERE m.idkelas=k.idkelas AND m.nim=dp.nim 
                                        AND p.nopengajuan=dp.nopengajuan AND perihal='Kerja' AND statuspengajuan='1' AND thnajaran='$tahun'");
$sedangmagang = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k JOIN pengajuan p JOIN detail_pengajuan dp WHERE m.idkelas=k.idkelas AND m.nim=dp.nim
                                        AND p.nopengajuan=dp.nopengajuan AND perihal='Magang' AND statuspengajuan='1' AND thnajaran='$tahun'");
$gugur = mysqli_query($koneksi, "SELECT * FROM vnilai WHERE totalipk < 2.50 AND thnajaran='$tahun'");

$diagram_magang = mysqli_query($koneksi, "SELECT * FROM kelas WHERE thnajaran='$tahun' ORDER BY namakelas ASC");

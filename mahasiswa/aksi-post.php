<?php
session_start();
include('../koneksi.php');

####################################################################### PROFIL #####################################################################
if (isset($_POST['ubah-profil'])) {
    $nim = $_POST['nim'];
    $nama = addslashes($_POST['nama']);
    $jeniskelamin = $_POST['jeniskelamin'];
    $tmplahir = $_POST['tmplahir'];
    $tgllahir = $_POST['tgllahir'];
    $idkelas = $_POST['idkelas'];
    $alamat = addslashes($_POST['alamat']);
    $agama = $_POST['agama'];
    $statusnikah = $_POST['tgllahir'];
    $nohp = $_POST['nohp'];
    $kendaraan = $_POST['kendaraan'];
    $sim = $_POST['sim'];
    $posisi = addslashes($_POST['posisi']);
    $domisili = $_POST['domisili'];
    $bahasa = $_POST['bahasa'];
    $sma = addslashes($_POST['sma']);
    $jurusansma = $_POST['jurusansma'];

    $update = "UPDATE mahasiswa SET jeniskelamin='$jeniskelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', nohp='$nohp', sma='$sma', jurusansma='$jurusansma', idkelas='$idkelas', alamat='$alamat', kendaraan='$kendaraan', sim='$sim', posisi='$posisi', bahasa='$bahasa', domisili='$domisili', statusnikah='$statusnikah', status='$status' WHERE nim='$nim'";
    if (mysqli_query($koneksi, $update)) {
        mysqli_query($koneksi, "UPDATE user SET nama='$nama' WHERE id='$nim'");
        echo '<script>alert("Data Berhasil Disimpan!"); document.location="detail.php?nim=' . $nim . '";</script>';
    } else {
        echo '<script>alert("Data Gagal Disimpan!"); document.location="detail.php?nim=' . $nim . '";</script>';
        // echo "Pesan Error:" .  mysqli_error($koneksi);
    }
}


####################################################################### AKUN #####################################################################
if (isset($_POST['ubah-akun'])) {
    $id = $_POST['id'];
    $email_new = strtolower($_POST['email']);
    $email_old = strtolower($_POST['email-lama']);

    $cariduplikat = mysqli_query($koneksi, "SELECT email FROM user WHERE email='$email_new'");
    $user = mysqli_fetch_array($cariduplikat);
    if ($email_new == $email_old) {
        $email = $email_new;
    } else if ($email_new == $user['email']) {
        echo '<script>alert("Maaf.. E-Mail sudah terdaftar diakun lain!, mohon ganti dengan yang lain"); document.location="akun.php";</script>';
    } else {
        $email = $email_new;
    }

    $nama = addslashes($_POST['nama']);
    $password = addslashes($_POST['password']);
    $hakakses = $_POST['hakakses'];
    $statusakun = $_POST['statusakun'];
    $foto = $_FILES['foto']['name'];
    $query = mysqli_query($koneksi, "SELECT foto FROM user WHERE id='$id'");
    $cek = mysqli_fetch_array($query);
    $fotolama = $cek['foto'];

    if ($foto != "" && $fotolama == "") {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $angka_acak = rand(1, 999);
        $namafile = $angka_acak . '-' . str_replace(' ', '', $foto); // str_replace untuk menghilangkan spasi
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto']['size'];
        $file_tmp = $_FILES['foto']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, '../assets/uploads/foto/user/' . $namafile);
                $update = "UPDATE user SET nama='$nama', email='$email', password='$password', hakakses='$hakakses', statusakun='$statusakun', foto='$namafile' WHERE id='$id'";
                if (mysqli_query($koneksi, $update)) {
                    echo '<script>alert("Data Berhasil Diubah!"); document.location="akun.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Diubah!"); document.location="akun.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="akun.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="akun.php";</script>';
        }
    } elseif ($foto != "" && $fotolama != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $angka_acak = rand(1, 999);
        $namafile = $angka_acak . '-' . str_replace(' ', '', $foto); // str_replace untuk menghilangkan spasi
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto']['size'];
        $file_tmp = $_FILES['foto']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, '../assets/uploads/foto/user/' . $namafile);
                $update = "UPDATE user SET nama='$nama', email='$email', password='$password', hakakses='$hakakses', statusakun='$statusakun', foto='$namafile' WHERE id='$id'";
                if (mysqli_query($koneksi, $update)) {
                    unlink('../assets/uploads/foto/user/' . $fotolama); // Hapus foto lama
                    echo '<script>alert("Data Berhasil Disimpan!"); document.location="akun.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Disimpan!"); document.location="akun.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="akun.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="akun.php";</script>';
        }
    } else {
        $update = "UPDATE user SET nama='$nama', email='$email', password='$password', hakakses='$hakakses', statusakun='$statusakun' WHERE id='$id'";
        if (mysqli_query($koneksi, $update)) {
            echo '<script>alert("Data Berhasil Diubah!"); document.location="akun.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Diubah!"); document.location="akun.php";</script>';
        }
    }
}


####################################################################### PENGAJUAN #####################################################################
// STATUS PENGAJUAN 1 = DISETUJUI/SEDANG MAGANG
// STATUS PENGAJUAN 2 = MENUNGGU
// STATUS PENGAJUAN 3 = GAGAL
// STATUS PENGAJUAN 4 = SELESAI

if (isset($_POST['tambah-pengajuan'])) {
    $tanggal = $_POST['tanggal'];
    $perihal = $_POST['perihal'];
    $idperusahaan = $_POST['idperusahaan'];
    $statuspengajuan = "1";

    $carinopengajuan =  mysqli_query($koneksi, "SELECT MAX(nopengajuan) AS kodeTerbesar FROM pengajuan");
    $cek = mysqli_fetch_array($carinopengajuan);
    if ($cek['kodeTerbesar'] == $_POST['nopengajuan']) {
        $nopengajuan = $cek['kodeTerbesar'] + 1;
    } else {
        $nopengajuan = $_POST['nopengajuan'];
    }

    $nim = $_POST['nim'];
    $tglmulai = $_POST['tglmulai'];
    $tglselesai = $_POST['tglselesai'];
    $posisi_sbg = $_POST['posisi_sbg'];
    $statuspengajuan = '2';

    $tambah = "INSERT INTO pengajuan VALUES ('$nopengajuan', '$tanggal', '$perihal', '$idperusahaan', '$statuspengajuan')";
    if (mysqli_query($koneksi, $tambah)) {
        mysqli_query($koneksi, "INSERT INTO detail_pengajuan VALUES ('$nopengajuan', '$nim', '$tglmulai', '$tglselesai', '$posisi_sbg')");
        echo '<script>alert("Data Berhasil Diajukan!"); document.location="pengajuan.php";</script>';
    } else {
        echo '<script>alert("Maaf, coba kembali!"); document.location="pengajuan.php";</script>';
    }
}

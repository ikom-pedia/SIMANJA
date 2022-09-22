<?php
session_start();
include('../koneksi.php');

####################################################################### USER #####################################################################
if (isset($_POST['tambah-user'])) {
    $id = $_POST['id'];
    $email = strtolower($_POST['email']);

    $cariid = mysqli_query($koneksi, "SELECT id FROM user WHERE id='$id'");
    $cariemail = mysqli_query($koneksi, "SELECT email FROM user WHERE email='$email'");
    $user1 = mysqli_fetch_array($cariid);
    $user2 = mysqli_fetch_array($cariemail);
    if ($id == $user1['id']) {
        echo '<script>alert("Maaf.. ID sudah terdaftar diakun lain!, mohon ganti dengan yang lain"); document.location="user.php";</script>';
    }
    if ($email == $user2['email']) {
        echo '<script>alert("Maaf.. E-Mail sudah terdaftar diakun lain!, mohon ganti dengan yang lain"); document.location="user.php";</script>';
    }

    $nama = addslashes($_POST['nama']); // addslashes menjalankan teks berkarakter(' kutip) di mysql
    $password = addslashes($_POST['password']);
    $hakakses = $_POST['hakakses'];
    $statusakun = $_POST['statusakun'];
    $foto = $_FILES['foto']['name'];

    if ($foto != "") {
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
                $tambah = "INSERT INTO user VALUES ('$id', '$nama', '$email', '$password', '$hakakses', '$statusakun', '', '$namafile')";
                if (mysqli_query($koneksi, $tambah)) {
                    echo '<script>alert("Data Berhasil Disimpan!"); document.location="user.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Disimpan!"); document.location="user.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="user.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="user.php";</script>';
        }
    } else {
        $tambah = "INSERT INTO user VALUES ('$id', '$nama', '$email', '$password', '$hakakses', '$statusakun', '', '')";
        if (mysqli_query($koneksi, $tambah)) {
            echo '<script>alert("Data Berhasil Disimpan!"); document.location="user.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Disimpan!"); document.location="user.php";</script>';
        }
    }

    // EDIT USER
} elseif (isset($_POST['ubah-data-user'])) {
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
                    echo '<script>alert("Data Berhasil Diubah!"); document.location="user.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Diubah!"); document.location="user.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="user.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="user.php";</script>';
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
                    echo '<script>alert("Data Berhasil Disimpan!"); document.location="user.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Disimpan!"); document.location="user.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="user.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="user.php";</script>';
        }
    } else {
        $update = "UPDATE user SET nama='$nama', email='$email', password='$password', hakakses='$hakakses', statusakun='$statusakun' WHERE id='$id'";
        if (mysqli_query($koneksi, $update)) {
            echo '<script>alert("Data Berhasil Diubah!"); document.location="user.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Diubah!"); document.location="user.php";</script>';
        }
    }
}


####################################################################### KELAS #####################################################################
if (isset($_POST['tambah-kelas'])) {
    $namakelas = strtolower($_POST['namakelas']);
    $jurusan = strtolower($_POST['jurusan']);
    $thnajaran = $_POST['thnajaran'];
    $warna = $_POST['warna'];

    $tambah = "INSERT INTO kelas VALUES (null, '$namakelas', '$jurusan', '$thnajaran', '$warna')";
    if (mysqli_query($koneksi, $tambah)) {
        echo '<script>alert("Data Berhasil Disimpan!"); document.location="kelas.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Disimpan!"); document.location="kelas.php";</script>';
    }

    // UBAH KELAS
} elseif (isset($_POST['ubah-kelas'])) {
    $idkelas = $_POST['idkelas'];
    $namakelas = strtolower($_POST['namakelas']);
    $jurusan = strtolower($_POST['jurusan']);
    $thnajaran = $_POST['thnajaran'];
    $warna = $_POST['warna'];

    $update = "UPDATE kelas SET namakelas='$namakelas', jurusan='$jurusan', thnajaran='$thnajaran', warna='$warna' WHERE idkelas='$idkelas'";
    if (mysqli_query($koneksi, $update)) {
        echo '<script>alert("Data Berhasil Diubah!"); document.location="kelas.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Diubah!"); document.location="kelas.php";</script>';
    }
}


####################################################################### MAHASISWA #####################################################################
if (isset($_POST['tambah-mahasiswa'])) {
    $nim = $_POST['nim'];

    $cariduplikat = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    $mahasiswa = mysqli_fetch_array($cariduplikat);
    if ($nim == $mahasiswa['nim']) {
        echo '<script>alert("Maaf.. NIM sudah terdaftar diakun lain!, mohon ganti dengan yang lain"); document.location="mahasiswa.php";</script>';
    }

    $nama = addslashes($_POST['nama']);
    $jeniskelamin = $_POST['jeniskelamin'];
    $tmplahir = $_POST['tmplahir'];
    $tgllahir = $_POST['tgllahir'];
    $email = $_POST['email'];
    $idkelas = $_POST['idkelas'];
    $alamat = addslashes($_POST['alamat']);
    $agama = $_POST['agama'];
    $statusnikah = $_POST['statusnikah'];
    $nohp = $_POST['nohp'];
    $password = '12345678';
    $hakakses = 2;
    $statusakun = 2;

    // CARI POST LENGKAPI DATA
    if ($_POST['lengkapi-data'] == 'kosong') {
        $kendaraan = '';
        $sim = '';
        $posisi = '';
        $domisili = '';
        $bahasa = '';
        $sma = '';
        $jurusansma = '';
    } else {
        $kendaraan = $_POST['kendaraan'];
        $sim = $_POST['sim'];
        $posisi = addslashes($_POST['posisi']);
        $domisili = $_POST['domisili'];
        $bahasa = $_POST['bahasa'];
        $sma = addslashes($_POST['sma']);
        $jurusansma = $_POST['jurusansma'];
    }

    $tambah = "INSERT INTO user VALUES ('$nim', '$nama', '$email', '$password', '$hakakses', '$statusakun', '', '')";
    if (mysqli_query($koneksi, $tambah)) {
        mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES ('$nim', '$jeniskelamin', '$tmplahir', '$tgllahir', '$agama', '$nohp', '$sma', '$jurusansma', '$idkelas', '$alamat', '$kendaraan', '$sim', '$posisi', '$bahasa', '$domisili', '$statusnikah')");
        mysqli_query($koneksi, "INSERT INTO nilai VALUES ('$nim', '', '', '', '')");
        echo '<script>alert("Data Berhasil Disimpan!"); document.location="mahasiswa.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Disimpan!"); document.location="mahasiswa.php";</script>';
    }


    ####################################################################### DETAIL MAHASISWA #####################################################################
} elseif (isset($_POST['ubah-mahasiswa'])) {
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


####################################################################### NILAI IPK #####################################################################
// UBAH NILAI
if (isset($_POST['ubah-nilai'])) {
    $nim = $_POST['nim'];
    $statusnikah = $_POST['statusnikah'];
    $ipk1 = $_POST['ipk1'];
    $ipk2 = $_POST['ipk2'];
    $ipk3 = $_POST['ipk3'];
    $ipk4 = $_POST['ipk4'];

    $update = "UPDATE nilai SET ipk1='$ipk1', ipk2='$ipk2', ipk3='$ipk3', ipk4='$ipk4' WHERE nim='$nim'";
    if (mysqli_query($koneksi, $update)) {
        mysqli_query($koneksi, "UPDATE mahasiswa SET statusnikah='$statusnikah' WHERE nim='$nim'");
        echo '<script>alert("Data Berhasil Diubah!"); document.location="nilai.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Diubah!"); document.location="nilai.php";</script>';
    }
}


####################################################################### PERUSAHAAN #####################################################################
if (isset($_POST['tambah-relasi'])) {
    $namapt = $_POST['namapt'];
    $alamat = $_POST['alamatpt'];
    $telepon = $_POST['telepon'];
    $bidang = $_POST['bidang'];
    $logo = $_FILES['logo']['name'];

    if ($logo != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $angka_acak = rand(1, 999);
        $namafile = $angka_acak . '-' . str_replace(' ', '', $logo);
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, '../assets/uploads/foto/perusahaan/' . $namafile);
                $tambah = "INSERT INTO perusahaan VALUES (NULL, '$namapt', '$alamat', '$telepon', '$bidang', '$namafile')";
                if (mysqli_query($koneksi, $tambah)) {
                    echo '<script>alert("Data Berhasil Disimpan!"); document.location="perusahaan.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Disimpan!"); document.location="perusahaan.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="perusahaan.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="perusahaan.php";</script>';
        }
    } else {
        $tambah = "INSERT INTO perusahaan VALUES (NULL, '$namapt', '$alamat', '$telepon', '$bidang', '')";
        if (mysqli_query($koneksi, $tambah)) {
            echo '<script>alert("Data Berhasil Disimpan!"); document.location="perusahaan.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Disimpan!"); document.location="perusahaan.php";</script>';
        }
    }

    // EDIT PERUSAHAAN
} elseif (isset($_POST['ubah-data-perusahaan'])) {
    $id = $_POST['idperusahaan'];
    $namapt = $_POST['namapt'];
    $alamat = $_POST['alamatpt'];
    $telepon = $_POST['telepon'];
    $bidang = $_POST['bidang'];
    $logo = $_FILES['logo']['name'];
    $query = mysqli_query($koneksi, "SELECT logo FROM perusahaan WHERE idperusahaan='$id'");
    $cek = mysqli_fetch_array($query);
    $logolama = $cek['logo'];

    if ($logo != "" && $logolama == "") {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $angka_acak = rand(1, 999);
        $namafile = $angka_acak . '-' . str_replace(' ', '', $logo);
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, '../assets/uploads/foto/perusahaan/' . $namafile);
                $update = "UPDATE perusahaan SET namapt='$namapt', alamatpt='$alamat', telepon='$telepon', bidang='$bidang', logo='$namafile' WHERE idperusahaan='$id'";
                if (mysqli_query($koneksi, $update)) {
                    echo '<script>alert("Data Berhasil Diubah!"); document.location="perusahaan.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Diubah!"); document.location="perusahaan.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="perusahaan.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="perusahaan.php";</script>';
        }
    } elseif ($logo != "" && $logolama != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $angka_acak = rand(1, 999);
        $namafile = $angka_acak . '-' . str_replace(' ', '', $logo);
        $x = explode('.', $namafile);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, '../assets/uploads/foto/perusahaan/' . $namafile);
                $update = "UPDATE perusahaan SET namapt='$namapt', alamatpt='$alamat', telepon='$telepon', bidang='$bidang', logo='$namafile' WHERE idperusahaan='$id'";
                if (mysqli_query($koneksi, $update)) {
                    unlink('../assets/uploads/foto/perusahaan/' . $logolama); // Hapus logo lama
                    echo '<script>alert("Data Berhasil Disimpan!"); document.location="perusahaan.php";</script>';
                } else {
                    echo '<script>alert("Data Gagal Disimpan!"); document.location="perusahaan.php";</script>';
                }
            } else {
                echo '<script>alert("Ukuran Foto Terlalu Besar!"); document.location="perusahaan.php";</script>';
            }
        } else {
            echo '<script>alert("Format Foto Harus .png Atau .jpg"); document.location="perusahaan.php";</script>';
        }
    } else {
        $update = "UPDATE perusahaan SET namapt='$namapt', alamatpt='$alamat', telepon='$telepon', bidang='$bidang' WHERE idperusahaan='$id'";
        if (mysqli_query($koneksi, $update)) {
            echo '<script>alert("Data Berhasil Diubah!"); document.location="perusahaan.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Diubah!"); document.location="perusahaan.php";</script>';
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

    $tambah = "INSERT INTO pengajuan VALUES ('$nopengajuan', '$tanggal', '$perihal', '$idperusahaan', '$statuspengajuan')";
    if (mysqli_query($koneksi, $tambah)) {
        header("location:detail-pengajuan.php?id=$nopengajuan");
    } else {
        echo '<script>alert("Maaf, coba kembali!"); document.location="pengajuan.php";</script>';
    }

    // UBAH PENGAJUAN
} elseif (isset($_POST['ubah-pengajuan'])) {
    $nopengajuan = $_POST['nopengajuan'];
    $tanggal = $_POST['tanggal'];
    $perihal = $_POST['perihal'];
    $idperusahaan = $_POST['idperusahaan'];

    $update = "UPDATE pengajuan SET tanggal='$tanggal', perihal='$perihal', idperusahaan='$idperusahaan' WHERE nopengajuan='$nopengajuan'";
    if (mysqli_query($koneksi, $update)) {
        echo '<script>alert("Data Berhasil Disimpan!"); document.location="pengajuan.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Disimpan!"); document.location="pengajuan.php";</script>';
    }


    // TAMBAH DETAIL PENGAJUAN
} elseif (isset($_POST['add-detailPengajuan'])) {
    $nopengajuan = $_POST['nopengajuan'];
    $nim = $_POST['nim'];
    $tglmulai = $_POST['tglmulai'];
    $tglselesai = $_POST['tglselesai'];
    $posisi_sbg = $_POST['posisi_sbg'];

    $tambah = "INSERT INTO detail_pengajuan VALUES ('$nopengajuan', '$nim', '$tglmulai', '$tglselesai', '$posisi_sbg')";
    if (mysqli_query($koneksi, $tambah)) {
        header("location:detail-pengajuan.php?id=$nopengajuan");
    } else {
        echo '<script>alert("Maaf, coba kembali!"); document.location="pengajuan.php";</script>';
    }
}

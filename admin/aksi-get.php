<?php
session_start();
include('../koneksi.php');

####################################################################### USER #####################################################################
// HAPUS USER
if ($_GET['act'] == 'hapus-user') {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
    $cek = mysqli_fetch_array($query);
    if ($cek['foto'] == '') {
        $hapus = "DELETE FROM user WHERE id='$id'";
        if (mysqli_query($koneksi, $hapus)) {
            echo '<script>alert("Data Berhasil Dihapus!"); document.location="user.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Dihapus!"); document.location="user.php";</script>';
        }
    } else {
        $hapus = "DELETE FROM user WHERE id='$id'";
        if (mysqli_query($koneksi, $hapus)) {
            unlink('../assets/uploads/foto/user/' . $cek['foto']);
            echo '<script>alert("Data Berhasil Dihapus!"); document.location="user.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Dihapus!"); document.location="user.php";</script>';
        }
    }


    // UBAH STATUS
} elseif ($_GET['act'] == 'status-aktif') {
    $id = $_GET['id'];

    $update = "UPDATE user SET statusakun='1' WHERE id='$id'";
    if (mysqli_query($koneksi, $update)) {
        header('location:user.php');
    } else {
        echo '<script>alert("Gagal diubah!"); document.location="user.php";</script>';
    }
} elseif ($_GET['act'] == 'status-nonaktif') {
    $id = $_GET['id'];

    $update = "UPDATE user SET statusakun='2' WHERE id='$id'";
    if (mysqli_query($koneksi, $update)) {
        header('location:user.php');
    } else {
        echo '<script>alert("Gagal diubah!"); document.location="user.php";</script>';
    }

    // SETTING T.A
} elseif ($_GET['act'] == 'setting-ta') {
    $id = $_SESSION['id'];
    $tahun = $_GET['ta'];

    $update = "UPDATE user SET setting='$tahun' WHERE id='$id'";
    if (mysqli_query($koneksi, $update)) {
        header('location:dashboard.php');
    } else {
        echo '<script>alert("Gagal diubah!"); document.location="dashboard.php";</script>';
    }
}


####################################################################### KELAS #####################################################################
// HAPUS KELAS
if ($_GET['act'] == 'hapus-kelas') {
    $id = $_GET['id'];

    $hapus = "DELETE FROM kelas WHERE idkelas='$id'";
    if (mysqli_query($koneksi, $hapus)) {
        echo '<script>alert("Data Berhasil Dihapus!"); document.location="kelas.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Dihapus!"); document.location="kelas.php";</script>';
    }
}


####################################################################### MAHASISWA #####################################################################
// HAPUS MAHASISWA
if ($_GET['act'] == 'hapus-mahasiswa') {
    $nim = $_GET['nim'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$nim'");
    $cek = mysqli_fetch_array($query);
    if ($cek['foto'] == '') {
        $hapus = "DELETE FROM user WHERE id='$nim'";
        if (mysqli_query($koneksi, $hapus)) {
            mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");
            mysqli_query($koneksi, "DELETE FROM nilai WHERE nim='$nim'");
            mysqli_query($koneksi, "DELETE FROM detail_pengajuan WHERE nim='$nim'");
            echo '<script>alert("Data Berhasil Dihapus!"); document.location="mahasiswa.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Dihapus!"); document.location="mahasiswa.php";</script>';
        }
    } else {
        unlink('../assets/uploads/foto/user/' . $cek['foto']);
        $hapus = "DELETE FROM user WHERE id='$nim'";
        if (mysqli_query($koneksi, $hapus)) {
            mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");
            mysqli_query($koneksi, "DELETE FROM nilai WHERE nim='$nim'");
            mysqli_query($koneksi, "DELETE FROM detail_pengajuan WHERE nim='$nim'");
            echo '<script>alert("Data Berhasil Dihapus!"); document.location="mahasiswa.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Dihapus!"); document.location="mahasiswa.php";</script>';
        }
    }
}


####################################################################### PERUSAHAAN #####################################################################
// HAPUS PERUSAHAAN
if ($_GET['act'] == 'hapus-perusahaan') {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM perusahaan WHERE idperusahaan='$id'");
    $cek = mysqli_fetch_array($query);
    if ($cek['logo'] == '') {
        $hapus = "DELETE FROM perusahaan WHERE idperusahaan='$id'";
        if (mysqli_query($koneksi, $hapus)) {
            echo '<script>alert("Data Berhasil Dihapus!"); document.location="perusahaan.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Dihapus!"); document.location="perusahaan.php";</script>';
        }
    } else {
        unlink('../assets/uploads/foto/perusahaan/' . $cek['logo']);
        $hapus = "DELETE FROM perusahaan WHERE idperusahaan='$id'";
        if (mysqli_query($koneksi, $hapus)) {
            echo '<script>alert("Data Berhasil Dihapus!"); document.location="perusahaan.php";</script>';
        } else {
            echo '<script>alert("Data Gagal Dihapus!"); document.location="perusahaan.php";</script>';
        }
    }
}


####################################################################### PENGAJUAN #####################################################################
// HAPUS PENGAJUAN
if ($_GET['act'] == 'hapus-pengajuan') {
    $nopengajuan = $_GET['id'];

    $hapus = "DELETE FROM pengajuan WHERE nopengajuan='$nopengajuan'";
    if (mysqli_query($koneksi, $hapus)) {
        mysqli_query($koneksi, "DELETE FROM detail_pengajuan WHERE nopengajuan='$nopengajuan'");
        echo '<script>alert("Data Berhasil Dihapus!"); document.location="pengajuan.php";</script>';
    } else {
        echo '<script>alert("Data Gagal Dihapus!"); document.location="pengajuan.php";</script>';
    }

    // HAPUS DETAIL PENGAJUAN
} elseif ($_GET['act'] == 'hapus-detailpengajuan') {
    $nopengajuan = $_GET['id'];
    $nim = $_GET['nim'];

    $hapus = "DELETE FROM detail_pengajuan WHERE nopengajuan='$nopengajuan' AND nim='$nim'";
    if (mysqli_query($koneksi, $hapus)) {
        echo '<script>alert("Data Berhasil Dihapus!"); document.location="detail-pengajuan.php?id=' . $nopengajuan . '";</script>';
    } else {
        echo '<script>alert("Data Gagal Dihapus!"); document.location="detail-pengajuan.php?id=' . $nopengajuan . '";</script>';
    }

    // KONFIRMASI PENGAJUAN
} elseif ($_GET['act'] == 'status-konfirmasi') {
    $nopengajuan = $_GET['id'];

    $update = "UPDATE pengajuan SET statuspengajuan=1 WHERE nopengajuan='$nopengajuan'";
    if (mysqli_query($koneksi, $update)) {
        header('location:konfirmasi.php');
    } else {
        echo '<script>alert("Gagal diubah!"); document.location="konfirmasi.php";</script>';
    }
} elseif ($_GET['act'] == 'status-tolak') {
    $nopengajuan = $_GET['id'];

    $update = "UPDATE pengajuan SET statuspengajuan=3 WHERE nopengajuan='$nopengajuan'";
    if (mysqli_query($koneksi, $update)) {
        header('location:konfirmasi.php');
    } else {
        echo '<script>alert("Gagal diubah!"); document.location="konfirmasi.php";</script>';
    }

    // UBAH STATUS PENGAJUAN
} elseif ($_GET['act'] == 'status-selesai') {
    $nopengajuan = $_GET['id'];

    $update = "UPDATE pengajuan SET statuspengajuan=4 WHERE nopengajuan='$nopengajuan'";
    if (mysqli_query($koneksi, $update)) {
        header('location:pengajuan.php');
    } else {
        echo '<script>alert("Gagal diubah!"); document.location="pengajuan.php";</script>';
    }
}

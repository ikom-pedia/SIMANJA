<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password'");
    $cek = mysqli_num_rows($login);
    if ($cek > 0) {
        $field = mysqli_fetch_assoc($login);
        // cek jika user login sebagai admin
        if ($field['hakakses'] == '1') {
            if ($field['statusakun'] == '1') {
                $_SESSION['id'] = $field['id'];
                $_SESSION['email'] = $email;
                $_SESSION['hakakses'] = 'admin';
                // alihkan ke halaman dashboard admin
                header("location:admin");
            } else {
                echo "<script>alert('Maaf..!! akun anda belum diaktifkan, mohon hubungi admin'); document.location='$base_url';</script>";
            }

            // cek jika user login sebagai mahasiswa
        } else if ($field['hakakses'] == '2') {
            if ($field['statusakun'] == '1') {
                $_SESSION['id'] = $field['id'];
                $_SESSION['email'] = $email;
                $_SESSION['hakakses'] = 'mahasiswa';
                // alihkan ke halaman dashboard mahasiswa
                header("location:mahasiswa");
            } else {
                echo "<script>alert('Maaf..!! akun anda belum diaktifkan, mohon hubungi admin'); document.location='$base_url';</script>";
            }
        } else {
            $_SESSION['email-login'] = $email;
            $_SESSION['password-login'] = $password;
            header("location:login.php?pesan=gagal");
        }
    } else {
        // header("location:$base_url");
        $_SESSION['email-login'] = $email;
        $_SESSION['password-login'] = $password;
        header("location:login.php?pesan=gagal");
    }
}

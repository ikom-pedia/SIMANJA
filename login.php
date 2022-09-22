<?php
session_start();
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMANJA | Login</title>
    <link href="<?= $base_url ?>assets/uploads/foto/default/avatar.png" rel='shortcut icon' type='image/x-icon' />

    <!-- Custom fonts for this template-->
    <link href="<?= $base_url ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $base_url ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-header text-center">
                        <img src="<?= $base_url ?>assets/uploads/foto/default/logo-lp3i.png" class="elevation" alt="logo lp3i banten" width="20%">
                        <h3>
                            <br>
                            <b>SIMANJA | LP3I Banten</b>
                        </h3>
                        <h5>(Sistem Informasi Magang dan Kerja LP3I Banten)</h5>
                    </div>
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <!-- <div class="row"> -->
                        <?php
                        if (!isset($_GET['pesan'])) {
                            $pesan = "";
                        } else {
                            $pesan = $_GET['pesan'];
                        }

                        if ($pesan == "gagal") {
                            $validasi = "form-control form-control-user is-invalid";
                            $email = $_SESSION['email-login'];
                            $password = $_SESSION['password-login'];
                            $message = '<div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                            Maaf, Email / Password salah!!
                                        </div>';
                        } elseif ($pesan == "login-dulu") {
                            $validasi = "form-control form-control-user";
                            $email = "";
                            $password = "";
                            $message = '<div class="alert alert-info alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                            Silakan login untuk masuk ke sistem!
                                        </div>';
                        } elseif ($pesan == "logout") {
                            $validasi = "form-control form-control-user";
                            $email = "";
                            $password = "";
                            $message = '<div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                            Anda telah logout, terima kasih!
                                        </div>';
                        } else {
                            $validasi = "form-control form-control-user";
                            $email = "";
                            $password = "";
                            $message = "";
                        }

                        ?>

                        <div class="col-lg">
                            <div class="p-5">
                                <?= $message ?>
                                <!-- <div class="text-center">
                                        <p class="h5 text-gray-900 mb-4">Silakan login untuk masuk ke sistem</p>
                                    </div> -->
                                <form action="cek_login.php" method="POST" class="user">
                                    <div class="form-group">
                                        <input type="email" name="email" class="<?= $validasi ?>" value="<?= $email ?>" placeholder="Masukkan Email...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="<?= $validasi ?>" value="<?= $password ?>" placeholder="Password...">
                                    </div>
                                    <br>
                                    <div align="center">
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block col-5">
                                            Login
                                        </button>
                                    </div>
                                    <hr>
                                </form>

                                <!-- <div class="text-center">
                                    <a class="small" href="#">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="#">Daftar Akun!</a>
                                </div> -->
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= $base_url ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $base_url ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $base_url ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $base_url ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>
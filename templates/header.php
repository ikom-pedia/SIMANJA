<?php
session_start();
include('../koneksi.php');
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Maaf, login dulu!"); document.location="../login.php?pesan=login-dulu";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMANJA | <?= $page ?></title>
    <link href="<?= $base_url ?>assets/uploads/foto/default/avatar.png" rel="shortcut icon" type="image/x-icon" />

    <!-- Custom fonts for this template-->
    <link href="<?= $base_url ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Select2 -->
    <link href="<?= $base_url ?>assets/vendor/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>assets/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $base_url ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= $base_url ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= $base_url ?>assets/vendor/jquery/jquery.js"></script>

    <style>
        .bg-indigo {
            background-color: #6610f2;
        }

        .bg-lightblue {
            background-color: #3c8dbc;
        }

        .bg-navy {
            background-color: #001f3f;
        }

        .bg-purple {
            background-color: #605ca8;
        }

        .bg-fuchsia {
            background-color: #f012be;
        }

        .bg-pink {
            background-color: #e83e8c;
        }

        .bg-maroon {
            background-color: #d81b60;
        }

        .bg-orange {
            background-color: #ff851b;
        }

        .bg-lime {
            background-color: #01ff70;
        }

        .bg-teal {
            background-color: #39cccc;
        }

        .bg-olive {
            background-color: #3d9970;
        }

        .text-indigo {
            color: #6610f2;
        }

        .text-lightblue {
            color: #3c8dbc;
        }

        .text-navy {
            color: #001f3f;
        }

        .text-purple {
            color: #605ca8;
        }

        .text-fuchsia {
            color: #f012be;
        }

        .text-pink {
            color: #e83e8c;
        }

        .text-maroon {
            color: #d81b60;
        }

        .text-orange {
            color: #ff851b;
        }

        .text-lime {
            color: #01ff70;
        }

        .text-teal {
            color: #39cccc;
        }

        .text-olive {
            color: #3d9970;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
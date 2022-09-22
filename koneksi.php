<?php

$koneksi = mysqli_connect("localhost", "root", "", "simanja");
if (!$koneksi) {
    die("Koneksi database gagal" . mysqli_connect_error());
}

$base_url = "http://localhost/SIMANJA/";

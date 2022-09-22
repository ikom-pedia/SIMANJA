<?php
$page = "LP3I Banten";
include('../templates/sidebar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="cetak-persentase.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Unduh Laporan</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- TOTAL MAHASISWA -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                TOTAL MAHASISWA</div>
                            <div class='h5 mb-0 font-weight-bold text-gray-800'><?= mysqli_num_rows($sum_mahasiswa) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SUDAH KERJA -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                SUDAH KERJA</div>
                            <div class='h5 mb-0 font-weight-bold text-gray-800'><?= mysqli_num_rows($sudahkerja) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEDANG MAGANG -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                SEDANG MAGANG</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= mysqli_num_rows($sedangmagang) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FREE MAGANG -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                FREE MAGANG</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= (mysqli_num_rows($sum_mahasiswa) - mysqli_num_rows($sudahkerja) - mysqli_num_rows($sedangmagang) - mysqli_num_rows($gugur)) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GUGUR PENEMPATAN -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                GUGUR PENEMPATAN</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= mysqli_num_rows($gugur) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Chart -->
    <div class="row">
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Perkembangan Magang Perbulan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Column -->
        <div class="col-xl-5 col-lg-7">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Persentase Magang Perkelas</h6>
                </div>
                <div class="card-body">
                    <?php
                    foreach ($diagram_magang as $data) {
                        $namakelas = $data['namakelas'];
                        $magangperkelas = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan AND dp.nim=m.nim AND m.idkelas=k.idkelas AND (p.statuspengajuan=1 OR p.statuspengajuan=4) AND k.namakelas='$namakelas'");
                        $sumperkelas = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k WHERE m.idkelas=k.idkelas AND k.namakelas='$namakelas'");
                        $carisiswa = mysqli_fetch_array($magangperkelas);
                        if (!$carisiswa) {
                    ?>
                            <h4 class="small font-weight-bold"><?= strtoupper($data['namakelas']) ?>
                                <span class="float-right">0%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="<?= $data['warna'] ?>" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?= mysqli_num_rows($sumperkelas) ?>"></div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <h4 class="small font-weight-bold"><?= strtoupper($data['namakelas']) ?>
                                <span class="float-right"><?= round((mysqli_num_rows($magangperkelas) / mysqli_num_rows($sumperkelas)) * 100) ?>%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="<?= $data['warna'] ?>" role="progressbar" style="width: <?= (mysqli_num_rows($magangperkelas) / mysqli_num_rows($sumperkelas)) * 100 ?>%" aria-valuenow="<?= mysqli_num_rows($magangperkelas) ?>" aria-valuemin="0" aria-valuemax="<?= mysqli_num_rows($sumperkelas) ?>"></div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Ikom Project <?= date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "<strong>Logout</strong>" untuk ingin mengakhiri sesi ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?= $base_url ?>logout.php">Logout</a>
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

<!-- Page level plugins -->
<script src="<?= $base_url ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $base_url ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= $base_url ?>assets/vendor/chart.js/Chart.min.js"></script>

<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                label: "Siswa Magang",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                // data: [0, 10, 5, 15, 10, 20, 15, 25, 20, 30, 25, 40],
                data: [
                    <?php
                    // GET DATA BERDASARKAN BULAN
                    $getjanuari = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='01' GROUP BY namakelas");
                    $getfebruari = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='02' GROUP BY namakelas");
                    $getmaret = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='03' GROUP BY namakelas");
                    $getapril = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='04' GROUP BY namakelas");
                    $getmei = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='05' GROUP BY namakelas");
                    $getjuni = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='06' GROUP BY namakelas");
                    $getjuli = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='07' GROUP BY namakelas");
                    $getagustus = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='08' GROUP BY namakelas");
                    $getseptember = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='09' GROUP BY namakelas");
                    $getoktober = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='10' GROUP BY namakelas");
                    $getnovember = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='11' GROUP BY namakelas");
                    $getdesember = mysqli_query($koneksi, "SELECT * FROM pengajuan p JOIN detail_pengajuan dp JOIN mahasiswa m JOIN kelas k WHERE p.nopengajuan=dp.nopengajuan
                                  AND dp.nim=m.nim AND m.idkelas=k.idkelas AND thnajaran='$tahun' AND month(tglmulai)='12' GROUP BY namakelas");

                    // CEK DATA BERDASARKAN BULAN
                    $cekjan = mysqli_num_rows($getjanuari);
                    if ($cekjan > 0) {
                        $januari = $cekjan;
                    } else {
                        $januari = 0;
                    }
                    $cekfeb = mysqli_num_rows($getfebruari);
                    if ($cekfeb > 0) {
                        $februari = $cekfeb;
                    } else {
                        $februari = 0;
                    }
                    $cekmar = mysqli_num_rows($getmaret);
                    if ($cekmar > 0) {
                        $maret = $cekmar;
                    } else {
                        $maret = 0;
                    }
                    $cekapr = mysqli_num_rows($getapril);
                    if ($cekapr > 0) {
                        $april = $cekapr;
                    } else {
                        $april = 0;
                    }
                    $cekmei = mysqli_num_rows($getmei);
                    if ($cekmei > 0) {
                        $mei = $cekmei;
                    } else {
                        $mei = 0;
                    }
                    $cekjun = mysqli_num_rows($getjuni);
                    if ($cekjun > 0) {
                        $juni = $cekjun;
                    } else {
                        $juni = 0;
                    }
                    $cekjul = mysqli_num_rows($getjuli);
                    if ($cekjul > 0) {
                        $juli = $cekjul;
                    } else {
                        $juli = 0;
                    }
                    $cekagu = mysqli_num_rows($getagustus);
                    if ($cekagu > 0) {
                        $agustus = $cekagu;
                    } else {
                        $agustus = 0;
                    }
                    $ceksep = mysqli_num_rows($getseptember);
                    if ($ceksep > 0) {
                        $september = $ceksep;
                    } else {
                        $september = 0;
                    }
                    $cekokt = mysqli_num_rows($getoktober);
                    if ($cekokt > 0) {
                        $oktober = $cekokt;
                    } else {
                        $oktober = 0;
                    }
                    $ceknov = mysqli_num_rows($getnovember);
                    if ($ceknov > 0) {
                        $november = $ceknov;
                    } else {
                        $november = 0;
                    }
                    $cekdes = mysqli_num_rows($getnovember);
                    if ($cekdes > 0) {
                        $desember = $cekdes;
                    } else {
                        $desember = 0;
                    }
                    ?>

                    // TAMPILKAN DATA
                    <?= $januari ?>,
                    <?= $februari ?>,
                    <?= $maret ?>,
                    <?= $april ?>,
                    <?= $mei ?>,
                    <?= $juni ?>,
                    <?= $juli ?>,
                    <?= $agustus ?>,
                    <?= $september ?>,
                    <?= $oktober ?>,
                    <?= $november ?>,
                    <?= $desember ?>
                ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ' = ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById("DiagramPie");
    var DiagramPie = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                <?php
                foreach ($diagram_magang as $data) {
                ?> '<?= strtoupper($data['namakelas']) ?>',
                <?php } ?>
            ],
            datasets: [{
                data: [
                    <?php
                    foreach ($diagram_magang as $data) {
                        $namakelas = $data['namakelas'];
                        $magangperkelas = mysqli_query($koneksi, "SELECT * FROM mahasiswa m JOIN kelas k JOIN pengajuan p JOIN detail_pengajuan dp WHERE m.idkelas=k.idkelas
                                                                  AND m.nim=dp.nim AND k.namakelas='$namakelas' AND m.status=2 AND thnajaran='$tahun'");
                        $carimahasiswa = mysqli_fetch_array($magangperkelas);
                        if (!$carimahasiswa) {
                    ?> '0',
                        <?php
                        } else {
                        ?> '<?= round((mysqli_num_rows($magangperkelas) / mysqli_num_rows($sum_mahasiswa)) * 100) ?>',
                    <?php
                        }
                    }
                    ?>
                ],
                backgroundColor: [
                    <?php
                    foreach ($diagram_magang as $data) {
                        $warna = substr($data['warna'], 16, 7);

                        if ($warna == "primary") {
                            $warna = "#4e73df";
                        } elseif ($warna == "success") {
                            $warna = "#1cc88a";
                        } elseif ($warna == "info") {
                            $warna = "#36b9cc";
                        } elseif ($warna == "warning") {
                            $warna = "#f6c23e";
                        } elseif ($warna == "danger") {
                            $warna = "#e74a3b";
                        } elseif ($warna == "secondary") {
                            $warna = "#858796";
                        } elseif ($warna == "lightblue") {
                            $warna = "#3c8dbc";
                        } elseif ($warna == "indigo") {
                            $warna = "#6610f2";
                        } elseif ($warna == "lightblue") {
                            $warna = "#3c8dbc";
                        } elseif ($warna == "navy") {
                            $warna = "#001f3f";
                        } elseif ($warna == "purple") {
                            $warna = "#605ca8";
                        } elseif ($warna == "fuchsia") {
                            $warna = "#f012be";
                        } elseif ($warna == "pink") {
                            $warna = "#e83e8c";
                        } elseif ($warna == "maroon") {
                            $warna = "#d81b60";
                        } elseif ($warna == "orange") {
                            $warna = "#ff851b";
                        } elseif ($warna == "lime") {
                            $warna = "#01ff70";
                        } elseif ($warna == "teal") {
                            $warna = "#39cccc";
                        } elseif ($warna == "olive") {
                            $warna = "#3d9970";
                        }
                    ?> '<?= $warna ?>',
                    <?php } ?>
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>


</body>

</html>
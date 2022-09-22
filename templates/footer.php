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

<!-- Select2 -->
<script src="<?= $base_url ?>assets/vendor/select2/js/select2.full.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?= $base_url ?>assets/vendor/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
    // DataTable
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $('#riwayatMagang').DataTable({
        searching: false,
        ordering: false,
        paging: false,
        info: false
    });

    // Select2
    $('.select2').select2()

    // Select2 + Bootstrap4
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    // Bs-Custom-File-Input
    $(function() {
        bsCustomFileInput.init();
    });

    $(document).ready(function() {
        $('#fJurusan').on('change', function() {
            var jurusan = $(this).val();
            $.ajax({
                type: 'POST',
                url: "../ajax/data-mahasiswa.php",
                data: {
                    jurusan: jurusan
                },
                success: function(data) {
                    $("#table-mahasiswa").html(data);
                },
            });
        });
    });

    $(document).ready(function() {
        $('#lengkapi-data').on('click', function() {
            $.ajax({
                url: "../ajax/lengkapi-data.php",
                success: function(tampilkan) {
                    $("#tampil-form").html(tampilkan);
                },
            });
        });
    });

    $(document).ready(function() {
        $('#cari-jurusan').on('change', function() {
            var idkelas = $(this).val();
            $.ajax({
                type: 'POST',
                url: "../ajax/cari-jurusan.php",
                data: {
                    idkelas: idkelas
                },
                success: function(data) {
                    $("#jurusan").html(data);
                },
            });
        });
    });
</script>

</body>

</html>
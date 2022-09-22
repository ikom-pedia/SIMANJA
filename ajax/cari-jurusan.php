<?php
include '../koneksi.php';
$idkelas = $_POST['idkelas'];

$kelas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT jurusan FROM kelas WHERE idkelas='$idkelas'"));
?>
<label><strong>Jurusan :</strong></label>
<input type="text" name="jurusan" class="form-control" value="<?= ucwords($kelas['jurusan']) ?>" readonly>
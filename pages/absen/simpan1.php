<?php
error_reporting(0);
session_start();
include '../../koneksi1.php';

$username = $_SESSION['username'];
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$hadir = $_POST['hadir'];
$alpha = $_POST['alpha'];
$cuti = $_POST['cuti'];
$sakit = $_POST['sakit'];
$luar = $_POST['luar'];
$telat = $_POST['telat'];
$lembur = $_POST['lembur'];
$notrans = $_POST['notrans'];

$text = "UPDATE absen_r SET hadir='$hadir', alpha='$alpha',cuti='$cuti',sakit='$sakit',
         luar='$luar',telat='$telat',lembur='$lembur' WHERE notrans='$notrans' AND nik='$nik'";
mysql_query($text);

$ambilg = mysql_fetch_array(mysql_query("select * from gaji_master where kode='$nik'"));
$gapok = $ambilg['gapok'];
$komunikasi = $ambilg['komunikasi'];
$uang_hadir = $ambilg['uang_hadir'];
$transpor = $ambilg['transportasi'];
$uang_lembur = $ambilg['u_lembur'];
$uhadir = $hadir * $uang_hadir;
$ulembur = $lembur * $uang_lembur;

$text1 = "UPDATE gaji_transaksi SET uang_hadir = '$uhadir', ulembur='$ulembur', jml_hadir='$hadir',
          jml_lk='$luar', jml_cuti='$cuti', jml_sakit='$sakit', jml_alpha='$alpha' WHERE keterangan='$notrans' AND nik='$nik'";
mysql_query($text1);

echo "Simpan Sukses " .$notrans;

?>

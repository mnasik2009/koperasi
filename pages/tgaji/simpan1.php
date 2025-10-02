<?php
error_reporting(0);
session_start();
include '../../koneksi1.php';

$username = $_SESSION['username'];
$tgltrans = $_POST['tgltrans'];
$notrans = $_POST['notrans'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$gapok = $_POST['gapok'];
$komunikasi = $_POST['komunikasi'];
$uang_hadir = $_POST['uang_hadir'];
$pph21 = $_POST['pph21'];
$potlain = $_POST['potlain'];


$format1 = date('Y-m-d', strtotime($tgltrans));


$data1 = mysql_fetch_array($nomor);
$idMax = $data1['noref'];
$idMax++;
$newID = 'SLR-'.$tahun .$bulan . sprintf('%06d',$idMax);

$row = mysql_num_rows(mysql_query("SELECT * FROM gaji_transaksi WHERE notrans='$notrans'"));
if($row>0){
  $text = "UPDATE gaji_transaksi SET tgltrans='$format1',
                  nik='$kode',
                  bulan='$bulan',
                  tahun='$tahun',
                  gapok='$gapok',
                  komunikasi='$komunikasi',
                  uang_hadir='$uang_hadir',
                  pph21='$pph21',
                  potlain='$potlain' WHERE notrans='$notrans'";
  mysql_query($text);
	echo "Data berhasil di update";
}
?>

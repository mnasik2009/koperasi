<?php
error_reporting(0);
session_start();
include '../../koneksi1.php';

$username = $_SESSION['username'];
$tanggal = $_POST['tanggal'];
$notrans = $_POST['notrans'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$keterangan = $_POST['keterangan'];


$format1 = date('Y-m-d', strtotime($tanggal));
$tglinput = date('Y-m-d');
$nomor = mysql_query("select max(substr(notrans,-6)) as noref from absen_m where year(tanggal)='$tahun'");

$data1 = mysql_fetch_array($nomor);
$idMax = $data1['noref'];
$idMax++;
$newID = 'PRE-'.$tahun .$bulan . sprintf('%06d',$idMax);

$row = mysql_num_rows(mysql_query("SELECT * FROM absen_m WHERE notrans='$notrans'"));
if($row>0){
	$text = "UPDATE absen_m SET tanggal = '$format1',
								tglinput = '$tglinput',
								Bulan = '$bulan',
								keterangan = '$keterangan',
                tahun='$tahun'
								WHERE notrans='$notrans'";
	mysql_query($text);
	echo "Update Sukses";
}else{
    $text = "INSERT INTO absen_m (notrans,tanggal,bulan,tahun,tglinput,userid,keterangan)
			VALUES ('$newID','$format1','$bulan','$tahun','$tglinput','$username','$keterangan')";
	mysql_query($text);
	echo "Simpan Sukses " .$newID;

}
?>

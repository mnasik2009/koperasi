<?php
error_reporting(0);
include '../../koneksi1.php';
$kode = $_POST['id'];
$row = mysql_num_rows(mysql_query("SELECT * FROM absen_m WHERE notrans='$kode'"));
if($row>0){
	$text = "DELETE FROM absen_m
			WHERE notrans='$kode'";
	mysql_query($text);
	echo "Hapus Sukses";
}else{
	echo "Tidak ada data yang dihapus $kode";
}
?>

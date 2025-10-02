<?php
include '../../koneksi1.php';
$kode = $_POST['id'];
$row = mysql_num_rows(mysql_query("SELECT * FROM globalset WHERE kode='$kode'"));
if($row>0){
	$text = "DELETE FROM globalset
			WHERE kode='$kode'";
	mysql_query($text);
	echo "Hapus Sukses";
}else{
	echo "Tidak ada data yang dihapus $kode";
}
?>

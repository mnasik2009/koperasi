<?php
error_reporting(0);
include '../../koneksi1.php';
$kode_simpan = $_POST['id'];
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_simpan WHERE kode_simpan='$kode'"));
if($row>0){
	$text = "DELETE FROM t_simpan 
			WHERE kode_simpan='$kode_simpan'";
	mysqli_query($koneksi, $text);
	echo "Hapus Sukses";
}else{
	echo "Tidak ada data yang dihapus $kode";
}
?>
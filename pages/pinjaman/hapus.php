<?php
error_reporting(0);
include '../../koneksi1.php';
$kode_pengajuan = $_POST['id'];
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_pengajuan WHERE kode_pengajuan='$kode_pengajuan'"));
if($row>0){
	$text = "DELETE FROM t_pengajuan 
			WHERE kode_pengajuan='$kode_pengajuan'";
	mysqli_query($koneksi, $text);
	echo "Hapus Sukses";
}else{
	echo "Tidak ada data yang dihapus $kode_pengajuan";
}
?>
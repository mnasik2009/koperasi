<?php
error_reporting(0);
include '../../koneksi1.php';
$kode_anggota = $_POST['id'];
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_anggota WHERE kode_anggota='$kode_anggota'"));
if($row>0){
	$text = "DELETE FROM t_anggota 
			WHERE kode_anggota='$kode_anggota'";
	mysqli_query($koneksi, $text);
	echo "Hapus Sukses";
}else{
	echo "Tidak ada data yang dihapus $kode";
}
?>
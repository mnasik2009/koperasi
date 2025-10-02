<?php
error_reporting(0);
include '../../koneksi1.php';
$notrans = $_POST['id'];
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM bank WHERE notrans='$notrans'"));
if($row>0){
	$text = "DELETE FROM bank
			WHERE notrans='$notrans'";
	mysqli_query($koneksi, $text);
	echo "Hapus Sukses";
}else{
	echo "Tidak ada data yang dihapus $notrans";
}
?>
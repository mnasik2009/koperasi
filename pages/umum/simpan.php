<?php
include '../../koneksi1.php';

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$pimpinan = $_POST['pimpinan'];
$alamat = $_POST['alamat'];
$kota = $_POST['kota'];
$norek = $_POST['norek'];
$bank = $_POST['bank'];
$pemilikrek = $_POST['pemilikrek'];

$row = mysql_num_rows(mysql_query("SELECT * FROM globalset WHERE kode='$kode'"));
if($row>0){
	$text = "UPDATE globalset SET nama='$nama',
								alamat='$alamat',
								kota='$kota',
								norek='$norek',
								bank='$bank',
								pemilikrek='$pemilikrek',
								pimpinan='$pimpinan'
			WHERE kode='$kode'";
	mysql_query($text);
	echo "Update Sukses";
}else{
	$text = "INSERT INTO globalset SET kode='$kode',
								nama='$nama',
								alamat='$alamat',
								kota='$kota',
								norek='$norek',
								bank='$bank',
								pemilikrek='$pemilikrek',
								pimpinan='$pimpinan'";
	mysql_query($text);
	echo "Simpan Sukses";
}
?>

<?php
error_reporting(0);
include '../../koneksi1.php';

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tgl_lahir = date('Y-m-d',strtotime($_POST['tgl_lahir']));
$alamat = $_POST['alamat'];
$jkl = $_POST['jkl'];
$agama = $_POST['agama'];
$nohp = $_POST['nohp'];
$nik = $_POST['nik'];
$npwp = $_POST['npwp'];
$no_sim = $_POST['no_sim'];
$tgl_sim = date('Y-m-d',strtotime($_POST['tgl_sim']));
$jenis_sim = $_POST['jenis_sim'];
$aktif = $_POST['aktif'];
$noplat = $_POST['noplat'];
$kawin = $_POST['kawin'];
$pendidikan = $_POST['pendidikan'];
$row = mysql_num_rows(mysql_query("SELECT * FROM master_sopir WHERE kode='$kode'"));
if($row>0){
	$text = "UPDATE master_sopir SET nama='$nama',
									alamat='$alamat',
									tempat_lahir='$tempat_lahir',
									tgl_lahir = '$tgl_lahir',
									jkl='$jkl',
									kawin = '$kawin',
									agama='$agama',
									nohp='$nohp',
									nik='$nik',
									npwp='$npwp',
									no_sim='$no_sim',
									tgl_sim='$tgl_sim',
									jenis_sim='$jenis_sim',
									noplat='$noplat',
									pendidikan = '$pendidikan',
									aktif = '$aktif' WHERE kode='$kode'";
	mysql_query($text);
	echo "Update Sukses";
}else{
	$text = "INSERT INTO master_sopir SET kode='$kode',
								nama='$nama',
								alamat='$alamat',
								tempat_lahir='$tempat_lahir',
								tgl_lahir = '$tgl_lahir',
								jkl='$jkl',
								kawin = '$kawin',
								agama='$agama',
								nohp='$nohp',
								nik='$nik',
								npwp='$npwp',
								no_sim='$no_sim',
								tgl_sim='$tgl_sim',
								jenis_sim='$jenis_sim',
								noplat='$noplat',
								pendidikan = '$pendidikan',
								aktif = '$aktif'";
	mysql_query($text);
	echo "Simpan Sukses";
}
?>

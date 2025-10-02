<?php
error_reporting(0);
include '../../koneksi1.php';

$kode_anggota = $_POST['kode_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$pekerjaan = $_POST['pekerjaan'];
$alamat_anggota = $_POST['alamat_anggota'];
$tempat_lahir = $_POST['tempat_lahir'];
$telp = $_POST['telp'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tgl_masuk = date('Y-m-d',strtotime($_POST['tgl_masuk']));
$tgl_alhir = date('Y-m-d',strtotime($_POST['tgl_lahir']));
$aktif= $_POST['aktif'];


$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_anggota WHERE kode_anggota='$kode_anggota'"));
if($row>0){
	$text = "UPDATE t_anggota SET nama_anggota='$nama_anggota',
								alamat_anggota='$alamat_anggota',
								jenis_kelamin='$jenis_kelamin',
								pekerjaan='$pekerjaan',
								tgl_masuk='$tgl_masuk',
								telp='$telp',
								tempat_lahir='$tempat_lahir',
								tgl_lahir='$tgl_lahir',
								status='$aktif'
			WHERE kode_anggota='$kode_anggota'";
	mysqli_query($koneksi,$text);
	echo "Update Sukses";
}else{
	$text = "INSERT INTO t_anggota SET kode_anggota='$kode_anggota',
								nama_anggota='$nama_anggota',
								alamat_anggota='$alamat_anggota',
								jenis_kelamin='$jenis_kelamin',
								pekerjaan='$pekerjaan',
								tgl_masuk='$tgl_masuk',
								telp='$telp',
								tempat_lahir='$tempat_lahir',
								tgl_lahir='$tgl_lahir',
								status='Y'";
	mysqli_query($koneksi,$text);
	echo "Simpan Sukses";
}
?>

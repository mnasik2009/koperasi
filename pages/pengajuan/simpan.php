<?php
error_reporting(0);
include '../../koneksi1.php';
session_start();

$kode_pengajuan = $_POST['kode_pengajuan'];
$kode_anggota = $_POST['kode_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$kode_jenis_pinjam = $_POST['kode_jenis_pinjam'];
//$maks_pinjam = $_POST['maks_pinjam'];
$tgl_acc = date('Y-m-d',strtotime($_POST['tgl_acc']));
$tgl_pengajuan = date('Y-m-d',strtotime($_POST['tgl_pengajuan']));
$tgl_entri = date('Y-m-d');
$u_entri = $_SESSION['userid'];
$besar_pinjam = (float) str_replace(",", "", $_POST['maks_pinjam']);

$lama_angsuran = $_POST['lama_angsuran'];
$bunga = $_POST['bunga'];
$besar_angsuran = (($bunga * $lama_angsuran * $besar_pinjam) + $besar_pinjam)/$lama_angsuran;

$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_pengajuan WHERE kode_pengajuan='$kode_pengajuan'"));
if($row>0){
	$text = "UPDATE t_pengajuan SET besar_pinjam='$besar_pinjam',
								kode_jenis_pinjam = '$kode_jenis_pinjam',
								tgl_pengajuan='$tgl_pengajuan',
			WHERE kode_anggota='$kode_anggota' and kode_pengajuan='$kode_pengajuan'";
	mysqli_query($koneksi,$text);
	echo "Update Sukses";
}else{
	$text = "INSERT INTO t_pengajuan SET kode_anggota='$kode_anggota',
								besar_pinjam='$besar_pinjam',
								kode_jenis_pinjam = '$kode_jenis_pinjam',
								tgl_pengajuan='$tgl_pengajuan'";
	mysqli_query($koneksi,$text);
	echo "Simpan Sukses $kode_anggota";
}
?>

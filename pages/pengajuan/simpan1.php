<?php
error_reporting(0);
include '../../koneksi1.php';
session_start();

$kode_pengajuan = $_POST['kode_pengajuan'];
$kode_anggota = $_POST['kode_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$kode_jenis_pinjam = $_POST['kode_jenis_pinjam'];
$maks_pinjam = (float) str_replace(",", "", $_POST['maks_pinjam']);
$tgl_acc = date('Y-m-d',strtotime($_POST['tgl_acc']));
$tgl_pengajuan = date('Y-m-d',strtotime($_POST['tgl_pengajuan']));
$tgl_entri = date('Y-m-d');
$u_entry = $_SESSION['login_user'];
$besar_pinjam = (float) str_replace(",", "", $_POST['besar_pinjam']);
$ujroh = (float) str_replace(",", "", $_POST['ujroh']);
$a_utama = (float) str_replace(",", "", $_POST['angsuran1']);
$a_ujroh = (float) str_replace(",", "", $_POST['angsuran2']);
$tipe = $_POST['operasi'];
$lama_angsuran = $_POST['lama_angsuran'];
$bunga = $_POST['bunga'];
if ($tipe == 'depan'){
    $besar_angsuran = $a_utama;
}else{
    $besar_angsuran = $a_utama = $a_ujroh;
}

$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_pengajuan WHERE kode_pengajuan='$kode_pengajuan'"));
if($row>0){
	$text = "UPDATE t_pengajuan SET status ='diterima', tgl_acc='$tgl_entri', besar_pinjam='$besar_pinjam' WHERE kode_pengajuan='$kode_pengajuan'";
	mysqli_query($koneksi,$text);
	$text1 = "INSERT INTO t_pinjam SET kode_anggota='$kode_anggota',
								kode_jenis_pinjam = '$kode_jenis_pinjam',
								besar_pinjam='$besar_pinjam',
								besar_angsuran='$besar_angsuran',
								lama_angsuran='$lama_angsuran',
								tgl_entri='$tgl_entri',
								u_entry='$u_entry',
								status='belum lunas',
								ujroh='$ujroh'";
	mysqli_query($koneksi,$text1);
	echo "Update Sukses";
}else{
	echo "Tidak ada data yang disimpan";
}
?>

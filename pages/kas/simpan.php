<?php
error_reporting(0);
include '../../koneksi1.php';
session_start();

$notrans = $_POST['notrans'];
$keterangan = $_POST['keterangan'];
$penerima = $_POST['penerima'];
$debet = (float) str_replace(",", "",$_POST['debet']);
$kredit = (float) str_replace(",", "",$_POST['kredit']);
$tanggal = date('Y-m-d',strtotime($_POST['tanggal']));
$tgl_entri = date('Y-m-d');
$u_entry = $_SESSION['login_user'];

$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kas WHERE notrans='$notrans'"));
if($row>0){
	$text = "UPDATE kas SET kredit='$kredit',
								debet = '$debet',
								tanggal='$tanggal',
                                penerima='$penerima',
                                keterangan='$keterangan'
			WHERE notrans='$notrans'";
	mysqli_query($koneksi,$text);
	echo "Update Sukses";
}else{
	$text = "INSERT INTO kas SET keterangan = '$keterangan',
                                penerima = '$penerima',
								kredit = '$kredit',
								debet = '$debet',
								tanggal = '$tanggal',
								u_entry = '$u_entry',
								tgl_entri = '$tgl_entri'";
	mysqli_query($koneksi,$text);
	echo "Simpan Sukses";
}
?>

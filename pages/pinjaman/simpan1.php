<?php
error_reporting(0);
include '../../koneksi1.php';
session_start();

$kode_pinjam = $_POST['kode_pinjam'];
$kode_anggota = $_POST['kode_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$tgl_entri = date('Y-m-d');
$u_entry = $_SESSION['login_user'];
$besar_pinjam = (float) str_replace(",", "",$_POST['besar_pinjam']);
$besar_angsuran = (float) str_replace(",", "",$_POST['besar_angsuran']);
$sisa_angsuran = (float) str_replace(",", "",$_POST['sisa_angsuran']);
$bayar_via = $_POST['bayar_via'];


$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_pinjam WHERE kode_pinjam='$kode_pinjam'"));
if($row>0){
	$text = "UPDATE t_pinjam SET sisa_pinjaman = sisa_pinjaman + $besar_angsuran, sisa_angsuran=sisa_angsuran + 1 WHERE kode_pinjam='$kode_pinjam'";
	mysqli_query($koneksi,$text);
	if ($bayar_via == 'Kas'){
		$textkas = "insert into kas set keterangan='Pembayaran Angsuran Pinjaman $kode_pinjam an $nama_anggota', 
										penerima='$nama_anggota', 
										tanggal='$tgl_entri', 
										debet='$besar_angsuran', kredit=0, 
										tglentry = '$tgl_entri',
										kegiatan = '$kode_pinjam',
										userentry = '$u_entry'";
		mysqli_query($koneksi,$textkas); 
	}else{
		$textbank = "insert into bank set keterangan='Pembayaran Angsuran Pinjaman $kode_pinjam an $nama_anggota', 
										penerima='$nama_anggota', 
										tanggal='$tgl_entri', 
										debet='$besar_angsuran', kredit=0, 
										kegiatan = '$kode_pinjam',
										tglentry = '$tgl_entri',
										userentry = '$u_entry'";
		mysqli_query($koneksi,$textbank); 
	echo "Simpan Sukses";
}else{
	echo "Tidak ada data yang disimpan";
}
?>

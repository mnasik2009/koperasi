<?php
error_reporting(0);
session_start();
include '../../koneksi1.php';


$kode_simpan = $_POST['kode_simpan'];
$kode_anggota = $_POST['kode_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$s_wajib = $_POST['s_wajib'];
$s_pokok = $_POST['s_pokok'];
$cair_via = $_POST['bayar_via'];
$tgl_entri = date('Y-m-d',strtotime($_POST['tgl_entry']));
$u_entri = $_SESSION['login_user'];

$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_anggota WHERE kode_anggota='$kode_anggota'"));
if($row>0){
	if ($cair_via == 'tunai'){
		$textkas = "insert into kas set notrans='$kode_pinjam', 
										keterangan='Penaikan Dana an $nama_anggota keluar Koperasi', 
										penerima='$nama_anggota', 
										tanggal='$tgl_cair', 
										debet=0, kredit='$besar_pinjam', 
										tglentry = '$tgl_entri',
										kegiatan = 'keluar',
										userentry = '$u_entri'";
		mysqli_query($koneksi,$textkas); 
	}else{
		$textbank = "insert into bank set notrans='$kode_pinjam', 
										keterangan='Penaikan Dana an $nama_anggota keluar Koperasi', 
										penerima='$nama_anggota', 
										tanggal='$tgl_cair', 
										debet=0, kredit='$besar_pinjam', 
										kegiatan = 'keluar',
										tglentry = '$tgl_entri',
										userentry = '$u_entri'";
		mysqli_query($koneksi,$textbank); 
	}
	$text = "update t_anggota set status = 'keluar', u_entri = '$u_entri', tgl_entri = '$tgl_entri'
			WHERE kode_anggota='$kode_anggota'";
	mysqli_query($koneksi,$text);
}else{
	echo "Tidak Ada data yang disimpan";
}
?>

<?php
error_reporting(0);
include '../../koneksi1.php';
session_start();

$kode_simpan = $_POST['kode_simpan'];
$kode_anggota = $_POST['kode_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$jenis_simpan = $_POST['jenis_simpan'];
$besar_simpanan = $_POST['besar_simpanan'];
$tgl_mulai = date('Y-m-d',strtotime($_POST['tgl_mulai']));
$tgl_entri = date('Y-m-d');
$u_entry = $_SESSION['login_user'];

$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_simpan WHERE kode_simpan='$kode_simpan'"));
if($row>0){
	$text = "UPDATE t_simpan SET besar_simpanan='$besar_simpanan',
								jenis_simpan = '$jenis_simpan',
								tgl_mulai='$tgl_mulai'
			WHERE kode_anggota='$kode_anggota' and kode_simpan='$kode_simpan'";
	mysqli_query($koneksi,$text);
	echo "Update Sukses";
}else{
	if ($cair_via == 'tunai'){
		$textkas = "insert into kas set notrans='$kode_simpan', 
										keterangan='Penaikan Dana an $nama_anggota keluar Koperasi', 
										penerima='$nama_anggota', 
										tanggal='$tgl_cair', 
										debet=0, kredit='$besar_pinjam', 
										tglentry = '$tgl_entri',
										kegiatan = '$kode_simpan',
										userentry = '$u_entri'";
		mysqli_query($koneksi,$textkas); 
	}else{
		$textbank = "insert into bank set notrans='$kode_simpan', 
										keterangan='Penaikan Dana an $nama_anggota keluar Koperasi', 
										penerima='$nama_anggota', 
										tanggal='$tgl_cair', 
										debet=0, kredit='$besar_pinjam', 
										kegiatan = '$kode_simpan',
										tglentry = '$tgl_entri',
										userentry = '$u_entri'";
		mysqli_query($koneksi,$textbank); 
	}
	$text = "INSERT INTO t_simpan SET kode_anggota = '$kode_anggota',
								besar_simpanan = '$besar_simpanan',
								jenis_simpan = '$jenis_simpan',
								tgl_mulai = '$tgl_mulai',
								u_entry = '$u_entry',
								tgl_entri = '$tgl_entri'";
	mysqli_query($koneksi,$text);
	echo "Simpan Sukses";
}
?>

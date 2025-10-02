<?php
error_reporting(0);
include '../../koneksi1.php';
session_start();

$kode_pinjam = $_POST['kode_pinjam'];
$kode_anggota = $_POST['kode_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$besar_pinjam = (float) str_replace(",", "", $_POST['besar_pinjam']);
$tgl_cair = date('Y-m-d',strtotime($_POST['tgl_cair']));
$tgl_entri = date('Y-m-d');
$u_entri = $_SESSION['login_user'];
$status_cair = 'lunas';
$cair_via = $_POST['cair_via'];
$ujroh = (float) str_replace(",", "", $_POST['ujroh']);
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_pinjam WHERE kode_pinjam='$kode_pinjam'"));
if($row>0){
	$text = "UPDATE t_pinjam SET status_cair='lunas',
								cair_via = '$cair_via',
								tgl_cair='$tgl_cair'
			WHERE kode_pinjam='$kode_pinjam'";
	mysqli_query($koneksi,$text);
	if ($cair_via == 'Kas'){
		$textkas = "insert into kas set notrans='$kode_pinjam', 
										keterangan='Pencairan Pinjaman $kode_pinjam an $nama_anggota', 
										penerima='$nama_anggota', 
										tanggal='$tgl_cair', 
										debet=0, kredit='$besar_pinjam', 
										tglentry = '$tgl_entri',
										userentry = '$u_entri'";
		mysqli_query($koneksi,$textkas); 
	}else{
		$textbank = "insert into bank set notrans='$kode_pinjam', 
										keterangan='Pencairan Pinjaman $kode_pinjam an $nama_anggota', 
										penerima='$nama_anggota', 
										tanggal='$tgl_cair', 
										debet=0, kredit='$besar_pinjam', 
										tglentry = '$tgl_entri',
										userentry = '$u_entri'";
		mysqli_query($koneksi,$textbank); 
	}
	$txtujroh = "insert into ujroh set notrans='$kode_pinjam', 
									keterangan='Penerimaan Ujroh Pinjaman $kode_pinjam an $nama_anggota', 
									penerima='$cair_via', 
									tanggal='$tgl_cair', 
									debet='$ujroh', kredit='0', 
									tglentry = '$tgl_entri',
									userentry = '$u_entri'";
	mysqli_query($koneksi,$txtujroh); 		

	echo "Pencairan Sukses";
}else{
	echo "Tidak Ada data yang disimpan";
}
?>

<?php
error_reporting(0);
session_start();
include '../../koneksi1.php';

$username = $_SESSION['username'];
$tgltrans = $_POST['tgltrans'];
$notrans = $_POST['notrans'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];


$format1 = date('Y-m-d', strtotime($tgltrans));
$tglinput = date('Y-m-d');
$nomor = mysql_query("select max(substr(notrans,-6)) as noref from gaji_transaksi where year(tgltrans)='$tahun'");

$data1 = mysql_fetch_array($nomor);
$idMax = $data1['noref'];
$idMax++;
$newID = 'SLR-'.$tahun .$bulan . sprintf('%06d',$idMax);

$row = mysql_num_rows(mysql_query("SELECT * FROM gaji_transaksi WHERE notrans='$notrans'"));
if($row>0){
	echo "Data Sudah Ada silahkan proses bulan lain";
}else{
  $dt1 = mysql_query("select * from master_sopir");
  while($data=mysql_fetch_array($dt1))
  {
    $kode = $data['kode'];
    $ambilg = mysql_fetch_array(mysql_query("select * from gaji_master where kode='$kode'"));
    $ambilr = mysql_fetch_array(mysql_query("select * from absen_r, absen_m where absen_r.notrans = absen_m.notrans
							and nik='$kode' and bulan='$bulan' and tahun='$tahun'"));
    $gapok = $ambilg['gapok'];
    $komunikasi = $ambilg['komunikasi'];
    $uang_hadir = $ambilg['uang_hadir'];
		$transpor = $ambilg['transportasi'];
		$uang_lembur = $ambilg['u_lembur'];
		$jlembur = $ambilr['lembur'];
    $hadir = $ambilr['hadir'];
    $alpha = $ambilr['alpha'];
    $sakit = $ambilr['sakit'];
    $cuti = $ambilr['cuti'];
    $lk = $ambilr['luar'];
		$noket = $ambilr['notrans'];
    $jumlah = $hadir - $lk;
    $uhadir = $jumlah * $uang_hadir;
		$ulembur = $jlembur * $uang_lembur;
    $text = "INSERT INTO gaji_transaksi (notrans,tgltrans,nik,bulan,tahun,gapok,komunikasi,uang_hadir,transportasi,ulembur,
      jml_hadir,jml_lk,jml_sakit,jml_cuti,jml_alpha,tglinput,userid,keterangan)
			VALUES ('$newID','$format1','$kode','$bulan','$tahun','$gapok','$komunikasi','$uhadir','$transpor','$ulembur',
        '$hadir','$lk','$sakit','$cuti','$alpha','$tglinput','$username','$noket')";
	mysql_query($text);
  }
	echo "Simpan Sukses " .$newID;
}
?>

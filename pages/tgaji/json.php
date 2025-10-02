<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'notrans';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$cari = isset($_POST['cari']) ? mysql_real_escape_string($_POST['cari']) : '';

$offset = ($page-1) * $rows;

$where = " WHERE notrans LIKE '%$cari%' or nik like '%$cari%'";

$text = "SELECT * FROM gaji_transaksi
	$where
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysql_num_rows(mysql_query("SELECT * FROM gaji_transaksi $where"));
$row = array();

$criteria = mysql_query($text);
while($data=mysql_fetch_array($criteria))
{
	$nik = $data['nik'];
	$dnama = mysql_fetch_array(mysql_query("select * from master_sopir where kode='$nik'"));
	$row[] = array(
		'notrans'=>$data['notrans'],
		'nik'=>$data['nik'],
		'nama'=>$dnama['nama'],
		'tgltrans'=>date('m/d/Y',strtotime($data['tgltrans'])),
		'bulan'=>$data['bulan'],
		'tahun'=>$data['tahun'],
    'gapok'=>$data['gapok'],
		'uang_hadir'=>$data['uang_hadir'],
    'komunikasi'=>$data['komunikasi'],
    'bjps_ksh'=>$data['bpjs_ksh'],
    'bpjs_tnk'=>$data['bpjs_tnk'],
    'pph21'=>$data['pph21'],
    'potlain'=>$data['pot_lain'],
		'jml_lk'=>$data['jml_lk'],
		'idn'=>$data['idn'],
		'keterangan'=>$data['keterangan'],
		'transportasi'=>$data['transportasi'],
		'ulembur'=>$data['ulembur'],
		'tlembur'=>$data['tlembur'],
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

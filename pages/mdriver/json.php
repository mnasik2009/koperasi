<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$cari = isset($_POST['cari']) ? mysql_real_escape_string($_POST['cari']) : '';

$offset = ($page-1) * $rows;

$where = " WHERE kode LIKE '%$cari%' OR nama LIKE '%$cari%' ";

$text = "SELECT * FROM master_sopir
	$where
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysql_num_rows(mysql_query("SELECT * FROM master_sopir $where"));
$row = array();

$criteria = mysql_query($text);
while($data=mysql_fetch_array($criteria))
{
	$row[] = array(
		'kode'=>$data['kode'],
		'nama'=>$data['nama'],
		'alamat'=>$data['alamat'],
		'agama'=>$data['agama'],
		'tempat_lahir'=>$data['tempat_lahir'],
		'tgl_lahir'=>$data['tgl_lahir'],
		'nohp'=>$data['nohp'],
		'jkl'=>$data['jkl'],
		'nik'=>$data['nik'],
		'npwp'=>$data['npwp'],
		'no_sim'=>$data['no_sim'],
		'tgl_sim'=>date('m/d/Y',strtotime($data['tgl_sim'])),
		'aktif'=>$data['aktif'],
		'noplat'=>$data['noplat'],
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

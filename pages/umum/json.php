<?php
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$cari = isset($_POST['cari']) ? mysql_real_escape_string($_POST['cari']) : '';

$offset = ($page-1) * $rows;

$where = " WHERE kode LIKE '%$cari%' OR nama LIKE '%$cari%' ";

$text = "SELECT * FROM globalset
	$where
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysql_num_rows(mysql_query("SELECT * FROM globalset $where"));
$row = array();

$criteria = mysql_query($text);
while($data=mysql_fetch_array($criteria))
{
	$row[] = array(
		'kode'=>$data['kode'],
		'nama'=>$data['nama'],
		'alamat'=>$data['alamat'],
		'kota'=>$data['kota'],
		'pimpinan'=>$data['pimpinan'],
		'norek'=>$data['norek'],
		'bank'=>$data['bank'],
		'pemilikrek'=>$data['pemilikrek'],
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

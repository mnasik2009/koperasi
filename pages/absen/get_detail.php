<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'jam1';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$cari = isset($_POST['cari']) ? mysql_real_escape_string($_POST['cari']) : '';

$offset = ($page-1) * $rows;

$where = " WHERE notrans LIKE '%$cari%'";

$text = "SELECT * from absen_d
	$where
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysql_num_rows(mysql_query("SELECT * from absen_d $where"));
$row = array();

$criteria = mysql_query($text);
while($data=mysql_fetch_array($criteria))
{
  $nik = $data['nik'];
  $cd = mysql_fetch_array(mysql_query("select * from master_sopir where kode='$nik'"));
	$row[] = array(
		'notrans'=>$data['notrans'],
		'nik'=>$data['nik'],
    'nama'=>$cd['nama'],
		'jam1'=>$data['jam1'],
		'jam2'=>$data['jam2'],
		'tanggal'=>$data['tanggal'],
		'catat'=>$data['catat'],
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);

?>

<?php
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$aktif = $_POST['aktif'];

$offset = ($page-1) * $rows;
$panjangi = strlen($noinv);

$text = "SELECT * from master_sopir where aktif='Y'
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysql_num_rows(mysql_query("SELECT * from master_sopir where aktif='Y'"));
$row = array();

$criteria = mysql_query($text);
while($data=mysql_fetch_array($criteria))
{

	$row[] = array(
		'kode'=>$data['kode'],
		'nama'=>$data['nama'],
		'bulan'=>$data['bulan'],
		'tahun'=>$data['tahun'],
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);

?>

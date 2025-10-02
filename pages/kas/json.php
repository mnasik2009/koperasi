<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tanggal';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$cari = $_POST['cari'];

$offset = ($page-1) * $rows;

$where = " where keterangan LIKE '%$cari%' ";

$text = "SELECT * from kas
	$where
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT * from kas $where"));
$row = array();

$criteria = mysqli_query($koneksi,$text);
while($data=mysqli_fetch_array($criteria))
{	
	$row[] = array(
		'notrans'=>$data['notrans'],
		'keterangan'=>$data['keterangan'],
		'penerima'=>$data['penerima'],
		'tanggal'=>date('m/d/Y',strtotime($data['tanggal'])),
		'debet'=>number_format($data['debet']),
		'kredit'=>number_format($data['kredit']),
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

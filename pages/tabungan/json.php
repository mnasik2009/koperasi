<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode_anggota';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$cari = $_POST['cari'];

$offset = ($page-1) * $rows;

$where = " WHERE kode_anggota LIKE '%$cari%' OR nama_anggota LIKE '%$cari%' ";

$text = "SELECT * FROM t_anggota
	$where
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM t_anggota $where"));
$row = array();

$criteria = mysqli_query($koneksi,$text);
while($data=mysqli_fetch_array($criteria))
{
	$kode = $data['kode_anggota'];
	$dtwajib = mysqli_fetch_array(mysqli_query($koneksi,"select sum(besar_simpanan) as wajib from t_simpan where kode_anggota='$kode' and jenis_simpan='wajib'"));
	$dtpokok = mysqli_fetch_array(mysqli_query($koneksi,"select sum(besar_simpanan) as pokok from t_simpan where kode_anggota='$kode' and jenis_simpan='pokok'"));
	
	$row[] = array(
		'kode_anggota'=>$data['kode_anggota'],
		'nama_anggota'=>$data['nama_anggota'],
		's_pokok'=>number_format($dtpokok['pokok']),
		's_wajib'=>number_format($dtwajib['wajib']),
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

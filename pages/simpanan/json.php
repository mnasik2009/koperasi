<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tgl_mulai';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$cari = $_POST['cari'];

$offset = ($page-1) * $rows;

$where = " where t_anggota.kode_anggota = t_simpan.kode_anggota AND (kode_anggota LIKE '%$cari%' OR nama_anggota LIKE '%$cari%' or t_simpan.kode_simpan like '%$cari%') ";

$text = "SELECT t_anggota.*, t_simpan.jenis_simpan, t_simpan.besar_simpanan, t_simpan.kode_simpan, t_simpan.tgl_mulai
	FROM t_anggota, t_simpan
	where t_anggota.kode_anggota = t_simpan.kode_anggota
	and (nama_anggota like '%$cari%'
	or kode_simpan like '%$cari%')
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT t_anggota.*, t_simpan.jenis_simpan, t_simpan.besar_simpanan, t_simpan.kode_simpan, t_simpan.tgl_mulai 
	FROM t_anggota, t_simpan
	where t_anggota.kode_anggota = t_simpan.kode_anggota
	and nama_anggota like '%$cari%'"));
$row = array();

$criteria = mysqli_query($koneksi,$text);
while($data=mysqli_fetch_array($criteria))
{	
	$row[] = array(
		'kode_anggota'=>$data['kode_anggota'],
		'kode_simpan'=>$data['kode_simpan'],
		'nama_anggota'=>$data['nama_anggota'],
		'besar_simpanan'=>number_format($data['besar_simpanan']),
		'jenis_simpan'=>$data['jenis_simpan'],
		'tgl_mulai'=>date('m/d/Y',strtotime($data['tgl_mulai'])),
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

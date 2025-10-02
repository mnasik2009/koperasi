<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode_anggota';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$cari = $_POST['cari'];

$offset = ($page-1) * $rows;

$where = " where t_anggota.kode_anggota = t_pengajuan.kode_anggota AND (kode_anggota LIKE '%$cari%' OR nama_anggota LIKE '%$cari%') ";

$text = "SELECT t_anggota.*, t_pengajuan.kode_jenis_pinjam, t_pengajuan.besar_pinjam, t_pengajuan.kode_pengajuan, t_pengajuan.tgl_acc, t_pengajuan.tgl_pengajuan, t_pengajuan.status 
	FROM t_anggota, t_pengajuan
	where t_anggota.kode_anggota = t_pengajuan.kode_anggota
	and nama_anggota like '%$cari%'
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT t_anggota.*, t_pengajuan.kode_jenis_pinjam, t_pengajuan.besar_pinjam, t_pengajuan.kode_pengajuan, t_pengajuan.tgl_acc 
	FROM t_anggota, t_pengajuan
	where t_anggota.kode_anggota = t_pengajuan.kode_anggota
	and nama_anggota like '%$cari%'"));
$row = array();

$criteria = mysqli_query($koneksi,$text);
while($data=mysqli_fetch_array($criteria))
{	
	$row[] = array(
		'kode_anggota'=>$data['kode_anggota'],
		'kode_pengajuan'=>$data['kode_pengajuan'],
		'status'=>$data['status'],
		'nama_anggota'=>$data['nama_anggota'],
		'besar_pinjam'=>number_format($data['besar_pinjam']),
		'besar_angsuran'=>number_format($data['besar_angsuran']),
		'kode_jenis_pinjam'=>$data['kode_jenis_pinjam'],
		'tgl_acc'=>date('m/d/Y',strtotime($data['tgl_acc'])),
		'tgl_pengajuan'=>date('m/d/Y',strtotime($data['tgl_pengajuan'])),
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

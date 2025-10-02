<?php
error_reporting(0);
include '../../koneksi1.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode_anggota';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$cari = $_POST['cari'];

$offset = ($page-1) * $rows;

$where = " where t_anggota.kode_anggota = t_pinjam.kode_anggota AND (kode_anggota LIKE '%$cari%' OR nama_anggota LIKE '%$cari%') ";

$text = "SELECT t_anggota.*, t_pinjam.kode_jenis_pinjam, t_pinjam.besar_pinjam, t_pinjam.kode_pinjam, t_pinjam.tgl_entri, 
	t_pinjam.lama_angsuran, t_pinjam.ujroh, t_pinjam.sisa_angsuran, t_pinjam.status, t_pinjam.status_cair, t_pinjam.cair_via, t_pinjam.sisa_angsuran,
	t_pinjam.besar_angsuran, t_pinjam.lama_angsuran, DATE_ADD(t_pinjam.tgl_entri, INTERVAL t_pinjam.lama_angsuran MONTH) AS tgl_tempo 
	FROM t_anggota, t_pinjam
	where t_anggota.kode_anggota = t_pinjam.kode_anggota
	and nama_anggota like '%$cari%'
	ORDER BY $sort $order
	LIMIT $rows OFFSET $offset";

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT t_anggota.*, t_pinjam.kode_jenis_pinjam, t_pinjam.besar_pinjam, t_pinjam.kode_pinjam, t_pinjam.tgl_entri, t_pinjam.lama_angsuran, t_pinjam.ujroh, t_pinjam.sisa_angsuran, t_pinjam.status_cair, t_pinjam.cair_via 
	FROM t_anggota, t_pinjam
	where t_anggota.kode_anggota = t_pinjam.kode_anggota
	and nama_anggota like '%$cari%'"));
$row = array();

$criteria = mysqli_query($koneksi,$text);
while($data=mysqli_fetch_array($criteria))
{	
	$row[] = array(
		'kode_anggota'=>$data['kode_anggota'],
		'kode_pinjam'=>$data['kode_pinjam'],
		'status'=>$data['status'],
		'nama_anggota'=>$data['nama_anggota'],
		'besar_pinjam'=>number_format($data['besar_pinjam']),
		'besar_angsuran'=>number_format($data['besar_angsuran']),
		'kode_jenis_pinjam'=>$data['kode_jenis_pinjam'],
		'sisa_angsuran'=>$data['lama_angsuran'] - $data['sisa_angsuran'],
		'sisa_pinjaman'=>number_format($data['besar_pinjam'] - $data['sisa_pinjaman']),
		'ujroh'=>number_format($data['ujroh']),
		'status_cair'=>$data['status_cair'],
		'cair_via'=>$data['cair_via'],
		'tgl_entri'=>date('m/d/Y',strtotime($data['tgl_entri'])),
		'tgl_tempo'=>date('m/d/Y',strtotime($data['tgl_tempo'])),
	);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>

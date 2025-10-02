<?php
error_reporting(0);
include '../../koneksi1.php';
$q = isset($_POST['q']) ? strval($_POST['q']) : '';  
  
$arr_data=array();
$sql="SELECT * from t_anggota where kode_anggota like '%$q%' or nama_anggota like '%$q%'";
$result = mysqli_query($koneksi, $sql);
while($obj = mysqli_fetch_object($result)) {
 $arr_data[]=array("kode_anggota"=>$obj->kode_anggota,"nama_anggota"=>$obj->nama_anggota);
}

echo json_encode($arr_data);
?>

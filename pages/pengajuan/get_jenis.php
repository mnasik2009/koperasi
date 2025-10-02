<?php
error_reporting(0);
include '../../koneksi1.php';
$q = isset($_POST['q']) ? strval($_POST['q']) : '';  
  
$arr_data=array();
$sql="SELECT * from t_jenis_pinjam where kode_jenis_pinjam like '%$q%' or nama_pinjaman like '%$q%'";
$result = mysqli_query($koneksi, $sql);
while($obj = mysqli_fetch_object($result)) {
 $arr_data[]=array("kode_jenis_pinjam"=>$obj->kode_jenis_pinjam,
                    "nama_pinjaman"=>$obj->nama_pinjaman,
                    "maks_pinjam"=>$obj->maks_pinjam,
                    "bunga"=>$obj->bunga,
                    "lama_angsuran"=>$obj->lama_angsuran);
}

echo json_encode($arr_data);
?>

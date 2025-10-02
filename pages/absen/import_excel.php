<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../easyui/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../easyui/themes/icon.css">
    <script type="text/javascript" src="../../easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../../easyui/jquery.easyui.min.js"></script>
<?php
//koneksi ke database, username,password  dan namadatabase menyesuaikan
include "../../koneksi1.php";
//memanggil file excel_reader
require "../../Classes/excel_reader.php";
$kode = substr($_GET['notrans'],0,16);
$tgl = substr($_GET['notrans'],-10);
if(isset($_POST['submit'])){
$flagg = $_POST['tanda'];
$notrans = $_POST['notrans'];
$tgltrans = $_POST['tgl'];
$target = basename($_FILES['namafile']['name']) ;
move_uploaded_file($_FILES['namafile']['tmp_name'], $target);
$tglinput = date('Y-m-d');

	$data = new Spreadsheet_Excel_Reader($_FILES['namafile']['name'],false);


//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
    if($drop == 1){
//             kosongkan tabel pegawai
             $truncate ="DELETE FROM absen_d where notrans='$notrans' and tanggal='$tgltrans'";
             mysql_query($truncate);
    };
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
      $nik	    = trim($data->val($i, 1));
      $nama   	= $data->val($i, 2);
      $tanggal  = $data->val($i, 3);
		  $jam1	    = $data->val($i, 4);
		  $jam2			= $data->val($i, 5);
		  $catat		= $data->val($i, 6);
//      setelah data dibaca, masukkan ke tabel pegawai sql
			$hari = date('l',strtotime($tanggal));
			if ($hari == 'Saturday'){
				$tetap = '15.30';
			}else{
				$tetap = '17.30';
			}
			$ot = $jam2 - $tetap;

			if ($catat == 'H'){
				$ha = 1;
				$ij = 0;
				$cu = 0;
				$sa = 0;
				$lk = 0;
				$al = 0;
				$tl = 0;
				$lm = $ot;
			}elseif ($catat == 'L'){
				$ha = 1;
				$ij = 0;
				$cu = 0;
				$sa = 0;
				$lk = 1;
				$al = 0;
				$tl = 0;
				$lm = 0;
			}elseif ($catat == 'C'){
				$ha = 0;
				$ij = 0;
				$cu = 1;
				$sa = 0;
				$lk = 0;
				$al = 0;
				$tl = 0;
				$lm = 0;
			}elseif ($catat == 'S'){
				$ha = 0;
				$ij = 0;
				$cu = 0;
				$sa = 1;
				$lk = 0;
				$al = 0;
				$tl = 0;
				$lm = 0;
			}elseif ($catat == 'I'){
				$ha = 0;
				$ij = 1;
				$cu = 0;
				$sa = 0;
				$lk = 0;
				$al = 0;
				$tl = 0;
				$lm = 0;
			}elseif ($catat == 'A'){
				$ha = 0;
				$ij = 0;
				$cu = 0;
				$sa = 0;
				$lk = 0;
				$al = 1;
				$tl = 0;
				$lm = 0;
			}elseif ($catat == 'T'){
				$ha = 0;
				$ij = 0;
				$cu = 0;
				$sa = 0;
				$lk = 0;
				$al = 0;
				$tl = 1;
				$lm = $ot;
			}
			$query = "INSERT INTO absen_d SET notrans='$notrans',
                tanggal='$tanggal',
								jam1='$jam1',
								jam2 = '$jam2',
								catat = '$catat',
								lembur = '$lm',
								nik = '$nik'";
    $hasil = mysql_query($query);
		$cari = mysql_num_rows(mysql_query("select * from absen_r where notrans='$notrans' and nik='$nik'"));
		if ( $cari > 0){
			$input = "update absen_r set hadir = hadir + $ha, sakit = sakit + $sa, cuti = cuti + $cu,
								luar = luar + $lk, alpha = alpha + $al, telat = telat + $tl, lembur = lembur + $lm where notrans = '$notrans' and nik='$nik'";
			mysql_query($input);
		}else{
			  $input = "insert into absen_r set notrans='$notrans',
						  hadir='$ha',
							sakit='$sa',
						  cuti = '$cu',
							luar='$lk',
						  alpha='$al',
							telat = '$tl',
							lembur = '$lm',
							nik='$nik'";
			  mysql_query($input);
			}
    }
    if(!$hasil){
//          jika import gagal
          die(mysql_error());
      }else{
//          jika impor berhasil
         echo "Data berhasil diimpor.";
    }

//    hapus file xls yang udah dibaca
    unlink($_FILES['namafile']['name']);

}
?>
<body>
    <div id="p" class="easyui-panel" title="Import Data" style="width:475px;height:350px;padding:10px;">
    <form name="myForm" id="myForm" method="post" action="import_excel.php" enctype="multipart/form-data">
		<div style="margin-bottom:20px">
				<input id="notrans" name="notrans" class="easyui-textbox" label="No Transaksi:" value="<?php echo $kode; ?>" labelPosition="top" data-options="prompt:'Choose a file...'" style="width:100%">
		</div>
		<div style="margin-bottom:20px">
				<input id="tgl" name="tgl" class="easyui-textbox" label="Tanggal:" value="<?php echo $tgl; ?>" labelPosition="top" data-options="prompt:'Choose a file...'" style="width:100%">
		</div>
		<div style="margin-bottom:20px">
				<input id="namafile" name="namafile" class="easyui-filebox" label="Filename:" labelPosition="top" data-options="prompt:'Choose a file...'" style="width:100%">
		</div>
		<br/>
		<label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
		<br/>
		<input type="submit" name="submit" value="Import" /><br/>

	</form>
    </div>
</body>
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('namafile', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
</html>

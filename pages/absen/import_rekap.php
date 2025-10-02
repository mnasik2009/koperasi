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
$notrans = $_GET['notrans'];
if(isset($_POST['submit'])){
$notrans1 = $_POST['notrans'];
$target = basename($_FILES['namafile']['name']) ;
move_uploaded_file($_FILES['namafile']['tmp_name'], $target);
$tglinput = date('Y-m-d');

	$data = new Spreadsheet_Excel_Reader($_FILES['namafile']['name'],false);


//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
    if($drop == 1){
//             kosongkan tabel pegawai
             $truncate ="DELETE FROM absen_r where notrans='$notrans1'";
             mysql_query($truncate);
    };
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
      $nik	    = $data->val($i, 1);
      $nama   	= $data->val($i, 2);
		  $hadir	  = $data->val($i, 3);
		  $alpha		= $data->val($i, 4);
		  $sakit		= $data->val($i, 5);
      $luar		  = $data->val($i, 6);
      $cuti		  = $data->val($i, 7);
//      setelah data dibaca, masukkan ke tabel pegawai sql

      $query = "INSERT INTO absen_r (notrans,nik,nama,hadir,sakit,alpha,luar,cuti,proses) VALUES ('$notrans1','$nik',
								'$nama','$hadir','$sakit','$alpha','$luar','$cuti','N')";
      $hasil = mysql_query($query);
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
    <form name="myForm" id="myForm" method="post" action="import_rekap.php" enctype="multipart/form-data">
		<div style="margin-bottom:20px">
				<input id="notrans" name="notrans" class="easyui-textbox" label="No Transaksi:" value="<?php echo $notrans; ?>" labelPosition="top" data-options="prompt:'Choose a file...'" style="width:100%">
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

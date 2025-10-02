<link href="../../style_doc.css" rel="stylesheet" type="text/css" />
<style>
#hedgehog { margin: 1em; }
/* Uniform margin of 1em on all four sides */

#hare { margin: 5% 20%; }
/* Top and bottom margins are each 10% of the containing box's width. Left and right margins are each 20% of the containing box's width. */

#shrew { margin: 10% inherit 30px; }
/* Top margin is 10% of the containing box's width. Left and right margins are inherited. Bottom margin is 30px */

#wildcat { margin: 0px 10px 10px 10px; }
/* Top margin is 10px. Right margin is 20px. Bottom margin is 30px. Left margin is 40px. */
</style>
<body class="#wildcat">
<?php
error_reporting(E_ALL);
include '../../koneksi1.php';
include '../../terbilang.php';
include '../../phpqrcode/qrlib.php';
 $notrans = $_POST['notrans'];
 $nik = $_POST['nik'];
 $ket = $_POST['keterangan'];
 $nama = $_POST['nama'];
 $potlain = $_POST['potlain'];
 $koperasi = $_POST['koperasi'];
 $tlembur = $_POST['tlembur'];
 $sql = "select * from gaji_transaksi where notrans='$notrans' and nik='$nik'";
 $result = mysql_query($sql);
 $reg = mysql_fetch_array($result);

 $datag = mysql_fetch_array(mysql_query("select * from gaji_master where kode='$nik'"));
 $gapok = $reg['gapok'];
 $tgltrans = $reg['tgltrans'];
 $bulan = $reg['bulan'];
 $tahun = $reg['tahun'];
 $uang_hadir = $reg['uang_hadir'];
 $ulembur = $reg['ulembur'];
 $komunikasi = $reg['komunikasi'];
 $transportasi = $reg['transportasi'];
 $bjps_ksh = $reg['bpjs_ksh'];
 $bpjs_tnk = $reg['bpjs_tnk'];
 $pph21 = $reg['pph21'];
 $jml_lk = $reg['jml_lk'];
 $jml_hadir = $reg['jml_hadir'];
 $ket = $reg['keterangan'];
 $hh = $jml_hadir - $jml_lk;
 $uh = $datag['uang_hadir'];
 $uang_hadir = $hh * $uh;
 $total = $gapok + $uang_hadir + $komunikasi + $ulembur + $transportasi + $tlembur;
 $grand = $gapok + $uang_hadir + $komunikasi + $ulembur + $transportasi + $tlembur - $pph21 - $potlain - $koperasi;
 $tempdir = "temp/";
 if (!file_exists($tempdir))
    mkdir($tempdir);
 $namafile = $notrans.'.png';
 $qua = 'H';
 $ukuran = 5;
 $padding = 0;
 QRCode::png($notrans.$nik,$tempdir.$namafile,$qua,$ukuran,$padding);
 $namaf = $tempdir.$namafile;

echo"<table width='100%' border='0'>
  <tr>
	<td rowspan='4' align='left'><img src='../../images/icon.png' width='74' height='74'></td>

    <td colspan='9' align=center><font size='6'><b>SLIP GAJI</b></font></td>
    <td rowspan='5' align='right' scope='col'><img src=".$namaf." width='74' height='74'> </td>
  </tr>
</table>
<br/>
<table width='100%' border='0'>
  <tr>
    <th align='left' scope='col'><font size='2'>NO. TRANSAKSI</font></th>
	<th align='left' scope='col'><font size='2'>: ".$notrans."</font></th>

  </tr>
  <tr>
    <th align='left' scope='col'><font size='2'>NIK / NAMA</font></th>
	<th align='left' scope='col'><font size='2'>: ".$nik." / ".$nama."</font></th>
  </tr>
  <tr>
    <th align='left' scope='col'><font size='2'>BULAN / TAHUN</font></th>
	<th align='left' scope='col'><font size='2'>: ".$bulan." / ".$tahun."</font></th>
  </tr>
  <tr>
	<th align='left' width='85' scope='col'><font size='2'>JUMLAH HADIR</font></th>
	<th align='left' width='85' scope='col'><font size='2'>: ".$jml_hadir."</font></th>
  </tr>
  <tr>
	<th align='left' width='150' scope='col'><font size='2'>LUAR KOTA</font></th>
	<th align='left' width='110' scope='col'><font size='2'>: ".$jml_lk."</font></th>
  </tr>
</table>
";

mysql_query("update gaji_transaksi set pot_lain='$potlain', koperasi ='$koperasi', tlembur='$tlembur', keterangan='$ket' where notrans='$notrans' and nik='$nik'");
?>
<title>Slip Gaji <?php echo $notrans; ?></title>
<br/>
 <br/>
 <table width='100%' border='1'>
							  <thead>
								  <tr>
									  <th height="30" scope="col" rowspan='2' width="10%" style="background-color:#F0F8FF"><font size='3'>No.</font></th>
									  <th height="30" scope="col" colspan='1' width="70%" style="background-color:#F0F8FF"><font size='3'><center>Keterangan</font></center></th>
									  <th height="30" scope="col" colspan='1' width="20%" style="background-color:#F0F8FF"><font size='3'>Jumlah</font> </th>
								  </tr>
							  </thead>
							  <tbody>
				<tr>
          <td height="20" ><center ><font size='2'><?php echo "01"; ?></font></center></td>
					<td height="20"><left ><font size='2'><?php echo "Gaji Pokok"; ?></font></center></td>
					<td align="right"><font size='2'><?php echo number_format($gapok); ?></font></td>
                </tr>
				<tr>
          <td height="20" ><center ><font size='2'><?php echo "02"; ?></font></center></td>
					<td height="20" ><left ><font size='2'><?php echo "Uang Kehadiran ( "; echo $hh; echo " x "; echo $uh; echo " )"; ?></font></center></td>
					<td align="right" ><font size='2'><?php echo number_format($uang_hadir); ?></font></td>
                </tr>
				<tr>
        <tr>
            <td height="20" ><center ><font size='2'><?php echo "03"; ?></font></center></td>
  					<td height="20" ><left ><font size='2'><?php echo "Uang Lembur"; ?></font></center></td>
  					<td align="right" ><font size='2'><?php echo number_format($ulembur); ?></font></td>
                  </tr>
  				<tr>
          <td height="20" ><center ><font size='2'><?php echo "04"; ?></font></center></td>
					<td height="20" ><left ><font size='2'><?php echo "Tunj. Komunikasi"; ?></font></center></td>
          <td align="right"><font size='2'><?php echo number_format($komunikasi); ?></font></td>
                </tr>
       <tr>
          <td height="20" ><center ><font size='2'><?php echo "05"; ?></font></center></td>
          <td height="20" ><left ><font size='2'><?php echo "Tunj. Lain"; ?></font></center></td>
          <td align="right"><font size='2'><?php echo number_format($transportasi); ?></font></td>
              </tr>
       <tr>
           <td height="20" ><center ><font size='2'><?php echo "06"; ?></font></center></td>
           <td height="20" ><left ><font size='2'><?php echo "Tambahan Lembur"; ?></font></center></td>
           <td align="right"><font size='2'><?php echo number_format($tlembur); ?></font></td>
            </tr>
			    <tr>
				<!--td align="left"></td -->
                <td colspan='2' align="center"><font size='2'>Jumlah Pendapatan</font></td>
                <!--td style="border:1" align="right"></td>
                <td style="border:1" align="right"></td-->
                <td style="border:1" align="right"><font size='3'><b>Rp. <?php echo number_format($total); ?></b></font><center>
				</center>
				</td>

              </tr>
     <tr>
       <td height="20" ><center ><font size='2'><?php echo "07"; ?></font></center></td>
       <td height="20" ><left ><font size='2'><?php echo "PPH Pasal 21"; ?></font></center></td>
       <td align="right"><font size='2'><?php echo number_format($pph21); ?></font></td>
           </tr>
    <tr>
      <td height="20" ><center ><font size='2'><?php echo "08"; ?></font></center></td>
      <td height="20" ><left ><font size='2'><?php echo "Koperasi"; ?></font></center></td>
      <td align="right"><font size='2'><?php echo number_format($koperasi); ?></font></td>
          </tr>
    <tr>
       <td height="20" ><center ><font size='2'><?php echo "09"; ?></font></center></td>
       <td height="20" ><left ><font size='2'><?php echo "Potongan Lain ("; echo $ket; echo ")"; ?></font></center></td>
       <td align="right"><font size='2'><?php echo number_format($potlain); ?></font></td>
           </tr>
  <tr>
 				<!--td align="left"></td -->
      <td colspan='2' align="center" style="background-color:#F0F8FF"><font size='2'>TOTAL</font></td>
                 <!--td style="border:1" align="right"></td>
                 <td style="border:1" align="right"></td-->
      <td align="right" style="background-color:#F0F8FF"><font size='3'><b>Rp. <?php echo number_format($grand); ?></b></font><center>
 				</center>
 			</td>
      </tr>
	</tbody>
</table>
      <br/>
<table>
  <tr>
    <td align='left' scope='col'><font size='3'><i>Terbilang : <?php echo Terbilang($grand); ?> Rupiah</i></font> </td>
  </tr>
</table>
<br/>
<table>
  <tr>
    <td align='left' scope='col'><font size='2'><i>Samarinda, <?php echo date('d-M-Y',strtotime($tgltrans)); ?></i></font> </td>
  </tr>
</table>
<br/><br><br/><br>
<table>
  <tr>
    <td align='left' scope='col'><font size='3'><i><?php echo $nama; ?></i></font> </td>
  </tr>
</table>
		</body>

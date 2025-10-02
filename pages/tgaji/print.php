<link href="../../style_doc.css" rel="stylesheet" type="text/css" />
<title>Lap Slip GAJI</title>
<?php
include '../../koneksi1.php';

$bulan = $_POST['bulan1'];
$tahun = $_POST['tahun1'];
	//modus tanggal

$sql = "select * from gaji_transaksi where bulan = '$bulan' and tahun='$tahun'";


$query = mysql_query($sql);

echo"<table width='100%' border='0'>
<tr>
    <td align='left'><img src='../../images/icon.png' width='74' height='74'></td>
  </tr>
    <br/>
<tr>
    <td colspan='9' align=center><font size='3'><b>REKAP GAJI : $bulan - $tahun</font> </b></td>
  </tr>

</table>
";
?>


<br/>
 <br/>
 <table width='100%' border='1'>
							  <thead>
								  <tr>
									  <th><font size='2'>No</th>
									  <th><font size='2'><center>No. Transaksi</center></font></th>
									  <th><font size='2'><center>NIK</center></font></th>
									  <th><font size='2'>Nama</font></th>
									  <th><font size='2'>Gaji Pokok</font></th>
									  <th><font size='2'>Tunj. Hadir</font></th>
									  <th><font size='2'>T. Komunikasi</font></th>
									  <th><font size='2'>PPH Ps.21</font></th>
                    <th><font size='2'>Pot Lain</font></th>
                    <th><font size='2'>Total</font></th>
                    <th><font size='2'>Hadir</font></th>
                    <th><font size='2'>Luar Kota</font></th>
								  </tr>
							  </thead>
							  <tbody>
							   <?php
				 $no = 0;
				 while ($d = mysql_fetch_array($query)){
				 $no++;
         $total = $d['gapok'] + $d['uang_hadir'] + $d['komunikasi'] + $d['transportasi'] - $d['pot_lain'] - $d['pph21'];
         $nik = $d['nik'];
         $dnm = mysql_fetch_array(mysql_query("select * from master_sopir where kode='$nik'"));
				//$umurqty=$d[umur]*$d[qty];
			  ?>
				<tr>
                <td><font size='2'><center><?php echo $no; ?></center></font></td>
                <td><font size='2'><center><?php echo "$d[notrans]"; ?></center></font></td>
								<td><font size='2'><?php echo "$d[nik]"; ?></font></td>
                <td><font size='2'><?php echo "$dnm[nama]"; ?></font></td>
                <td align="right"><font size='2'><?php echo number_format($d['gapok']); ?></font></td>
                <td align="right"><font size='2'><?php echo number_format($d['uang_hadir']); ?></font></td>
                <td align="right"><font size='2'><?php echo number_format($d['komunikasi']); ?></font></td>
                <td align="right"><font size='2'><?php echo number_format($d['pph21']); ?></font></td>
                <td align="right"><font size='2'><?php echo number_format($d['pot_lain']); ?></font></td>
                <td align="right"><font size='2'><?php echo number_format($total); ?></font></td>
                <td align="center"><font size='2'><?php echo number_format($d['jml_hadir']); ?></font></td>
                <td align="center"><font size='2'><?php echo number_format($d['jml_lk']); ?></font></td>
                </tr>

			   <?php
           $kom = $kom + $d['komunikasi'];
           $uh = $uh + $d['uang_hadir'];
           $gp = $gp + $d['gapok'];
           $pp21 = $pp21 + $d['pph21'];
           $pl = $pl + $d['pot_lain'];
			     $grand = $grand + $total;
			   } ?>
			    <tr>
				        <td style="background-color:#C0C0C0; border:none" colspan="" align="left"><font size='3'>Total</td>
                <td colspan='2' style="background-color:#C0C0C0; border:none" align="right"></td>
                <td style="background-color:#C0C0C0; border:none" align="right"></td>
                <td style="background-color:#C0C0C0; border:none" align="right"><font size='3'><?php echo number_format($gp); ?></td>
                <td style="background-color:#C0C0C0; border:none" align="right"><font size='3'><?php echo number_format($uh); ?></td>
                <td style="background-color:#C0C0C0; border:none" align="right"><font size='3'><?php echo number_format($kom); ?></td>
                <td style="background-color:#C0C0C0; border:none" align="right"><font size='3'><?php echo number_format($pp21); ?></td>
                <td style="background-color:#C0C0C0; border:none" align="right"><font size='3'><?php echo number_format($pl); ?></td>
                <td style="background-color:#C0C0C0; border:none" align="right"><font size='3'><?php echo number_format($grand); ?></td>
                <td colspan='2' style="background-color:#C0C0C0; border:none" align="right"></td>
              </tr>



							  </tbody>

						 </table>

<br/>
<br/>
</body>

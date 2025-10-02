<!--NAVIGASI MENU UTAMA-->

<div class="leftmenu">
  <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a href="dashboard.php"><span class="iconsweets-home"></span> Dashboard</a></li>

    <!--MENU GUDANG-->
    <?php
	if($_SESSION['login_hash']=="admin")
	{

?>

<li class="dropdown"><a href="#"><span class="icon-th-list"></span> Master</a>
      <ul>
		<li><a href="?cat=anggota&page=index"><span class="iconsweets-bag"></span>Anggota</a></li>
		<li><a href="?cat=tabungan&page=index"><span class="iconsweets-bag"></span>Tabungan</a></li>
		<li><a href="?cat=pengajuan&page=index"><span class="iconsweets-bag"></span>Pengajuan</a></li>
		<li><a href="?cat=pengajuan&page=approval"><span class="iconsweets-bag"></span>App Pengajuan</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-shopping-cart"></span> Transaksi</a>
      <ul>
		<li><a href="?cat=simpanan&page=index"><span class="iconsweets-key"></span>Simpanan</a></li>
    <li><a href="?cat=pinjaman&page=index"><span class="iconsweets-key"></span>Pinjaman</a></li-->
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="iconsweets-pricetag"></span> Laporan</a>
      <ul>
        <li><a href="?cat=rpinjam&page=index"><span class="iconsweets-paperclip"></span>Pinjaman</a></li>
		<li><a href="?cat=rangsur&page=index"><span class="iconsweets-paperclip"></span>Angsuran</a></li>
        <li><a href="?cat=ranggota&page=bkm"><span class="iconsweets-paperclip"></span>Anggota</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="iconsweets-print"></span> Keuangan</a>
      <ul>
        <li><a href="?cat=kas&page=index"><span class="iconsweets-lamp"></span>Kas</a></li>
		    <li><a href="?cat=bank&page=index"><span class="iconsweets-lamp"></span>Bank</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="iconsweets-pencil"></span> Setting</a>
      <ul>
        <li><a href="?cat=jurnal&page=closing"><span class="iconsweets-list"></span>Ubah Password</a></li>
    		<li><a href="?cat=tkapal&page=openbm"><span class="iconsweets-list"></span>Operator</a></li>
      </ul>
    </li>
    <li class="active"><a href="?cat=web&page=logout"><span class="iconsweets-track"></span> Logout</a>
      
			</li>
      </ul>
    </li>
     <!--MENU ADMIN-->
  <?php
	}
	?>
  </ul>
</div>
<!--leftmenu-->

</div>
<!--mainleft-->
<!-- END OF LEFT PANEL -->

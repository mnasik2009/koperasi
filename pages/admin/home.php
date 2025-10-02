<!--?php include "koneksi1.php";
$jdriver = mysqli_num_rows(mysqli_query($koneksi,"select * from master_sopir"));
?-->
<div class="row-fluid" align="center">
<ul class="thumbnails">
<li class="span2" background="green">
<div class="thumbnail">

                  <div class="caption">
					<a href="?cat=anggota&page=index">
					<img src="img/wo.png" width="100" height="100" align="center" border="0"/></a>
					<h3 align="center">Anggota</h3>
                  </div>
                </div>
</li>

<li class="span2" background="green">
<div class="thumbnail">

                  <div class="caption">
					<a href="?cat=simpanan&page=index">
					<img src="img/order.png" width="100" height="100" align="center" border="0"/></a>
					<h3 align="center">Simpanan</h3>
                  </div>
                </div>
</li>
<li class="span2" background="green">
<div class="thumbnail">

          <div class="caption">
					<a href="?cat=pengajuan&page=index">
					<img src="img/invoice.png" width="100" height="100" align="center" border="0"/></a>
					<h3 align="center">Pengajuan</h3>
                  </div>
                </div>
</li>
<li class="span2" background="green">
<div class="thumbnail">

          <div class="caption">
					<a href="?cat=pinjaman&page=index">
					<img src="img/payinv.png" width="100" height="100" align="center" border="0"/></a>
					<h3 align="center">Pinjaman</h3>
                  </div>
                </div>
</li>

<li class="span2" background="green">
<div class="thumbnail">

                  <div class="caption">
					<a href="?cat=kas&page=index">
					<img src="img/kalkulator.png" width="100" height="100" align="center" border="0"/></a>
					<h3 align="center">Kas</h3>
                  </div>
                </div>
</li>
<li class="span2" background="green">
<div class="thumbnail">

                  <div class="caption">
					<a href="?cat=bank&page=index">
					<img src="img/neraca.png" width="100" height="100" align="center" border="0"/></a>
					<h3 align="center">Bank</h3>
                  </div>
                </div>
</li>
</ul>
</div>

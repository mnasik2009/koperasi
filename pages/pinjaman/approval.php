<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Master Customer</title>
	<link rel="icon" type="image/png" href="../../images/icon.png">
	<link rel="stylesheet" type="text/css" href="../../themes/metrored/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../css/icon.css">
	<link rel="stylesheet" type="text/css" href="../../nasikin.css" />
	<script type="text/javascript" src="../../jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="../../jquery.easyui.min.js"></script>

<script type="text/javascript">
var url;
function save(){
	var kode_anggota = $("#kode_anggota").val();
	var string = $("#form").serialize();
	if(kode_anggota.length==0){
		$.messager.show({
			title:'Info',
			msg:'Maaf, kode_anggota tidak boleh kosong',
			timeout:2000,
			showType:'slide'
		});
		$("#kode_anggota").focus();
		return false();
	}

	$.ajax({
		type	: "POST",
		url		: "pages/pengajuan/simpan1.php",
		data	: string,
		success	: function(data){
			$.messager.show({
				title:'Info',
				msg:data, //'Password Tidak Boleh Kosong.',
				timeout:2000,
				showType:'slide'
			});
			$('#datagrid-crud').datagrid('reload');
		}
	});
}
function hapus(){
	var row = $('#datagrid-crud').datagrid('getSelected');
	if (row){
		$.messager.confirm('Confirm','Apakah Anda akan menghapus data ini ?',function(r){
			if (r){
				$.ajax({
					type	: "POST",
					url		: "pages/pengajuan/hapus.php",
					data	: 'id='+row.kode_pengajuan,
					success	: function(data){
						$.messager.show({
							title:'Info',
							msg:data, //'Password Tidak Boleh Kosong.',
							timeout:2000,
							showType:'slide'
						});
						$('#datagrid-crud').datagrid('reload');
					}
				});
			}
		});
	}
}
function approve(){
	var row = $('#datagrid-crud').datagrid('getSelected');
	if(row){
		$('#dialog-form').dialog('open').dialog('setTitle','Edit Data');
		$('#form').form('load',row);
	}
}

function fresh(){
	$('#datagrid-crud').datagrid('reload');
}
function doSearch(value){
	$('#datagrid-crud').datagrid('load',{
        cari: value
    });
}
$(function(){
    $('#kode_anggota').combogrid({
				panelWidth:800,
				url: 'pages/pengajuan/get_anggota.php?',
				idField:'kode_anggota',
				textField:'kode_anggota',
				mode:'remote',
				fitColumns:true,
			    columns:[[
			    {field:'kode_anggota',title:'kode'},
			    {field:'nama_anggota',title:'kode'},

			    ]],onClickRow:function(rowData){
			                                 var val = $('#kode_anggota').combogrid('grid').datagrid('getSelected');
											 $('#kode_anggota').textbox('setValue', val.kode_anggota);
											 $('#nama_anggota').textbox('setValue', val.nama_anggota);
			                                }
						});
    $('#kode_jenis_pinjam').combogrid({
				panelWidth:800,
				url: 'pages/pengajuan/get_jenis.php?',
				idField:'kode_jenis_pinjam',
				textField:'kode_jenis_pinjam',
				mode:'remote',
				fitColumns:true,
			    columns:[[
			    {field:'kode_jenis_pinjam',title:'kode'},
			    {field:'nama_pinjaman',title:'kode'},
			    {field:'lama_angsuran',title:'Lama'},
			    {field:'maks_pinjam',title:'Maksimal'},
			    {field:'bunga',title:'bunga'},

			    ]],onClickRow:function(rowData){
			                                 var val = $('#kode_jenis_pinjam').combogrid('grid').datagrid('getSelected');
											 $('#kode_jenis_pinjam').textbox('setValue', val.kode_jenis_pinjam);
											 $('#nama_pinjaman').textbox('setValue', val.nama_pinjaman);
											 $('#lama_angsuran').textbox('setValue', val.lama_angsuran);
											 $('#maks_pinjam').textbox('setValue', val.maks_pinjam);
											 $('#bunga').textbox('setValue', val.bunga);
			                                }
						});
					});
</script>
</head>
<body>


	<table id="datagrid-crud" title="Approval Pengajuan Pinjaman" class="easyui-datagrid" style="width:auto; height: auto;" url="pages/pengajuan/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'kode_anggota'" sortable="true">Kode Anggota</th>
            <th data-options="field:'nama_anggota'" sortable="true">Nama Anggota</th>
            <th data-options="field:'tgl_pengajuan'" sortable="true">Tgl Pengajuan</th>
            <th data-options="field:'kode_jenis_pinjam'">Jenis</th>
            <th data-options="field:'besar_pinjam'">Jumlah</th>
            <th data-options="field:'besar_angsuran'">Angusran</th>
			<th data-options="field:'tgl_acc'">Tgl Acc</th>
			<th data-options="field:'status'">Status</th>
			<th data-options="field:'kode_pengajuan'">Kode</th>
        </tr>
    </thead>
	</table>
    <div id="tb" style="padding:2px;height:30px;">
		<div style="float:left;">
			<!--a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">Tambah</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update()">Edit</a-->
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="approve()">Approve</a>
			<!--a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus()">Hapus</a-->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="fresh()">Refresh</a>
		</div>
		<div style="float:right;">
        	Pencarian <input id="cari" class="easyui-searchbox" data-options="prompt:'Cari kode_anggota / nama_anggota..',searcher:doSearch" style="width:200px"></input>
		</div>
	</div>

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:500px; height:550px; padding: 10px 20px" closed="true" buttons="#dialog-buttons">
	<form id="form" method="post" novalidate>
		<div class="form-item">
			<label for="tgl_pengajuan">Tgl Pengajuan</label>
			<input type="text" name="tgl_pengajuan" id="tgl_pengajuan" class="easyui-datebox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="type">Kode Anggota</label>
			<input type="text" name="kode_anggota" id="kode_anggota" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="nama_anggota">Nama Anggota</label>
			<input type="text" name="nama_anggota" id="nama_anggota" class="easyui-textbox" required="true" style="width:100%"  />
		</div>
		<div class="form-item">
			<label for="kode_jenis_pinjam">Jenis Pinjaman</label>
			<input type="text" name="kode_jenis_pinjam" id="kode_jenis_pinjam" class="easyui-textbox" required="true" style="width:100%"/>
		</div>
		<div class="form-item">
			<label for="nama_pinjaman">Nama Pinjaman</label>
			<input type="text" name="nama_pinjaman" id="nama_pinjaman" class="easyui-textbox" required="true" style="width:100%"/>
		</div>
		<div class="form-item">
			<label for="lama_angsuran">Lama Angsuran</label>
			<input type="text" name="lama_angsuran" id="lama_angsuran" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="maks_pinjam">Maksimal</label>
			<input type="text" name="maks_pinjam" id="maks_pinjam" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="besar_pinjam">Besar Pinjaman</label>
			<input type="text" name="besar_pinjam" id="besar_pinjam" class="easyui-textbox" required="true" style="width:100%" oninput="hitungAngsuran()"/>
		</div>
		<div class="form-item">
			<label for="bunga">Bunga</label>
			<input type="text" name="bunga" id="bunga" class="easyui-textbox" required="true" style="width:100%" />
		</div>

		<div class="form-item">
			<label for="operasi">Tipe Ujroh</label>
			<select type="text" name="operasi" id="operasi" class="easyui-combobox" required="true" style="width:80%" />
			<option value="depan">Ujorh Bayar di Depon</option>
			<option value="belakang">Ujroh Sama Angsuran</option></select>
			
                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="calculate()" style="width:19%" data-options="iconCls:'icon-ok'">Hitung</a>
		</div>
		<div class="form-item">
			<label for="ujroh">Ujroh</label>
			<input type="text" name="ujroh" id="ujroh" class="easyui-textbox" value="0" style="width:100%" />
		</div>
		<div id="angsuran" class="form-item">
			<label for="angsuran">Angsuran Utama / Ujroh</label>
            <input type="text" name="angsuran1" id="angsuran1" class="easyui-textbox" value="0" style="width:50%" />
            <input type="text" name="angsuran2" id="angsuran2" class="easyui-textbox" value="0" style="width:49%" />
		</div>
		<script type="text/javascript">
        /**
         * Fungsi yang dipanggil saat tombol "Calculate" ditekan.
         * Melakukan perkalian dan menampilkan hasilnya.
         */
        function calculate() {
            // 1. Validasi Formulir
            // Memastikan kedua field telah diisi sebelum melakukan perhitungan
            if (!$('#form').form('validate')) {
                // Jika validasi gagal, hentikan fungsi
                return;
            }

            // 2. Mengambil Nilai dari Field EasyUI
            // Gunakan metode .textbox('getValue') untuk mendapatkan nilai dari field EasyUI
            const angka1Str = $('#besar_pinjam').textbox('getValue');
            const angka2Str = $('#lama_angsuran').textbox('getValue');
            const angka3Str = $('#bunga').textbox('getValue');
            const dapatStr  = $('#operasi').textbox('getValue');

            // 3. Konversi ke Angka
            // Gunakan parseFloat agar bisa menangani angka desimal
            const angka1 = parseFloat(angka1Str);
            const angka2 = parseFloat(angka2Str);
            const angka3 = parseFloat(angka3Str);
            
            // 4. Perhitungan
            
                  const hasilPerkalian =  angka1/angka2;
                  const hasilPerkalian1 =  (angka1  * (angka3/100));
                  const hasilUjroh = (angka1 * angka2 * (angka3/100));

            // 5. Menampilkan Hasil
            // Gunakan metode .textbox('setValue') untuk mengatur nilai pada field EasyUI 'hasil'
            // Gunakan toLocaleString() untuk format angka yang lebih mudah dibaca
            $('#angsuran1').textbox('setValue', hasilPerkalian.toLocaleString('id-ID'));
            $('#angsuran2').textbox('setValue', hasilPerkalian1.toLocaleString('id-ID'));
            $('#ujroh').textbox('setValue', hasilUjroh.toLocaleString('id-ID'));
        }
    </script>
		<div class="form-item">
			<label for="tgl_acc">Tanggal</label>
			<input type="text" name="tgl_acc" id="tgl_acc" class="easyui-datebox" prompt="Terisi otomatis" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="kode_pengajuan">ID Simpanan</label>
			<input type="text" name="kode_pengajuan" id="kode_pengajuan" class="easyui-textbox" prompt="Terisi otomatis" required="true" style="width:100%" />
		</div>

	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Save</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
</div>
</body>

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
function create(){
	$('#dialog-form').dialog('open').dialog('setTitle','Tambah Data');
	$('#form').form('clear');
}
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
		url		: "pages/pengajuan/simpan.php",
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
function update(){
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


	<table id="datagrid-crud" title="Pengajuan Pinjaman" class="easyui-datagrid" style="width:auto; height: auto;" url="pages/pengajuan/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'kode_anggota'" sortable="true">Kode Anggota</th>
            <th data-options="field:'nama_anggota'" sortable="true">Nama Anggota</th>
            <th data-options="field:'tgl_pengajuan'" sortable="true">Tgl Pengajuan</th>
            <th data-options="field:'kode_jenis_pinjam'">Jenis</th>
            <th data-options="field:'besar_pinjam'">Jumlah</th>
            <th data-options="field:'besar_angsuran'">Lama</th>
			<th data-options="field:'tgl_acc'">Tgl Acc</th>
			<th data-options="field:'status'">Status</th>
			<th data-options="field:'kode_pengajuan'">Kode</th>
        </tr>
    </thead>
	</table>
    <div id="tb" style="padding:2px;height:30px;">
		<div style="float:left;">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">Tambah</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus()">Hapus</a>
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
			<label for="bunga">Bunga</label>
			<input type="text" name="bunga" id="bunga" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="angsuran">Angsuran</label>
			<input type="text" name="angsuran" id="angsuran" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="tgl_acc">Tanggal</label>
			<input type="text" name="tgl_acc" id="tgl_acc" class="easyui-datebox" prompt="Terisi otomatis" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="status">Status</label>
			<input type="text" name="status" id="status" value="pengajuan" class="easyui-textbox" prompt="pengajuan" required="true" style="width:100%" />
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

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
		url		: "pages/anggota/simpan.php",
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
					url		: "pages/anggota/hapus.php",
					data	: 'id='+row.kode_anggota,
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
</script>
</head>
<body>


	<table id="datagrid-crud" title="Master Anggota" class="easyui-datagrid" style="width:auto; height: auto;" url="pages/anggota/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'kode_anggota'" sortable="true">Kode Anggota</th>
            <th data-options="field:'nama_anggota'" sortable="true">Nama Anggota</th>
            <th data-options="field:'alamat_anggota'">Alamat</th>
            <th data-options="field:'jenis_kelamin'">JKL</th>
            <th data-options="field:'pekerjaan'">Pekerjaan</th>
            <th data-options="field:'telp'">No Telp</th>
            <th data-options="field:'tgl_masuk'">Tgl Masuk</th>
            <th data-options="field:'tempat_lahir'">Tempat Lahir</th>
            <th data-options="field:'tgl_lahir'">Tgl Lahir</th>
            <th data-options="field:'status'">Aktif</th>
			<!--th data-options="field:'jenis'">Jenis</th-->
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
			<label for="type">Kode Anggota</label>
			<input type="text" name="kode_anggota" id="kode_anggota" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="nama_anggota">Nama Anggota</label>
			<input type="text" name="nama_anggota" id="nama_anggota" class="easyui-textbox" required="true" style="width:100%"  />
		</div>
		<div class="form-item">
			<label for="alamat_anggota">alamat_anggota</label>
			<input type="text" name="alamat_anggota" id="alamat_anggota" class="easyui-textbox" required="true" style="width:100%"/>
		</div>
		<div class="form-item">
			<label for="jenis_kelamin">jenis_kelamin</label>
			<input type="text" name="jenis_kelamin" id="jenis_kelamin" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="pekerjaan">pekerjaan</label>
			<input type="text" name="pekerjaan" id="pekerjaan" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="telp">No Telp</label>
			<input type="text" name="telp" id="telp" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="tgl_masuk">Tgl Masuk</label>
			<input type="text" name="tgl_masuk" id="tgl_masuk" class="easyui-datebox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="tempat_lahir">Tempat Lahir</label>
			<input type="text" name="tempat_lahir" id="tempat_lahir" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="tgl_lahir">Tgl_lahir / Aktif </label>
			<input type="text" name="tgl_lahir" id="tgl_lahir" class="easyui-datebox" required="true" style="width:50%" />
			<input type="text" name="aktif" id="aktif" class="easyui-textbox" required="true" style="width:49%"/>
		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Save</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
</div>
</body>

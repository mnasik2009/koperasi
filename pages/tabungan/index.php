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
	var row = $('#datagrid-crud').datagrid('getSelected');
	if(row){
		$('#dialog-form1').dialog('open').dialog('setTitle','Penarikan Dana / Keluar Koperasi');
		$('#form1').form('load',row);
	}
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
		url		: "pages/tabungan/simpan.php",
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
					url		: "pages/tabungan/hapus.php",
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


	<table id="datagrid-crud" title="Master Tabungan" class="easyui-datagrid" style="width:auto; height: auto;" url="pages/tabungan/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'kode_anggota'" sortable="true">Kode Anggota</th>
            <th data-options="field:'nama_anggota'" sortable="true">Nama Anggota</th>
            <th data-options="field:'s_wajib'">Wajib</th>
            <th data-options="field:'s_pokok'">Pokok</th>
        </tr>
    </thead>
	</table>
    <div id="tb" style="padding:2px;height:30px;">
		<div style="float:left;">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">Penarikan</a>
			<!--a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus()">Hapus</a-->
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
			<label for="alamat_anggota">Jenis Simpanan</label>
			<select type="text" name="jenis_simpan" id="jenis_simpan" class="easyui-combobox" required="true" style="width:100%"/>
			<option value="wajib">Wajib</option>
			<option value="pokok">Pokok</option></select>
		</div>
		<div class="form-item">
			<label for="besar_simpanan">Jumlah</label>
			<input type="text" name="besar_simpanan" id="besar_simpanan" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="kode_simpan">ID Simpanan</label>
			<input type="text" name="kode_simpan" id="kode_simpan" class="easyui-textbox" prompt="Terisi otomatis" required="true" style="width:100%" />
		</div>

	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Save</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
</div>
<!-- Dialog Form Tarikan -->
<div id="dialog-form1" class="easyui-dialog" style="width:500px; height:550px; padding: 10px 20px" closed="true" buttons="#dialog-buttons">
	<form id="form1" method="post" novalidate>
		<div class="form-item">
			<label for="type">Kode Anggota</label>
			<input type="text" name="kode_anggota" id="kode_anggota" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="nama_anggota">Nama Anggota</label>
			<input type="text" name="nama_anggota" id="nama_anggota" class="easyui-textbox" required="true" style="width:100%"  />
		</div>
		<div class="form-item">
			<label for="s_wajib">Wajib</label>
			<input type="text" name="s_wajib" id="s_wajib" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="s_pokok">Pokok</label>
			<input type="text" name="s_pokok" id="s_pokok" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="bayar_via">Bayar Via</label>
			<select type="text" name="bayar_via" id="bayar_via" class="easyui-combobox" prompt="Terisi otomatis" required="true" style="width:100%">
				<option value="tunai">Tunai</option>
				<option value="transfer">Transfer</option>
			</select>
		</div>
		<div class="form-item">
			<label for="kode_simpan">ID Simpanan</label>
			<input type="text" name="kode_simpan" id="kode_simpan" class="easyui-textbox" prompt="Terisi otomatis" required="true" style="width:100%" />
		</div>


	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Save</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form1').dialog('close')">Cancel</a>
</div>
</body>

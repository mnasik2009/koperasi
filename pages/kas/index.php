<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Master Simpanan</title>
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
		url		: "pages/kas/simpan.php",
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
					url		: "pages/kas/hapus.php",
					data	: 'id='+row.notrans,
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
				url: 'pages/kas/get_anggota.php?',
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
});
</script>
</head>
<body>


	<table id="datagrid-crud" title="Master Kas" class="easyui-datagrid" style="width:auto; height: auto;" url="pages/kas/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'notrans'" sortable="true">No Trans</th>
            <th data-options="field:'keterangan'" sortable="true">Keterangan</th>
            <th data-options="field:'tanggal'">Tanggal</th>
            <th data-options="field:'debet'">Debet</th>
			<th data-options="field:'kredit'">Kredit</th>
			<th data-options="field:'kegiatan'">Kegiatan</th>
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
			<label for="notrans">No Trans</label>
			<input type="text" name="notrans" id="notrans" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="keterangan">Keterangan</label>
			<input type="text" name="keterangan" id="keterangan" class="easyui-textbox" required="true" style="width:100%"  />
		</div>
		<div class="form-item">
			<label for="tanggal">Tanggal</label>
			<input type="text" name="tanggal" id="tanggal" class="easyui-datebox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="debet">Debet</label>
			<input type="text" name="debet" id="debet" class="easyui-textbox" value="0" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="kredit">Kredit</label>
			<input type="text" name="kredit" id="kredit" class="easyui-textbox" value="0" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="kegiatan">Kegiatan</label>
			<input type="text" name="kegiatan" id="kegiatan" class="easyui-textbox" prompt="Terisi otomatis" required="true" style="width:100%" />
		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Save</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Cancel</a>
</div>
</body>

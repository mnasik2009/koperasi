<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Master Vendor</title>

<script type="text/javascript">
var url;
function create(){
	$('#dialog-form').dialog('open').dialog('setTitle','Tambah Data');
	$('#form').form('clear');
}
function save(){
	var kode = $("#kode").val();
	var string = $("#form").serialize();
	if (kode.value == "")
    {
        $.messager.alert("Informasi","Silahkan Masukkan Kode.");
        kode.focus();
        return false;
    }

    if (nama.value == "")
    {
        $.messager.alert("Informasi","Silahkan Masukkan nama");
        nama.focus();
        return false;
    }

    if (alamat.value == "")
    {
        $.messager.alert("Informasi","Silahkan Masukkan alamat");
		alamat.focus();
        return false;
    }

    if (kota.value == "")
    {
        $.messager.alert("Informasi","Silahkan masukkan kota");
        kota.focus();
        return false;
    }

    if (norek.value == "")
    {
        $.messager.alert("Informasi","Silahkan Masukkan norek");
        norek.focus();
        return false;
    }

    if (pimpinan.value == "")
    {
        $.messager.alert("Informasi","Silahkan Masukkan No Telepon");
        pimpinan.focus();
        return false;
    }

    if (bank.value == "")
    {
        $.messager.alert("Informasi","Silahkan Masukkan password");
        bank.focus();
        return flase;
    }

    if (pemilikrek.value == "")
    {
        $.messager.alert("Informasi","Silahkan Masukkan pemilikrek");
        pemilikrek.focus();
        return flase;
    }

	$.ajax({
		type	: "POST",
		url		: "pages/umum/simpan.php",
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
					url		: "pages/umum/hapus.php",
					data	: 'id='+row.kode,
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
	<table id="datagrid-crud" title="Setting Company" class="easyui-datagrid" style="width:auto; height:auto;" url="pages/umum/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'kode',width:20" sortable="true">Kode Vendor</th>
            <th data-options="field:'nama',width:50" sortable="true">Nama Vendor</th>
            <th data-options="field:'alamat',width:80">Alamat</th>
            <th data-options="field:'kota',width:50">Kota</th>
            <th data-options="field:'norek',width:30">No Rekening</th>
            <th data-options="field:'pimpinan',width:35">Tanda Tangan</th>
            <th data-options="field:'bank',width:30">Bank</th>
			      <th data-options="field:'pemilikrek',width:30">Nama Rekening</th>
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
        	Pencarian <input id="cari" class="easyui-searchbox" data-options="prompt:'Cari Kode / Nama..',searcher:doSearch" style="width:200px"></input>
		</div>
	</div>

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:550px; height:450px; padding: 10px 20px" closed="true" buttons="#dialog-buttons">
	<form id="form" method="post" novalidate>
		<div class="form-item">
			<label for="type">Kode Company</label>
			<input type="text" name="kode" id="kode" class="easyui-textbox" required="true" style="width:100%"  />
		</div>
		<div class="form-item">
			<label for="nama">Nama Company</label>
			<input type="text" name="nama" id="nama" class="easyui-textbox" required="true" style="width:100%"  />
		</div>
		<div class="form-item">
			<label for="alamat">Alamat</label>
			<input type="text" name="alamat" id="alamat" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="kota">Kota</label>
			<input type="text" name="kota" id="kota" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="norek">No Rekening</label>
			<input type="text" name="norek" id="norek" class="easyui-textbox" required="true" style="width:100%" />
		</div>
		<div class="form-item">
			<label for="bank">Nama Bank / Nama Akun Bank</label>
			<input type="text" name="bank" id="bank" class="easyui-textbox" required="true" style="width:49%" />
      <input type="text" name="pemilikrek" id="pemilikrek" class="easyui-textbox" required="true" style="width:50%"/>
		</div>
		<div class="form-item">
			<label for="pimpinan">Penanda Tangan</label>
      <input type="text" name="pimpinan" id="pimpinan" class="easyui-textbox" required="true" style="width:100%"/>

		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
</div>
</body>
</html>

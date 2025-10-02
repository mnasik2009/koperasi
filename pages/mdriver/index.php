<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../easyui/themes/metro/easyui.css">
	<link rel="stylesheet" type="text/css" href="../easyui/themes/icon.css">
	<script type="text/javascript" src="../easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../easyui/jquery.easyui.mobile.js"></script>

<script type="text/javascript">
var url;
function create(){
	$('#dialog-form').dialog('open').dialog('setTitle','Tambah Data');
	$('#form').form('clear');
}
function save(){
	var kode = $("#kode").val();
	var string = $("#form").serialize();
	if(nama.length==0){
		$.messager.show({
			title:'Info',
			msg:'Maaf, kode tidak boleh kosong',
			timeout:2000,
			showType:'slide'
		});
		$("#kode").focus();
		return false();
	}

	$.ajax({
		type	: "POST",
		url		: "pages/mdriver/simpan.php",
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
					url		: "pages/mdriver/hapus.php",
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
	<div style="margin:10px 0;"></div>

	<table id="datagrid-crud" class="easyui-datagrid" style="width:auto; height:auto;" url="pages/mdriver/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'kode',width:30" sortable="true">Kode </th>
            <th data-options="field:'nama',width:55" sortable="true">Nama </th>
            <th data-options="field:'alamat',width:80">Alamat</th>
            <th data-options="field:'jkl',width:10">JKL</th>
            <th data-options="field:'agama',width:20">Agama</th>
            <th data-options="field:'tempat_lahir',width:40">Tempat Lahir</th>
						<th data-options="field:'tgl_lahir',width:35">Tgl Lahir</th>
			      <th data-options="field:'nohp',width:30">No HP</th>
						<th data-options="field:'nik',width:30">NIK</th>
						<th data-options="field:'npwp',width:30">NPWP</th>
						<th data-options="field:'no_sim',width:30">No. SIM</th>
						<th data-options="field:'tgl_sim',width:30" hidden="true"></th>
						<th data-options="field:'noplat',width:30">No. Plat</th>
						<th data-options="field:'aktif',width:10">Aktif</th>
        </tr>
    </thead>
	</table>
    <div id="tb" style="padding:2px;height:30px;">
		<div style="float:left;">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus-square-o fa-lg" plain="true" onclick="create()">Tambah</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-pencil-square-o fa-lg" plain="true" onclick="update()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-minus-square-o fa-lg" plain="true" onclick="hapus()">Hapus</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-refresh fa-lg" plain="true" onclick="fresh()">Refresh</a>
		</div>
		<div style="float:right;">
        	Pencarian <input id="cari" class="easyui-searchbox" data-options="prompt:'Cari Kode / Nama..',searcher:doSearch" style="width:200px"></input>
		</div>
	</div>

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:550px; height:550px; padding: 10px 20px" closed="true" buttons="#dialog-buttons">
	<form id="form" method="post">
		<div class="form-item">
			<label for="type">Kode &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Nama</label>
			<input type="text" name="kode" id="kode" class="easyui-textbox" required="true" style="width:20%" maxlength="20" />
			<input type="text" name="nama" id="nama" class="easyui-textbox" required="true" style="width:79%" maxlength="100" />
		</div>
		<div class="form-item">
			<label for="tempat_lahir">Tempat Lahir </label>
			<input type="text" name="tempat_lahir" id="tempat_lahir" class="easyui-textbox" required="true" style="width:100%" maxlength="100" />
		</div>
		<div class="form-item">
			<label for="tgl_lahir">Tanggal Lahir </label>
			<input type="text" name="tgl_lahir" id="tgl_lahir" class="easyui-datebox" required="true" style="width:100%" maxlength="100" />
		</div>
		<div class="form-item">
			<label for="alamat">Alamat</label>
			<input type="text" name="alamat" id="alamat" class="easyui-textbox" required="true" style="width:100%" maxlength="20" />
		</div>
		<div class="form-item">
			<label for="jkl">Jenis Kelamin&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Status Perkawinan</label>
			<select class="easyui-combobox" name="jkl" id="jkl"  labelPosition="top" style="width:49%;">
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
		<select class="easyui-combobox" name="kawin" id="kawin" style="width:50%;">
		            <option value="K">Kawin</option>
		            <option value="B">Belum Kawin</option>
		        </select>
		</div>
		<div class="form-item">
			<label for="agama">Agama&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Pendidikan</label>
			<select name="agama" id="agama" class="easyui-combobox" required="true" style="width:20%" />
                <option value="Islam">Islam</option>
                <option value="Katolik">Katolik</option>
                <option value="Protestan">Protestan</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
			</select>
			<select name="pendidikan" id="pendidikan" class="easyui-combobox" required="true" style="width:79%" />
                <option value="SD">SD/MI</option>
                <option value="SMP">SMP/MTs</option>
                <option value="SMA">SMA/MA</option>
								<option value="DI">Diploma</option>
                <option value="S1">Sarjana</option>
                <option value="S2">Magister</option>
                <option value="S3">Doktoral</option>
			</select>
		</div>

		<div class="form-item">
			<label for="nohp">No HP</label>
			<input type="text" name="nohp" id="nohp" class="easyui-textbox" required="true" style="width:100%" maxlength="80" />
		</div>
		<div class="form-item">
			<label for="nik">Nomor Induk Kependudukan</label>
			<input type="text" name="nik" id="nik" class="easyui-textbox" required="true" style="width:100%" maxlength="10" />
		</div>
		<div class="form-item">
			<label for="npwp">N P W P</label>
			<input type="text" name="npwp" id="npwp" class="easyui-textbox" required="true" style="width:100%" maxlength="15" />
		</div>
		<div class="form-item">
			<label for="no_sim">No SIM</label>
			<select type="text" name="jenis_sim" id="jenis_sim" class="easyui-combobox" required="true" style="width:20%" maxlength="15" />
			    <option value="A">A</option>
                <option value="B">B</option>
				<option value="B1">B1</option>
				<option value="B2">B2</option>
				<option value="B2 UMUM">B2 UMUM</option>
            </select>
			<input type="text" name="no_sim" id="no_sim" class="easyui-textbox" required="true" style="width:50%" maxlength="15" />
			<input type="text" name="tgl_sim" id="tgl_sim" class="easyui-datebox" required="true" style="width:28%" maxlength="15" />
		</div>
		<div class="form-item">
			<label for="aktif">Aktif &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;No Plat</label>
			<select class="easyui-combobox" name="aktif" id="aktif"  labelPosition="top" style="width:20%;">
                <option value="Y">Ya</option>
                <option value="Y">Tidak</option>
            </select>
		 <input type="text" name="noplat" id="noplat" class="easyui-textbox" required="true" style="width:79%" maxlength="15" />
		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-floppy-o fa-lg" onclick="save()">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
</div>
</body>
</html>

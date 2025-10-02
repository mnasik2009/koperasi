<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../easyui/themes/metro/easyui.css">
	<link rel="stylesheet" type="text/css" href="../easyui/themes/icon.css">
	<script type="text/javascript" src="../easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../easyui/jquery.easyui.mobile.js"></script>
	<script type="text/javascript" src="../easyui/datagrid-cellediting.js"></script>
<script type="text/javascript">
var url;
function create(){
	$('#dialog-form').dialog('open').dialog('setTitle','Tambah Data');
	$('#form').form('clear');
}
function create2(){
	$('#dialog-form1').dialog('open').dialog('setTitle','Tambah Rekapan Data');
	$('#form1').form('clear');
}

function create1(){
	$('#dialog-anak1').dialog('open').dialog('setTitle','Tambah Data');
	$('#form').form('clear');
}
function save(){
	var kode = $("#kode").val();
	var string = $("#form").serialize();
	if(nama.length==0){
		$.messager.show({
			title:'Info',
			msg:'Maaf, Nama tidak boleh kosong',
			timeout:2000,
			showType:'slide'
		});
		$("#kode").focus();
		return false();
	}

	$.ajax({
		type	: "POST",
		url		: "pages/absen/simpan.php",
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

function simpan_edit(){
	var notrans = $("#notrans").val();
	var string = $("#frm-edit").serialize();
	if(nama.length==0){
		$.messager.show({
			title:'Info',
			msg:'Maaf, Nama tidak boleh kosong',
			timeout:2000,
			showType:'slide'
		});
		$("#notrans").focus();
		return false();
	}

	$.ajax({
		type	: "POST",
		url		: "pages/absen/simpan1.php",
		data	: string,
		success	: function(data){
			$.messager.show({
				title:'Info',
				msg:data, //'Password Tidak Boleh Kosong.',
				timeout:2000,
				showType:'slide'
			});
			$('#dg-crud').datagrid('reload');
		}
	});
}

function save_rekap(){
	var kode = $("#kode").val();
	var string = $("#form").serialize();
	if(nama.length==0){
		$.messager.show({
			title:'Info',
			msg:'Maaf, Nama tidak boleh kosong',
			timeout:2000,
			showType:'slide'
		});
		$("#kode").focus();
		return false();
	}

	$.ajax({
		type	: "POST",
		url		: "pages/absen/simpan_rekap.php",
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
					url		: "pages/absen/hapus.php",
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

function cariadd(){
	$('#data-crud1').datagrid('load',{
				aktif: $('#aktif').val(),
				bulan: $('#bulan').val(),
				tahun: $('#tahun').val()
    });
}
function update(){
	var row = $('#datagrid-crud').datagrid('getSelected');
	if(row){
		$('#dialog-form').dialog('open').dialog('setTitle','Edit Data');
		$('#form').form('load',row);
	}
}

function update1(){
	var row = $('#dg-crud').datagrid('getSelected');
	if(row){
		$('#dlg-edit').dialog('open').dialog('setTitle','Edit Data Rekap');
		$('#frm-edit').form('load',row);
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

function doLihat(value){
	$('#data-crud').datagrid('load',{
				cari: value
		});
}


function doLihat1(value){
	$('#dg-crud').datagrid('load',{
				cari1: value
		});
}
function view(){
	var row = $('#datagrid-crud').datagrid('getSelected');
	if(row){
		$('#dialog-anak').dialog('open').dialog('setTitle','View Detail');
		$('#form2').form('load',row);
	}
}
function view1(){
	var row = $('#datagrid-crud').datagrid('getSelected');
	if(row){
		$('#dlg-anak').dialog('open').dialog('setTitle','View Rekap');
		$('#frm-anak').form('load',row);
	}
}
$(function(){
    $('#kode').combogrid({
				panelWidth:700,
				url: 'pages/absen/get_sopir.php?',
				idField:'kode',
				textField:'kode',
				mode:'remote',
				fitColumns:true,
			    columns:[[
			    {field:'kode',title:'kode',width:10},
			    {field:'nama',title:'nama',width:20},
				{field:'alamat',title:'alamat',width:20},
			    ]],onClickRow:function(rowData){
			                                 var val =$('#kode').combogrid('grid').datagrid('getSelected');
			                                 $('#kode').textbox('setValue', val.kode);
			                                 $('#nama').textbox('setValue', val.nama);
			                                }
						});
		$('#datagrid-crud').datagrid({
				data: data
						}).datagrid('enableCellEditing').datagrid('gotoCell', {
						    index: 0,
						    field: 'kode'
						});
					});
</script>
</head>
<body>
	<div style="margin:10px 0;"></div>

	<table id="datagrid-crud" class="easyui-datagrid" style="width:auto; height:auto;" url="pages/absen/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'notrans',width:30" sortable="true">No Trans </th>
            <th data-options="field:'tanggal',width:55" sortable="true">Tanggal </th>
            <th data-options="field:'bulan',width:30">Bulan</th>
            <th data-options="field:'tahun',width:30">Tahun</th>
            <th data-options="field:'keterangan',width:30">Keterangan</th>
        </tr>
    </thead>
	</table>
    <div id="tb" style="padding:2px;height:30px;">
		<div style="float:left;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-plus-square-o fa-lg'" plain="true" onclick="create()">Tambah</a>
			<!--a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-calculator fa-lg'" plain="true" onclick="create2()">Rekap</a-->
			<!--a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-calculator fa-lg'" plain="true" onclick="javascript:wincal=window.open('pages/absen/import_rekap.php?notrans='+$('#datagrid-crud').datagrid('getSelected').notrans
		,'popuppage','width=500,toolbar=0,resizable=0,scrollbars=yes,height=400,top=100,left=100');">Rekap</a-->
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-file-excel-o fa-lg'" plain="true" onclick="javascript:wincal=window.open('pages/absen/import_excel.php?notrans='+$('#datagrid-crud').datagrid('getSelected').notrans+$('#datagrid-crud').datagrid('getSelected').tanggal
		,'popuppage','width=500,toolbar=0,resizable=0,scrollbars=yes,height=400,top=100,left=100');">Upload</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-pencil-square-o fa-lg'" plain="true" onclick="update()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-minus-square-o fa-lg'" plain="true" onclick="hapus()">Hapus</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-list fa-lg'" plain="true" onclick="view()">Detail</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-calculator fa-lg'" plain="true" onclick="view1()">View rekap</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-refresh fa-lg'" plain="true" onclick="fresh()">Refresh</a>
		</div>
		<div style="float:right;">
        	Pencarian <input id="cari" class="easyui-searchbox" data-options="prompt:'Cari Kode / Nama..',searcher:doSearch" style="width:200px"></input>
		</div>
	</div>

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:450px; height:350px; padding: 10px 20px" closed="true" buttons="#dialog-buttons">
	<form id="form" method="post">
		<div class="form-item">
			<label for="type">Tanggal &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;No Transaksi</label>
			<input type="text" name="tanggal" id="tanggal" class="easyui-datebox" required="true" style="width:30%"/>
			<input type="text" name="notrans" id="notrans" class="easyui-textbox" required="true" style="width:69%" maxlength="100" />
		</div>
		<div class="form-item">
			<label for="bulan">Bulan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Tahun</label>
			<select type="text" name="bulan" id="bulan" class="easyui-combobox" required="true" style="width:30%"/>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">01</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option></select>
			<input type="text" name="tahun" id="tahun" class="easyui-textbox" required="true" style="width:69%"/>
    </div>
		<div class="form-item">
			<label for="aktif">Keterangan</label>
			<input type="text" name="keterangan" id="keterangan" class="easyui-textbox" required="true" style="width:100%" maxlength="15" />

		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-floppy-o fa-lg" onclick="save()">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
</div>

<div id="dialog-anak" class="easyui-dialog" style="width:800px; height:500px;padding: 10x 20px" closed="true" buttons="#dg-btn">
	<table id="data-crud" class="easyui-datagrid" style="width:auto; height:450;" url="pages/absen/get_detail.php" pagination="true" rownumbers="true" toolbar="#ta" fitColumns="true" singleSelect="true">
		<thead>
				<tr>
						<th data-options="field:'notrans'" sortable="true">No Transaksi</th>
						<th data-options="field:'nik'">NIK</th>
						<th data-options="field:'nama'">Nama</th>
						<th data-options="field:'tanggal'">Tanggal</th>
						<th data-options="field:'jam1'" sortable="true">Masuk</th>
						<th data-options="field:'jam2'">Pulang</th>
						<th data-options="field:'catat'">Catat</th>
				</tr>
		</thead>
	</table>
		<div id="ta" style="padding:2px;height:30px">
	 <form id="form2">
		<div style="float:left;">
					Pencarian <input id="cari" name="notrans" class="easyui-searchbox" data-options="prompt:'Cari Nomor Transaksi..',searcher:doLihat" style="width:200px"></input>
		</div>
	</form>
	</div>
</div>
<div id="dg-btn">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-anak').dialog('close')">Batal</a>
</div>

<div id="dlg-anak" class="easyui-dialog" style="width:800px; height:500px;padding: 10x 20px" closed="true" buttons="#dg-bta">
	<table id="dg-crud" class="easyui-datagrid" style="width:auto; height:450;" url="pages/absen/get_detail1.php" pagination="true" rownumbers="true" toolbar="#tn" fitColumns="true" singleSelect="true">
		<thead>
				<tr>
						<th data-options="field:'notrans'" sortable="true">No Transaksi</th>
						<th data-options="field:'nik'">NIK</th>
						<th data-options="field:'nama'">Nama</th>
						<th data-options="field:'hadir'">Hadir</th>
						<th data-options="field:'alpha'" sortable="true">Alpha</th>
						<th data-options="field:'sakit'">Sakit</th>
						<th data-options="field:'cuti'">Cuti</th>
						<th data-options="field:'telat'">Telat</th>
						<th data-options="field:'luar'">Luar</th>
						<th data-options="field:'lembur'">Lembur</th>
				</tr>
		</thead>
	</table>
	<div id="tn" style="padding:2px;height:30px">
 <form id="frm-anak">
	<div style="float:left;">
				Pencarian <input id="cari1" name="notrans" class="easyui-searchbox" data-options="prompt:'Cari Nomor Transaksi..',searcher:doLihat1" style="width:200px"></input>
				<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-pencil-square-o fa-lg'" plain="true" onclick="update1()">Edit</a>
	</div>
</form>
</div>
</div>
<div id="dg-bta">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dlg-anak').dialog('close')">Batal</a>
</div>

<div id="dlg-edit" class="easyui-dialog" style="width:450px; height:350px; padding: 10px 20px" closed="true" buttons="#btn-edit">
	<form id="frm-edit" method="post">
		<div class="form-item">
			<label for="type">No Transaksi / NIK / Nama</label>
			<input type="text" name="notrans" id="notrans" class="easyui-textbox" required="true" style="width:40%"/>
			<input type="text" name="nik" id="nik" class="easyui-textbox" required="true" style="width:25%"/>
      <input type="text" name="nama" id="nama" class="easyui-textbox" required="true" style="width:33%"/>
		</div>
		<div class="form-item">
			<label for="hadir">Hadir &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Alpha&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Sakit</label>
			<input type="text" name="hadir" id="hadir" class="easyui-textbox" required="true" style="width:32%"/>
      <input type="text" name="alpha" id="alpha" class="easyui-textbox" required="true" style="width:32%"/>
      <input type="text" name="sakit" id="sakit" class="easyui-textbox" required="true" style="width:33%"/>
    </div>
    <div class="form-item">
      <label for="hadir">Luar Kota &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Cuti&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Telat</label>
      <input type="text" name="luar" id="luar" class="easyui-textbox" required="true" style="width:32%"/>
      <input type="text" name="cuti" id="cuti" class="easyui-textbox" required="true" style="width:32%"/>
      <input type="text" name="telat" id="telat" class="easyui-textbox" required="true" style="width:33%"/>
    </div>
		<div class="form-item">
			<label for="lembur">Lembur</label>
			<input type="text" name="lembur" id="lembur" class="easyui-textbox" required="true" style="width:100%" maxlength="15" />

		</div>
	</form>
</div>
<!-- Dialog Button -->
<div id="btn-edit">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-floppy-o fa-lg" onclick="simpan_edit()">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" onclick="javascript:jQuery('#dlg-edit').dialog('close')">Batal</a>
</div>
</body>

</html>

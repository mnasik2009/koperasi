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

function rekap(){
	$('#dialog-rekap').dialog('open').dialog('setTitle','Rekap Data');
	$('#form-rekap').form('clear');
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
		url		: "pages/tgaji/simpan.php",
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

function simpan1(){
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
		url		: "pages/tgaji/simpan1.php",
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
					url		: "pages/tgaji/hapus.php",
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
		$('#dialog-form1').dialog('open').dialog('setTitle','Edit Data');
		$('#form1').form('load',row);
	}
}

function cetak(){
	var row = $('#datagrid-crud').datagrid('getSelected');
	if(row){
		$('#dialog-print').dialog('open').dialog('setTitle','Edit Data');
		$('#form-print').form('load',row);
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
    $('#kode').combogrid({
				panelWidth:700,
				url: 'pages/tgaji/get_sopir.php?',
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

	<table id="datagrid-crud" class="easyui-datagrid" style="width:auto; height:auto;" url="pages/tgaji/json.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
            <th data-options="field:'notrans',width:35" sortable="true">No Trans </th>
            <th data-options="field:'tgltrans',width:20" sortable="true">Tanggal </th>
						<th data-options="field:'nik',width:25" sortable="true">NIK </th>
						<th data-options="field:'nama',width:35" sortable="true">Nama </th>
            <th data-options="field:'bulan',width:10">Bulan</th>
            <th data-options="field:'tahun',width:10">Tahun</th>
            <th data-options="field:'gapok',width:20">Gaji</th>
            <th data-options="field:'uang_hadir',width:10">T. Hadir</th>
						<th data-options="field:'ulembur',width:10">Lembur</th>
            <th data-options="field:'komunikasi',width:10">T. Komunikasi</th>
						<th data-options="field:'transportasi',width:10">T. Lain</th>
            <th data-options="field:'jml_lk',width:10">Luar</th>
						<th data-options="field:'potlain',width:10" hidden="true"></th>
						<th data-options="field:'pph21',width:10" hidden="true"></th>
						<th data-options="field:'tlembur',width:10" hidden="true"></th>
						<th data-options="field:'keterangan',width:10" hidden="true"></th>
						<th data-options="field:'idn',width:10">IDs</th>
        </tr>
    </thead>
	</table>
    <div id="tb" style="padding:2px;height:30px;">
		<div style="float:left;">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-plus-square-o fa-lg'" plain="true" onclick="create()">Tambah</a>
			<!--a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-calculator fa-lg'" plain="true" onclick="create2()">Rekap</a-->
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-pencil-square-o fa-lg'" plain="true" onclick="update()">Edit</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-minus-square-o fa-lg'" plain="true" onclick="hapus()">Hapus</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-print fa-lg'" plain="true" onclick="cetak()">Cetak</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-file-text-o fa-lg'" plain="true" onclick="rekap()">Rekap</a>
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
			<input type="text" name="tgltrans" id="tgltrans" class="easyui-datebox" required="true" style="width:30%"/>
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
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-spinner fa-lg" onclick="save()">Proses</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
</div>

<div id="dialog-form1" class="easyui-dialog" style="width:450px; height:500px; padding: 10px 20px" closed="true" buttons="#dialog-buttons1">
	<form id="form1" method="post">
		<div class="form-item">
			<label for="type">Kode &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Nama</label>
			<input type="text" name="notrans" id="notrans" class="easyui-textbox" required="true" style="width:40%" maxlength="20" />
			<input type="text" name="nama" id="nama" class="easyui-textbox" required="true" style="width:59%" maxlength="100" />
		</div>
		<div class="form-item">
			<label for="tanggal">Tanggal &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Bulan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Tahun</label>
			<input type="text" name="tgltrans" id="tgltrans" class="easyui-datebox" required="true" style="width:33%"/>
			<input type="text" name="bulan" id="bulan" class="easyui-textbox" prompt="bulan" required="true" style="width:33%"/>
      <input type="text" name="tahun" id="tahun" class="easyui-textbox" prompt="tahun" required="true" style="width:32%"/>
    </div>
		<div class="form-item">
			<label for="gapok">Gaji Pokok</label>
			<input type="text" name="gapok" id="gapok" class="easyui-textbox" prompt="hadir" required="true" style="width:100%" maxlength="15" />
		</div>
    <div class="form-item">
			<label for="komuniasu">Tunj Komunikasi</label>
      <input type="text" name="komunikasi" id="komunikasi" class="easyui-textbox" prompt="sakit" required="true" style="width:100%" maxlength="15" />
		</div>
    <div class="form-item">
			<label for="uang_hadir">Uang Hadir</label>
      <input type="text" name="uang_hadir" id="uang_hadir" class="easyui-textbox" prompt="luar kota" required="true" style="width:100%" maxlength="15" />
		</div>
    <div class="form-item">
			<label for="pph21">PPH Ps.21</label>
      <input type="text" name="pph21" id="pph21" class="easyui-textbox" prompt="alpha" required="true" style="width:100%" maxlength="15" />
		</div>
    <div class="form-item">
			<label for="potlain">Potongan Lain</label>
      <input type="text" name="potlain" id="potlain" class="easyui-textbox" prompt="potongan" required="true" style="width:100%" maxlength="15" />
		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons1">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-floppy-o fa-lg" onclick="simpan1()">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" onclick="javascript:jQuery('#dialog-form1').dialog('close')">Batal</a>
</div>

<!-- Form Untuk Print Slip -->
<div id="dialog-print" class="easyui-dialog" style="width:450px; height:500px; padding: 10px 20px" closed="true" buttons="#btn-print">
	<form id="form-print" method="post" action="pages/tgaji/slip.php" target="_blank">
		<div class="form-item">
			<label for="type">No Trans</label>
			<input type="text" name="notrans" id="notrans" class="easyui-textbox" required="true" style="width:100%" maxlength="20" />
		</div>
		<div class="form-item">
			<label for="type">Kode &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Nama</label>
			<input type="text" name="nik" id="nik" class="easyui-textbox" required="true" style="width:40%" maxlength="20" />
			<input type="text" name="nama" id="nama" class="easyui-textbox" required="true" style="width:59%" maxlength="100" />
		</div>
		<div class="form-item">
			<label for="tanggal">Tanggal &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Bulan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Tahun</label>
			<input type="text" name="tgltrans" id="tgltrans" class="easyui-datebox" required="true" style="width:33%"/>
			<input type="text" name="bulan" id="bulan" class="easyui-textbox" prompt="bulan" required="true" style="width:33%"/>
      <input type="text" name="tahun" id="tahun" class="easyui-textbox" prompt="tahun" required="true" style="width:32%"/>
    </div>
		    <div class="form-item">
			<label for="pph21">PPH Ps.21</label>
      <input type="text" name="pph21" id="pph21" class="easyui-textbox" prompt="alpha" required="true" style="width:100%" maxlength="15" />
		</div>
		<div class="form-item">
			<label for="koperasi">Koperasi</label>
      <input type="text" name="koperasi" id="koperasi" class="easyui-textbox" prompt="koperasi" required="true" style="width:100%" maxlength="15" />
		</div>
    <div class="form-item">
			<label for="potlain">Potongan Lain</label>
      <input type="text" name="potlain" id="potlain" class="easyui-textbox" prompt="potongan" required="true" style="width:100%" maxlength="15" />
		</div>
		<div class="form-item">
			<label for="tlembur">Tambahan Lembur</label>
      <input type="text" name="tlembur" id="tlembur" class="easyui-textbox" prompt="Tambahan Uang Lembur" required="true" style="width:100%" maxlength="15" />
		</div>
		<div class="form-item">
			<label for="keterangan">Keterangan</label>
      <input type="text" name="keterangan" id="keterangan" class="easyui-textbox" prompt="keterangan" required="true" style="width:100%" maxlength="15" />
		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="btn-print">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-print fa-lg" onclick="$('#form-print').submit();">Print</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" onclick="javascript:jQuery('#dialog-print').dialog('close')">Batal</a>
</div>


<!-- Print Rekap -->
<div id="dialog-rekap" class="easyui-dialog" style="width:450px; height:250px; padding: 10px 20px" closed="true" buttons="#btn-rekap">
	<form id="form-rekap" method="post" action="pages/tgaji/print.php" target="_blank">
		<label for="bulan">Bulan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Tahun</label>
		<select type="text" name="bulan1" id="bulan1" class="easyui-combobox" required="true" style="width:30%"/>
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
		<input type="text" name="tahun1" id="tahun1" class="easyui-textbox" required="true" style="width:69%"/>
	</form>
</div>

<!-- Dialog Button -->
<div id="btn-rekap">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-print fa-lg" onclick="$('#form-rekap').submit();">Print</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" onclick="javascript:jQuery('#dialog-rekap').dialog('close')">Batal</a>
</div>
</body>
</html>

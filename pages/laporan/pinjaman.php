<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../jeasyui/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../jeasyui/themes/icon.css">
    <script type="text/javascript" src="../../jeasyui/jquery.min.js"></script>
    <script type="text/javascript" src="../../jeasyui/jquery.easyui.min.js"></script>

<script type="text/javascript">
var url;
function doSearch(){
    $('#datagrid-crud').datagrid('load',{
		bulan: $("#bulan1").val(),
    tahun: $("#tahun1").val(),
    });
 }

function doLihat(value){
	$('#data-crud').datagrid('load',{
        cari: value
    });
}
</script>
</head>
<body>

	<table id="datagrid-crud" title="Outstanding Piutang Report" class="easyui-datagrid" style="width:auto; height: auto;" url="pages/laporan/jsonpnjaman.php" toolbar="#tb" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
    <thead>
        <tr>
          <th data-options="field:'notrans',width:35" sortable="true">No Trans </th>
          <th data-options="field:'tgltrans',width:20" sortable="true">Tanggal </th>
          <th data-options="field:'nik',width:25" sortable="true">NIK </th>
          <th data-options="field:'nama',width:35" sortable="true">Nama </th>
          <th data-options="field:'bulan',width:10">Bulan</th>
          <th data-options="field:'tahun',width:10">Tahun</th>
          <th data-options="field:'gapok',width:30">Gaji</th>
          <th data-options="field:'uang_hadir',width:20">T. Hadir</th>
          <th data-options="field:'komunikasi',width:20">T. Komunikasi</th>
          <th data-options="field:'jml_lk',width:10">Luar</th>
          <th data-options="field:'potlain',width:10" hidden="true"></th>
          <th data-options="field:'pph21',width:10" hidden="true"></th>
          <th data-options="field:'idn',width:10">IDs</th>
        </tr>
    </thead>
	</table>
    <div id="tb" style="padding:2px;height:30px;">
		<div style="float:left;">
		<form method="post" name="frm2" id="frm2" action="pages/tgaji/print.php" target="_blank">
      <select type="text" name="bulan1" id="bulan1" class="easyui-combobox" required="true"/>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option></select>
			<input type="text" name="tahun1" id="tahun1" class="easyui-textbox" required="true"/>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-search fa-lg" plain="true" onclick="doSearch()">Proses</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-file-text-o fa-lg" plain="true" onclick="$('#frm2').submit();">Rekap</a>
		</form>
	</div>
	</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Donatur.xls");
	?>

	<table border="1">
		<tr>
			<th>Invoice</th>
			<th>Tanggal</th>
			<th>Nama</th>
			<th>Telepon</th>
			<th>Pembayaran</th>
			<th>nominal</th>
		</tr>
		
		<?php $i=1;?>
		<?php foreach($donatur as $dt):?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $dt['tanggal']; ?></td>
			<td><?php echo $dt['nama']; ?></td>
			<td><?php echo $dt['telepon']; ?></td>
			<td><?php echo $dt['pembayaran']; ?></td>
			<td><?php echo $dt['nominal']; ?></td>
		</tr>
		<?php $i++;?>
		<?php endforeach;?>
	</table>
</body>
</html>
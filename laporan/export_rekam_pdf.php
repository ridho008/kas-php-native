<?php 
ob_start();
require_once '../config/koneksi.php';
require_once '../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();

$sqlRekap = $conn->query("SELECT * FROM tb_kas") or die(mysqli_error($conn));
// $jk = ($pecahAnggota['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan';


$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Export to PDF Rekapitulasi Kas</title>
</head>
<body>
<h2>Laporan Rekapitulasi Kas</h2>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
      <th>No</th>
      <th>Kode</th>
      <th>Tanggal</th>
      <th>Keterangan</th>
      <th>Masuk</th>
      <th>Jenis</th>
      <th>Keluar</th>
  	</tr>';
  	$no = 1;
  	while($data = $sqlRekap->fetch_assoc()) {
  		$html .= '
							<tr>
								<td>'. $no++ .'</td>
								<td>'. $data["kode"] .'</td>
								<td>'. date('d-m-Y', strtotime($data["tgl"])) .'</td>
								<td>'. $data["keterangan"] .'</td>
								<td>'. number_format($data["jumlah"]) .'</td>
								<td>'. $data["jenis"] .'</td>
								<td>'. $data["keluar"] .'</td>
							</tr>

  					';
  					$totalTT = $totalTT + $data['jumlah'];
			$total_keluarT = $total_keluarT + $data['keluar'];
			$saldo_akhirT = $totalTT - $total_keluarT;
  	}

  	$html .= '<tr>
                		<th colspan="4">Total Kas Masuk</th>
                		<td>Rp.'. number_format($totalTT) .'</td>
                	</tr>
                	<tr>
                		<th colspan="4">Total Kas Keluar</th>
                		<td>Rp.'. number_format($total_keluarT) .'</td>
                	</tr>
                	<tr>
                		<th colspan="4">Saldo Akhir</th>
                		<td>Rp.'. number_format($saldo_akhirT) .'</td>
                	</tr>';

$html .= '
</table>
</body>
</html>';

$html2pdf->writeHTML($html);
ob_end_clean();
$html2pdf->output();


?>
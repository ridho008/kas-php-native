<?php 
require_once '../config/koneksi.php';

$filename = "rekapitulasi-(". date('d-m-Y') .").xls";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

$tampilKas = $conn->query("SELECT * FROM tb_kas") or die(mysqli_error($conn));

?>
<table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Masuk</th>
                        <th>Jenis</th>
                        <th>Keluar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                while($data = $tampilKas->fetch_assoc()) : ?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $data['kode']; ?></td>
									<td><?= date('d-m-Y', strtotime($data['tgl'])); ?></td>
									<td><?= $data['keterangan']; ?></td>
									<td>Rp.<?= number_format($data['jumlah']); ?></td>
									<td><?= $data['jenis']; ?></td>
									<td><?= $data['keluar']; ?></td>
								</tr>
								<?php 
								@$totalTT = $totalTT + $data['jumlah'];
								@$total_keluarT = $total_keluarT + $data['keluar'];
								@$saldo_akhirT = $totalTT - $total_keluarT;
								?>
                <?php endwhile; ?>
                </tbody>
                	<tr>
                		<th colspan="4">Total Kas Masuk</th>
                		<td>Rp.<?= number_format($totalTT); ?></td>
                	</tr>
                	<tr>
                		<th colspan="4">Total Kas Keluar</th>
                		<td>Rp.<?= number_format($total_keluarT); ?></td>
                	</tr>
                	<tr>
                		<th colspan="4">Saldo Akhir</th>
                		<td>Rp.<?= number_format($saldo_akhirT); ?></td>
                	</tr>
            </table>
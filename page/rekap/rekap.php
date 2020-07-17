<?php 
// menampilkan semua table kas
$tampilKas = $conn->query("SELECT * FROM tb_kas") or die(mysqli_error($conn));

?>
<h2>Kas Masuk</h2>
<hr>
<a href="laporan/export_rekam_pdf.php" class="btn btn-primary" style="margin-bottom: 10px;" target="_blank">Export to PDF</a>
<a href="laporan/export_rekam_excel.php" class="btn btn-warning" style="margin-bottom: 10px;" target="_blank">Export to Excel</a>
<div class="panel panel-danger">
    <div class="panel-heading">
         Data Kas Masuk
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
								$totalTT = $totalTT + $data['jumlah'];
								$total_keluarT = $total_keluarT + $data['keluar'];
								$saldo_akhirT = $totalTT - $total_keluarT;
								?>
                <?php endwhile; ?>
                </tbody>
                <tfoot>
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
                </tfoot>
            </table>
        </div>
        
    </div>
</div>
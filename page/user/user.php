<?php 
$tampilUser = $conn->query("SELECT * FROM tb_users") or die(mysqli_error($conn));
?>
<h2>Management Users</h2>
<hr>
<div class="panel panel-danger">
    <div class="panel-heading">
         Data User
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($data = $tampilUser->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['username']; ?></td>
                        <td><?= $data['password']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['level']; ?></td>
                        <td><?= $data['foto']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
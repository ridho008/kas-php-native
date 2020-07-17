<?php 
session_start();
error_reporting(0);
require_once 'config/koneksi.php';

$page = $_GET['p'];
$aksi = $_GET['aksi'];

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// if(isset($_SESSION['admin'])) {
//     var_dump($_SESSION['admin']);
// } else {
//     var_dump($_SESSION['user']);
// }

$sql = $conn->query("SELECT * FROM tb_kas") or die(mysqli_error($conn));
while($data = $sql->fetch_assoc()) {
    $jml = $data['jumlah'];
    $total_masuk = $total_masuk + $jml;

    $jml_keluar = $data['keluar'];
    $total_keluar = $total_keluar + $jml_keluar;

    $total = $total_masuk - $total_keluar;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <!-- Navbar -->
        <?php require_once 'themeplates/navbar.php'; ?> 
        <!-- End Navbar -->  
           <!-- /. NAV TOP  -->
          
          <!-- Sidebar -->
            <?php require_once 'themeplates/sidebar.php'; ?>
          <!-- ENDSidebar -->
        

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <!-- <h2>Blank Page</h2>   
                        <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    <?php 
                    if($page == 'masuk') {
                        if($aksi == '') {
                            require_once 'page/kas_masuk/masuk.php';
                        } else if($aksi == 'hapus') {
                            require_once 'page/kas_masuk/hapus.php';
                        }
                    } else if($page == 'keluar') {
                        if($aksi == '') {
                            require_once 'page/kas_keluar/keluar.php';
                        } else if($aksi == 'hapus') {
                            require_once 'page/kas_keluar/hapus.php';
                        }
                    } else if($page == 'rekap') {
                        if($aksi == '') {
                            require_once 'page/rekap/rekap.php';
                        }
                    } else if($page == 'users') {
                        if($aksi == '') {
                            require_once 'page/user/user.php';
                        }
                    } else { ?>
                        <h2>Dashboard</h2>   
                        <h5>Selamat Datang <strong><?= $_SESSION['admin']['nama']; ?></strong> Di Aplikasi Kas Sekolah. </h5>
                        <hr>
                        <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-envelope"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Rp.<?= number_format($total_masuk); ?></p>
                    <p class="text-muted">Kas Masuk</p>
                </div>
             </div>
             </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-envelope-o"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Rp.<?= number_format($total_keluar); ?></p>
                    <p class="text-muted">Kas Keluar</p>
                </div>
             </div>
             </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-money"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Rp.<?= number_format($total); ?></p>
                    <p class="text-muted">Saldo Akhir</p>
                </div>
             </div>
             </div>
            </div>
                    <?php
                    }
                    ?>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <!-- <hr /> -->
                 
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <?php require_once 'themeplates/footer.php'; ?>

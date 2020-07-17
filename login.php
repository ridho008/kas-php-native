<?php 
session_start();
require_once 'config/koneksi.php';

if(isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

// Konfir COOKIE
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id']; // isinya field id tabel users
	$key = $_COOKIE['key']; //username

	$result = $conn->query("SELECT username FROM tb_users WHERE username = $id") or die(mysqli_error($conn));
	$row = $result->fetch_assoc();

	if($key == hash('sha256', $row['username'])) {
		$_SESSION['admin'] = $row;
	}
}

if(isset($_POST['login'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = md5($_POST['password']);

	$result = $conn->query("SELECT* FROM tb_users WHERE username = '$username'") or die(mysqli_error($conn));
	if($result->num_rows === 1) {
		$row = $result->fetch_assoc();
		if($data = $row['level'] === 'admin' || $data = $row['level'] === 'user') {
			$_SESSION['admin'] = $row;
			$_SESSION['user'] = $row;

			// COOKIE
			if(isset($_POST['remember'])) {
				setcookie('id', $row['id_user'], time() + 60);
				setcookie('key', hash('sha256', $row['username']) , time() + 60);
			}

			header("Location: index.php");
			exit;
		}
	}
	$error = true;
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
        <!-- Navbar -->
        <?php require_once 'themeplates/navbar.php'; ?> 
        <!-- End Navbar -->  
           <!-- /. NAV TOP  -->
<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<form action=""	method="post">
				<?php if(isset($error)) : ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Peringatan!</strong> Username/Password Anda Salah.
				</div>
				<?php endif; ?>
				<div class="form-group">
				    <label>Username</label>
				    <input type="text" name="username" id="username" class="form-control" />
				</div>
				<div class="form-group">
				    <label>password</label>
				    <input type="text" name="password" id="password" class="form-control" />
				</div>
				<div class="form-group">
					<div class="checkbox">
            <label>
                <input type="checkbox" name="remember" />Ingat Saya
            </label>
	        </div>
				</div>
				<div class="form-group">
					<button type="submit" name="login" class="btn btn-danger">Masuk</button>
				</div>
			</form>
		</div>
	</div>
</div>


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
<?php 
// mengambil id dari url
$id_kas = $_GET['id'];

$sql = $conn->query("DELETE FROM tb_kas WHERE id = $id_kas") or die(mysqli_error($conn));
if ($sql) {
	echo "<script>alert('Data berhasil dihapus.');window.location='?p=masuk';</script>";
} else {
	echo "<script>alert('Data berhasil dihapus.');window.location='?p=masuk';</script>";
}

?>
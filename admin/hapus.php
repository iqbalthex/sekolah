<?php

include '../koneksi.php';

if (isset($_GET['id'])){
	$delete = mysqli_query($conn, "DELETE FROM pengguna WHERE id = {$_GET['id']}");
	echo '<script>
		window.location = "pengguna.php";
	</script>';
}
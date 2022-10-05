<?php
	session_start();

	# jika belum login, paksa login terlebih dahulu
	if (!isset($_SESSION['status_login'])){
		echo '<script>
			window.location = "../login.php?msg=Harap Login Terlebih Dahulu!";
		</script>';
	}

	# menyisipkan kode di dalam file koneksi.php
	include '../koneksi.php';

	date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Panel Admin - Nama Sekolah</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="text/css" rel="stylesheet" href="../assets/css/style.css" />
</head>
<body class="bg-light">
<div class="navbar">
	<div class="container">
		<h2 class="navbar-brand float-left"><a href="index.php">Nama Sekolah</a></h2>
		<ul class="nav-menu">
			<li><a href="index.php">Dashboard</a></li>
			<?php if($_SESSION['ulevel'] == 'Super Admin'){ ?>
				<li><a href="pengguna.php">Pengguna</a></li> <!-- tampil jika Super Admin yang sedang login -->
			<?php } elseif($_SESSION['ulevel'] == 'Admin'){ ?>
				<li><a href="jurusan.php">Jurusan</a></li>			<!-- tampil jika Admin yang sedang login -->
				<li><a href="galeri.php">Galeri</a></li>				<!-- tampil jika Admin yang sedang login -->
				<li><a href="informasi.php">Informasi</a></li>	<!-- tampil jika Admin yang sedang login -->
				<li>
					<a href="">Pengaturan v</a>										<!-- tampil jika Admin yang sedang login -->
					<ul class="dropdown">
						<li><a href="identitas-sekolah.php">Identitas Sekolah</a></li>
						<li><a href="tentang-sekolah.php">Tentang Sekolah</a></li>
						<li><a href="kepala-sekolah.php">Kepala Sekolah</a></li>
					</ul>
				</li>
			<?php } ?>
			<li>
				<a href="">
					<!-- menampilkan nama dan level user yang sedang login -->
					<?= $_SESSION['uname'] ?> (<?= $_SESSION['ulevel'] ?>)
				</a>
				<ul class="dropdown">
					<li><a href="ubah-password.php">Ubah Password</a></li>
					<li><a href="logout.php">Keluar</a></li>
				</ul>
			</li>
		</ul>
		<div class="clearfix"></div>
	</div>
</div>
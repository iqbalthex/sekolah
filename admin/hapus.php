<?php

include '../koneksi.php';

if (isset($_GET['id'])){
	$delete = mysqli_query($conn, "DELETE FROM pengguna WHERE id = {$_GET['id']}");
	echo '<script>
		window.location = "pengguna.php?msg=Berhasil menghapus data!";
	</script>';
}

if (isset($_GET['idjurusan'])){

	$jurusan = mysqli_query($conn, "SELECT gambar FROM jurusan WHERE id = {$_GET['idjurusan']}");

	if(mysqli_num_rows($jurusan) > 0){
		$p = mysqli_fetch_object($jurusan);
		if(file_exists("../uploads/jurusan/{$p->gambar}")){
			unlink("../uploads/jurusan/{$p->gambar}");
		}
	}

	$delete = mysqli_query($conn, "DELETE FROM jurusan WHERE id = {$_GET['idjurusan']}");
	echo '<script>
		window.location = "jurusan.php?msg=Berhasil menghapus data!";
	</script>';
}

if (isset($_GET['idgaleri'])){

	$galeri = mysqli_query($conn, "SELECT foto FROM galeri WHERE id = {$_GET['idgaleri']}");

	if(mysqli_num_rows($galeri) > 0){
		$p = mysqli_fetch_object($galeri);
		if(file_exists("../uploads/galeri/{$p->foto}")){
			unlink("../uploads/galeri/{$p->foto}");
		}
	}

	$delete = mysqli_query($conn, "DELETE FROM galeri WHERE id = {$_GET['idgaleri']}");
	echo '<script>
		window.location = "galeri.php?msg=Berhasil menghapus data!";
	</script>';
}

if (isset($_GET['idinformasi'])){

	$informasi = mysqli_query($conn, "SELECT gambar FROM informasi WHERE id = {$_GET['idinformasi']}");

	if(mysqli_num_rows($informasi) > 0){
		$p = mysqli_fetch_object($informasi);
		if(file_exists("../uploads/informasi/{$p->foto}")){
			unlink("../uploads/informasi/{$p->foto}");
		}
	}

	$delete = mysqli_query($conn, "DELETE FROM informasi WHERE id = {$_GET['idinformasi']}");
	echo '<script>
		window.location = "informasi.php?msg=Berhasil menghapus data!";
	</script>';
}
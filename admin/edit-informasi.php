<?php

include 'header.php';

$informasi = mysqli_query($conn, "SELECT  * FROM informasi WHERE id = {$_GET['idinformasi']}");
if(mysqli_num_rows($informasi) == 0){
	echo '<script>window.location = "informasi.php"</script>';
}
$p = mysqli_fetch_object($informasi);

?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Edit Informasi
			</div>
			<div class="box-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judul" placeholder="Judul"
							class="input-control" value="<?= $p->judul ?>" required />
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" placeholder="Keterangan"
							class="input-control"><?= $p->keterangan ?></textarea>
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<img src="../uploads/informasi/<?= $p->gambar ?>" width="200" class="image" />
						<input type="hidden" name="gambar2" value="<?= $p->gambar ?>" class="input-control" />
						<input type="file" name="gambar" class="input-control" />
					</div>
					<button class="btn" onclick="window.location = 'informasi.php'">Kembali</button>
					<input type="submit" name="submit" value="Simpan" class="btn btn-blue" />
				</form>

				<?php
					if (isset($_POST['submit'])){
						$judul = addslashes(ucwords($_POST['judul']));
						$ket = addslashes($_POST['keterangan']);

						if($_FILES['gambar']['name'] != ''){
							$filename = $_FILES['gambar']['name'];
							$tmpname = $_FILES['gambar']['tmp_name'];
							$filesize	= $_FILES['gambar']['size'];

							$format = pathinfo($filename, PATHINFO_EXTENSION);
							$rename = 'informasi' . time() . '.' . $format;

							$allowed_type = ['png','jpg','jpeg','gif'];

							if(!in_array($format, $allowed_type)){
								echo '<div class="alert alert-error">Format file tidak diizinkan!</div>';
								return false;
							} elseif($filesize > 1000000){
								echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 Mb!</div>';
								return false;
							} else {
								move_uploaded_file($tmpname, "../uploads/informasi/$rename");

								$simpan = mysqli_query($conn, "INSERT INTO informasi VALUES(
									'',
									'$judul',
									'$ket',
									'$rename',
									'',
									'',
									''
								)");

								if($simpan){
									echo '<div class="alert alert-success">Berhasil menyimpan!</div>';
								} else {
									echo '<div class="alert alert-error">Gagal menyimpan!</div>';
								}
							}

							if(file_exists("../uploads/informasi/{$_POST['gambar2']}")){
								unlink("../uploads/informasi/{$_POST['gambar2']}");
							}

							move_uploaded_file($tmpname, "../uploads/informasi/$rename");

						} else {
							$rename = $_POST['gambar2'];
						}

						$update = mysqli_query($conn, "UPDATE informasi SET
							judul = '$judul',
							keterangan = '$ket',
							gambar = '$rename'
							WHERE id = {$_GET['idinformasi']}
						");

						if($update){
							echo '<script>window.location = "informasi.php?msg=Edit data berhasil!";</script>';
						} else {
							echo '<div class="alert alert-error">Gagal mengubah data!</div>';
						}
					}
				?>

			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
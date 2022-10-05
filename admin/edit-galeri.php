<!-- mirip file edit-pengguna.php -->

<?php

include 'header.php';

$galeri = mysqli_query($conn,
	"SELECT  * FROM galeri WHERE id = {$_GET['idgaleri']}"
);
if(mysqli_num_rows($galeri) == 0){
	echo '<script>window.location = "galeri.php"</script>';
}
$p = mysqli_fetch_object($galeri);

?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Edit Galeri
			</div>
			<div class="box-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" placeholder="Keterangan"
							class="input-control"><?= $p->keterangan ?></textarea>
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<img src="../uploads/galeri/<?= $p->foto ?>" width="200" class="image" />
						<input type="hidden" name="gambar2" value="<?= $p->foto ?>" class="input-control" />
						<input type="file" name="gambar" class="input-control" />
					</div>
					<button class="btn" onclick="window.location = 'galeri.php'">Kembali</button>
					<input type="submit" name="submit" value="Simpan" class="btn btn-blue" />
				</form>

				<?php
					if (isset($_POST['submit'])){
						$ket = addslashes(ucwords($_POST['keterangan']));

						if($_FILES['gambar']['name'] != ''){
							$filename = $_FILES['gambar']['name'];
							$tmpname = $_FILES['gambar']['tmp_name'];
							$filesize	= $_FILES['gambar']['size'];

							$format = pathinfo($filename, PATHINFO_EXTENSION);
							$rename = 'galeri' . time() . '.' . $format;

							$allowed_type = ['png','jpg','jpeg','gif'];

							if(!in_array($format, $allowed_type)){
								echo '<div class="alert alert-error">
									Format file tidak diizinkan!
								</div>';
								return false;
							} elseif($filesize > 1000000){
								echo '<div class="alert alert-error">
									Ukuran file tidak boleh lebih dari 1 Mb!
								</div>';
								return false;
							} else {
								move_uploaded_file($tmpname, "../uploads/galeri/$rename");

								$simpan = mysqli_query($conn, "INSERT INTO galeri VALUES(
									'',
									'$rename',
									'$ket',
									'',
									''
								)");

								if($simpan){
									echo '<div class="alert alert-success">
										Berhasil menyimpan!
									</div>';
								} else {
									echo '<div class="alert alert-error">
										Gagal menyimpan!
									</div>';
								}
							}

							if(file_exists("../uploads/galeri/{$_POST['gambar2']}")){
								unlink("../uploads/galeri/{$_POST['gambar2']}");
							}

							move_uploaded_file($tmpname, "../uploads/galeri/$rename");

						} else {
							$rename = $_POST['gambar2'];
						}

						$update = mysqli_query($conn, "UPDATE galeri SET
							foto = '$rename',
							keterangan = '$ket'
							WHERE id = {$_GET['idgaleri']}
						");

						if($update){
							echo '<script>
								window.location = "galeri.php?msg=Edit data berhasil!";
							</script>';
						} else {
							echo '<div class="alert alert-error">
								Gagal mengubah data!
							</div>';
						}
					}
				?>

			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
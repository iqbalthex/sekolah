<?php include 'header.php'; ?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Tambah Informasi
			</div>
			<div class="box-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judul" placeholder="Judul" class="input-control" required />
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" placeholder="Keterangan" class="input-control"></textarea>
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<input type="file" name="gambar" class="input-control" />
					</div>
					<button class="btn" onclick="window.location = 'informasi.php'">Kembali</button>
					<input type="submit" name="submit" value="Simpan" class="btn btn-blue" />
				</form>

				<?php
					if (isset($_POST['submit'])){
						$judul = addslashes(ucwords($_POST['judul']));
						$ket = addslashes($_POST['keterangan']);

						$filename = $_FILES['gambar']['name'];
						$tmpname = $_FILES['gambar']['tmp_name'];
						$filesize	= $_FILES['gambar']['size'];

						$format = pathinfo($filename, PATHINFO_EXTENSION);
						$rename = 'informasi' . time() . '.' . $format;

						$allowed_type = ['png','jpg','jpeg','gif'];

						if(!in_array($format, $allowed_type)){
							echo '<div class="alert alert-error">Format file tidak diizinkan!</div>';
						} elseif($filesize > 1000000){
							echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 Mb!</div>';
						} else {
							move_uploaded_file($tmpname, "../uploads/informasi/$rename");

							$simpan = mysqli_query($conn, "INSERT INTO informasi VALUES(
								'',
								'$judul',
								'$ket',
								'$rename',
								'',
								'',
								'{$_SESSION['uid']}'
							)");

							if($simpan){
								echo '<script>window.location = "informasi.php?msg=Berhasil menyimpan!";</script>';
							} else {
								echo '<div class="alert alert-error">Gagal menyimpan!</div>';
							}
						}
					}
				?>

			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
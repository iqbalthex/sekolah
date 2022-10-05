<!-- mirip file edit-pengguna.php -->

<?php

include 'header.php';

$jurusan = mysqli_query($conn,
	"SELECT  * FROM jurusan WHERE id = {$_GET['idjurusan']}"
);
if(mysqli_num_rows($jurusan) == 0){
	echo '<script>window.location = "jurusan.php"</script>';
}
$p = mysqli_fetch_object($jurusan);

?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Edit Jurusan
			</div>
			<div class="box-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" placeholder="Nama Jurusan"
							class="input-control" value="<?= $p->nama ?>" required />
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" placeholder="Keterangan"
							class="input-control"><?= $p->keterangan ?></textarea>
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<img src="../uploads/jurusan/<?= $p->gambar ?>" width="200" class="image" />
						<input type="hidden" name="gambar2" value="<?= $p->gambar ?>" class="input-control" />
						<input type="file" name="gambar" class="input-control" />
					</div>
					<button class="btn" onclick="window.location = 'jurusan.php'">Kembali</button>
					<input type="submit" name="submit" value="Simpan" class="btn btn-blue" />
				</form>

				<?php
					if (isset($_POST['submit'])){
						$nama = addslashes(ucwords($_POST['nama']));
						$ket = addslashes($_POST['keterangan']);

						if($_FILES['gambar']['name'] != ''){
							$filename = $_FILES['gambar']['name'];
							$tmpname = $_FILES['gambar']['tmp_name'];
							$filesize	= $_FILES['gambar']['size'];

							$format = pathinfo($filename, PATHINFO_EXTENSION);
							$rename = 'jurusan' . time() . '.' . $format;

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
								move_uploaded_file($tmpname, "../uploads/jurusan/$rename");

								$simpan = mysqli_query($conn, "INSERT INTO jurusan VALUES(
									'',
									'$nama',
									'$ket',
									'$rename',
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

							if(file_exists("../uploads/jurusan/{$_POST['gambar2']}")){
								unlink("../uploads/jurusan/{$_POST['gambar2']}");
							}

							move_uploaded_file($tmpname, "../uploads/jurusan/$rename");

						} else {
							$rename = $_POST['gambar2'];
						}

						$update = mysqli_query($conn, "UPDATE jurusan SET
							nama = '$nama',
							keterangan = '$ket',
							gambar = '$rename'
							WHERE id = {$_GET['idjurusan']}
						");

						if($update){
							echo '<script>
								window.location = "jurusan.php?msg=Edit data berhasil!";
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
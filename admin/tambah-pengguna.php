<?php include 'header.php'; ?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Tambah Pengguna
			</div>
			<div class="box-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" required />
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="user" placeholder="Username" class="input-control" required />
					</div>
					<div class="form-group">
						<label>Level</label>
						<select name="level" class="input-control" required>
							<option value="">Pilih</option>
							<option value="Super Admin">Super Admin</option>
							<option value="Admin">Admin</option>
						</select>
					</div>
					<button class="btn" onclick="window.location = 'pengguna.php'">Kembali</button>
					<input type="submit" name="submit" value="Simpan" class="btn btn-blue" />
				</form>

				<?php
					if (isset($_POST['submit'])){
						$nama = addslashes(ucwords($_POST['nama']));
						$user = addslashes($_POST['user']);
						$level = $_POST['level'];
						$pass = md5('123456');
						$curr_date = date('Y-m-d H:i:s');

						# cek apakah username sudah digunakan atau belum
						$cek = mysqli_query($conn,
							"SELECT username FROM pengguna WHERE username = '$user'"
						);
						if(mysqli_num_rows($cek) > 0){
							echo '<div class="alert alert-error">
								Username sudah digunakan!
							</div>';
						} else {
							$simpan = mysqli_query($conn, "INSERT INTO pengguna VALUES(
								'',
								'$nama',
								'$user',
								'$pass',
								'$level',
								'',
								''
							)");

							if($simpan){
								echo '<script>
									window.location = "pengguna.php?msg=Berhasil menyimpan!";
								</script>';
							} else {
								echo '<div class="alert alert-error">
									Gagal menyimpan!
								</div>';
							}
						}
					}
				?>

			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
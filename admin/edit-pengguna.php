<?php

include 'header.php';

$pengguna = mysqli_query($conn, "SELECT  * FROM pengguna WHERE id = {$_GET['id']}");
if(mysqli_num_rows($pengguna) == 0){
	echo '<script>window.location = "pengguna.php"</script>';
}
$p = mysqli_fetch_object($pengguna);

?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Edit Pengguna
			</div>
			<div class="box-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" placeholder="Nama Lengkap"
							class="input-control" value="<?= $p->nama ?>" required />
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="user" placeholder="Username"
							class="input-control" value="<?= $p->username ?>" required />
					</div>
					<div class="form-group">
						<label>Level</label>
						<select name="level" class="input-control" required>
							<option value="">Pilih</option>
							<option value="Super Admin"
								<?= $p->level == 'Super Admin' ? 'selected' : '' ?>>Super Admin</option>
							<option value="Admin"
								<?= $p->level == 'Admin' ? 'selected' : '' ?>>Admin</option>
						</select>
					</div>
					<!--button class="btn" onclick="window.location = 'pengguna.php'">Kembali</button-->
					<button class="btn"><a href="pengguna.php">Kembali</a></button>
					<input type="submit" name="submit" value="Simpan" class="btn btn-blue" />
				</form>

				<?php
					if (isset($_POST['submit'])){
						$nama = addslashes(ucwords($_POST['nama']));
						$user = addslashes($_POST['user']);
						$level = $_POST['level'];
						$curr_date = date('Y-m-d H:i:s');

						$update = mysqli_query($conn, "UPDATE pengguna SET
							nama = '$nama',
							username = '$user',
							level = '$level',
							updated_at = '$curr_date'
							WHERE id = {$_GET['id']}
						");

						if($update){
							echo '<div class="alert alert-success">Berhasil mengubah data!</div>';
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
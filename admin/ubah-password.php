<!-- mirip file edit-pengguna.php -->

<?php include 'header.php'; ?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Ubah Password
			</div>
			<div class="box-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="pass1" placeholder="Password"
							class="input-control" required />
					</div>
					<div class="form-group">
						<label>Ulangi password</label>
						<input type="password" name="pass2" placeholder="Ulangi password"
							class="input-control" required />
					</div>
					<input type="submit" name="submit" value="Ubah password" class="btn btn-blue" />
				</form>

				<?php
					if (isset($_POST['submit'])){
						$pass1 = addslashes($_POST['pass1']);
						$pass2 = addslashes($_POST['pass2']);
						$curr_date = date('Y-m-d H:i:s');

						if($pass1 != $pass2){
							echo '<div class="alert alert-error">
								Ulangi password tidak sesuai!
							</div>';
						} else {
							$update = mysqli_query($conn, "UPDATE pengguna SET
								password		= '" . md5($pass1) . "',
								updated_at	= '$curr_date'
								WHERE id		= {$_SESSION['uid']}
							");

							if($update){
								echo '<div class="alert alert-success">
									Berhasil mengubah password!
								</div>';
							} else {
								echo '<div class="alert alert-error">
									Gagal mengubah password!
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
<?php
	session_start();
	include 'koneksi.php'; # menyisipkan kode di dalam file koneksi.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Halaman Login</title>
	<link type="text/css" rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="page-login">
	<div class="box box-login">
		<div class="box-header text-center">
			Login
		</div>
		<div class="box-body">
			<?php
				if (isset($_GET['msg'])){ # menampilkan pesan bila perlu
					echo "<div class='alert alert-error'>{$_GET['msg']}</div>";
				}
			?>
			<form action="" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="user" placeholder="Username" class="input-control" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="pass" placeholder="Password" class="input-control" />
				</div>
				<input type="submit" name="submit" value="Login" class="btn" />
			</form>

			<?php
				if(isset($_POST['submit'])){
					$user = mysqli_real_escape_string($conn, $_POST['user']);
					$pass = $_POST['pass'];

					$cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$user'");
					if(mysqli_num_rows($cek) > 0){
						$d = mysqli_fetch_object($cek);
						if(md5($pass) == $d->password){
							$_SESSION['status_login'] = true;
							$_SESSION['uid']          = $d->id;
							$_SESSION['uname']        = $d->nama;
							$_SESSION['ulevel']				= $d->level;

							# mengarahkan ke halaman admin bila berhasil login
							echo "<script>
								window.location = 'admin';
							</script>";
						} else {
							echo '<div class="alert alert-error">Password salah</div>';
						}
					} else {
						echo '<div class="alert alert-error">Username tidak ditemukan</div>';
					}
				}
			?>
		</div>
		<div class="box-footer text-center">
			<a href="index.php">Halaman Utama</a>
		</div>
	</div>
</div>
</body>
</html>

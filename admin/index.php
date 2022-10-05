<!-- menyisipkan isi dari file header.php -->
<?php include 'header.php'; ?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Dashboard
			</div>
			<div class="box-body">
				<h3>Selamat Datang <?= $_SESSION['uname'] ?> di Panel Admin Nama Sekolah</h3>
			</div>
		</div>
	</div>
</div>

<!-- menyisipkan isi dari file footer.php -->
<?php include 'footer.php'; ?>
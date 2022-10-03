<?php include 'header.php'; ?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Galeri
			</div>
			<div class="box-body">

				<a href="tambah-galeri.php" class="text-green">+ Tambah Galeri</a>

				<?php
					if (isset($_GET['msg'])){
						echo "<div class='alert alert-success'>{$_GET['msg']}</div>";
					}
				?>

				<form action="">
					<div class="input-group">
						<input type="text" name="key" placeholder="pencarian" />
						<button type="submit">Cari</button>
					</div>
				</form>

				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Foto</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;

							$where = " WHERE 1=1";
							if (isset($_GET['key'])){
								$where .= " AND keterangan LIKE '%" . addslashes($_GET['key']) . "%'";
							}

							$galeri = mysqli_query($conn, "SELECT * FROM galeri $where ORDER BY id DESC");
							if (mysqli_num_rows($galeri) > 0){
								while($p = mysqli_fetch_array($galeri)){
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><img src="../uploads/galeri/<?= $p['foto'] ?>" width="100" /></td>
								<td><?= $p['keterangan'] ?></td>
								<td>
									<a href="edit-galeri.php?idgaleri=<?= $p['id'] ?>"
										title="Edit data" class="text-orange">Edit</a>
									<a href="hapus.php?idgaleri=<?= $p['id'] ?>"
										onclick="return confirm('Yakin ingin menghapus?')"
										title="Hapus data" class="text-red">Hapus</a>
								</td>
							</tr>
						<?php }} else { ?>
						<tr>
							<td colspan="4">Data tidak ada</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
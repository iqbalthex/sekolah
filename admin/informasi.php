<!-- mirip file pengguna.php -->

<?php include 'header.php'; ?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Informasi
			</div>
			<div class="box-body">

				<a href="tambah-informasi.php" class="text-green">+ Tambah Informasi</a>

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
							<th>Judul</th>
							<th>Keterangan</th>
							<th>Gambar</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;

							$where = " WHERE 1=1";
							if (isset($_GET['key'])){
								$where .= " AND judul LIKE '%" . addslashes($_GET['key']) . "%'";
							}

							$informasi = mysqli_query($conn, "SELECT * FROM informasi $where ORDER BY id DESC");
							if (mysqli_num_rows($informasi) > 0){
								while($p = mysqli_fetch_array($informasi)){
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $p['judul'] ?></td>
								<td><?= substr($p['keterangan'], 0, 50) . '...' ?></td>
								<td>
									<img src="../uploads/informasi/<?= $p['gambar'] ?>" width="100" />
								</td>
								<td>
									<a href="edit-informasi.php?idinformasi=<?= $p['id'] ?>"
										title="Edit data" class="text-orange">Edit</a>
									<a href="hapus.php?idinformasi=<?= $p['id'] ?>"
										onclick="return confirm('Yakin ingin menghapus?')"
										title="Hapus data" class="text-red">Hapus</a>
								</td>
							</tr>
						<?php }} else { ?>
						<tr>
							<td colspan="5">Data tidak ada</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
<?php include 'header.php'; ?>

<div class="content">
	<div class="container">
		<div class="box">
			<div class="box-header">
				Jurusan
			</div>
			<div class="box-body">

				<a href="tambah-jurusan.php" class="text-green">+ Tambah Jurusan</a>

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
							<th>Nama</th>
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
								$where .= " AND nama LIKE '%" . addslashes($_GET['key']) . "%'";
							}

							$jurusan = mysqli_query($conn, "SELECT * FROM jurusan $where ORDER BY id DESC");
							if (mysqli_num_rows($jurusan) > 0){
								while($p = mysqli_fetch_array($jurusan)){
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $p['nama'] ?></td>
								<td><?= $p['keterangan'] ?></td>
								<td>
									<img src="../uploads/jurusan/<?= $p['gambar'] ?>" width="100" />
								</td>
								<td>
									<a href="edit-jurusan.php?idjurusan=<?= $p['id'] ?>"
										title="Edit data" class="text-orange">Edit</a>
									<a href="hapus.php?idjurusan=<?= $p['id'] ?>"
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
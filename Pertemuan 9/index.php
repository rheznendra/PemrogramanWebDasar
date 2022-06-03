<?php
require_once("misc/database.php");
$query = $con->query("SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>19.4101.00059</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-10 mx-auto">
				<a href="create.php" class="btn btn-primary btn-sm mb-3">Add Data</a>
				<a href="kategori/index.php" class="btn btn-success btn-sm mb-3">List Kategori</a>
				<div class="card">
					<div class="card-header bg-primary fw-bold">
						<h5 class="card-title text-light mb-0">DAFTAR BARANG</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr class="text-center">
										<th>#</th>
										<th>Nama Barang</th>
										<th>Harga</th>
										<th>Stok</th>
										<th>Diskon</th>
										<th>Kategori</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($query->num_rows <= 0) { ?>
									<tr class="text-center">
										<td colspan="7">Tidak ada data untuk ditampilkan.</td>
									</tr>
									<?php } else { ?>
									<?php
									$no = 1;
									while($e = $query->fetch_assoc()) {
										$q2 = $con->query("SELECT nama FROM kategori WHERE id = '" . $e['id_kategori'] ."'");
										$ktg = $q2->fetch_assoc();
									?>
									<tr class="text-center">
										<td><?= $no++; ?>.</td>
										<td><?= $e['nama']; ?></td>
										<td>Rp<?= number_format($e['harga'], 0, '', '.'); ?></td>
										<td><?= number_format($e['stock'], 0, '', '.'); ?></td>
										<td><?= $e['diskon'] >= 1 ? $e['diskon'] . '%' : '-'; ?></td>
										<td><?= $ktg['nama']; ?></td>
										<td>
											<a href="edit.php?id=<?= substr($e['id'], -5); ?>"
												class="btn btn-warning btn-sm">Edit</a>
										</td>
									</tr>
									<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
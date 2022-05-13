<?php
session_start();
// session_unset();
// session_destroy();
$data = [];
if (isset($_SESSION['data'])) {
	$data = $_SESSION['data'];
}
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
										<th>Kode</th>
										<th>Nama Barang</th>
										<th>Harga</th>
										<th>Stok</th>
										<th>Diskon</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!count($data)) { ?>
									<tr class="text-center">
										<td colspan="7">Tidak ada data untuk ditampilkan.</td>
									</tr>
									<?php } ?>
									<?php
									$no = 1;
									foreach ($data as $idx => $e) {
									?>
									<tr class="text-center">
										<td><?= $no++; ?>.</td>
										<td><?= $e['kode'] ?></td>
										<td><?= $e['name']; ?></td>
										<td>Rp<?= number_format($e['price'], 0, '', '.'); ?></td>
										<td><?= number_format($e['stock'], 0, '', '.'); ?></td>
										<td><?= $e['disc'] >= 1 ? $e['disc'] . '%' : '-'; ?></td>
										<td>
											<a href="edit.php?kode=<?= substr($e['kode'], -5); ?>"
												class="btn btn-warning btn-sm">Edit</a>
										</td>
									</tr>
									<?php } ?>
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
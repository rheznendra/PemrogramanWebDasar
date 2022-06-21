<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
$query = $sql->query("SELECT j.id_jadwal, h.hari, p.poli, d.nama_dokter,
						DATE_FORMAT(j.jam_buka, '%H:%i') AS jam_buka, DATE_FORMAT(j.jam_tutup, '%H:%i') AS jam_tutup
						FROM jadwal j
						INNER JOIN dokter d ON j.id_dokter = d.id_dokter
						INNER JOIN hari h ON j.id_hari = h.id_hari
						INNER JOIN poli p ON j.id_poli = p.id_poli ORDER BY j.id_hari ASC, j.jam_buka ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rumah Sakit</title>
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/datatables.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/style.css">
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="//<?= $_SERVER['HTTP_HOST']; ?>/">Rumah Sakit</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end flex-grow-1" id="navbarCollapse">
					<ul class="navbar-nav mb-2 mb-md-0">
						<li class="nav-item">
							<a class="nav-link" href="//<?= $_SERVER['HTTP_HOST']; ?>/profil-dokter.php">Profil Dokter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="//<?= $_SERVER['HTTP_HOST']; ?>/jadwal-dokter.php">Jadwal Dokter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="//<?= $_SERVER['HTTP_HOST']; ?>/admin/">Admin</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main>
		<div class="bg-banner"></div>
		<div class="container marketing">
			<div class="row">
				<div class="col-12">
					<div class="card border shadow">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Hari</th>
											<th class="text-center">Poli</th>
											<th class="text-center">Nama Dokter</th>
											<th class="text-center">Jam Buka</th>
											<th class="text-center">Jam Tutup</th>
										</tr>
									</thead>
									<tbody class="text-center">
										<?php
										$no = 1;
										while ($data = $query->fetch_object()) { ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $data->hari; ?></td>
												<td><?= $data->poli; ?></td>
												<td><?= $data->nama_dokter; ?></td>
												<td><?= $data->jam_buka; ?></td>
												<td><?= $data->jam_tutup; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<hr class="featurette-divider">
			</div>
			<footer class="container">
				<p class="float-end"><a href="#">Back to top</a></p>
				<p>&copy; <?= date('Y'); ?> RZ.</p>
			</footer>
	</main>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/datatables.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/bootstrap.bundle.min.js"></script>
	<script>
		let table = new DataTable('.table', {
			language: {
				paginate: {
					first: '<span aria-hidden="true">&laquo;</span>',
					last: '<span aria-hidden="true">&raquo;</span>',
					previous: '<span aria-hidden="true">&laquo;</span>',
					next: '<span aria-hidden="true">&raquo;</span>'
				}
			},
			dom: "<'row'<'col-sm-6 col-12 mb-3 mb-sm-0 text-center text-sm-start'l><'col-sm-2 offset-sm-1 col-12 sel-hari'><'col-sm-3 col-12 text-center text-sm-end'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6 col-12 text-center text-sm-start mb-3'i><'col-sm-6 col-12 mb-3'p>>",
			order: [
				[1, 'asc']
			]
		})
		let sel = document.createElement('label')
		sel.innerHTML = `Hari: <select class="form-control ms-1 d-inline-block w-auto" id="sel-hari"><option value="">Pilih</option> <option value="1" >Senin</option><option value="2" >Selasa</option><option value="3" >Rabu</option><option value="4" >Kamis</option><option value="5" >Jumat</option><option value="6" >Sabtu</option><option value="7" >Minggu</option></select>`;
		document.getElementsByClassName('sel-hari')[0].appendChild(sel);
		document.getElementById('sel-hari').addEventListener('change', function(e) {
			if (this.value) {
				let s = e.target[this.value].outerText;
				table.columns(1).search(s).draw();
			} else {
				table
					.search('')
					.columns().search('')
					.draw();
			}
		})
	</script>
</body>

</html>
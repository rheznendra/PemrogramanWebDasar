<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rumah Sakit</title>
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
							<a class="nav-link active" href="//<?= $_SERVER['HTTP_HOST']; ?>/profil-dokter.php">Profil Dokter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="//<?= $_SERVER['HTTP_HOST']; ?>/jadwal-dokter.php">Jadwal Dokter</a>
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
			<?php if (!isset($_GET['id'])) { ?>
				<div class="row">
					<?php
					$query = $sql->query("SELECT * FROM dokter ORDER BY nama_dokter ASC");
					while ($data = $query->fetch_object()) {
					?>
						<div class="col-lg-4">
							<div class="card border shadow">
								<div class="card-body">
									<img class="bd-placeholder-img rounded-circle" width="140" height="140" src="https://ui-avatars.com/api/?name=<?= substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 2); ?>" />
								</div>
								<div class="card-footer">
									<a class="fw-normal h5 d-block text-decoration-none" href="?id=<?= $data->id_dokter; ?>"><?= $data->nama_dokter; ?></a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } else {
				$id = $_GET['id'];
				$query = $sql->query("SELECT * FROM dokter WHERE id_dokter = $id");
				$data = $query->fetch_object();
			?>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<div class="mx-auto">
							<img class="bd-placeholder-img rounded-circle" width="140" height="140" src="https://ui-avatars.com/api/?name=<?= substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 2); ?>" />
						</div>
					</div>
					<div class="col-md-7">
						<h5 class="fw-bold"><?= $data->nama_dokter; ?></h5>
						<p><?= $data->profil_singkat; ?></p>

						<h5 class="fw-bold">Riwayat Pendidikan</h5>
						<ul>
							<?php
							foreach (explode("\n", $data->riwayat_pendidikan) as $line) { ?>
								<li><?= $line; ?></li>
							<?php } ?>
						</ul>

						<h5 class="fw-bold">Riwayat Pekerjaan</h5>
						<ul>
							<?php
							foreach (explode("\n", $data->riwayat_pekerjaan) as $line) { ?>
								<li><?= $line; ?></li>
							<?php } ?>
						</ul>

						<h5 class="fw-bold">Pelatihan</h5>
						<ul>
							<?php
							foreach (explode("\n", $data->pelatihan) as $line) { ?>
								<li><?= $line; ?></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			<?php } ?>
			<hr class="featurette-divider">
		</div>
		<footer class="container">
			<p class="float-end"><a href="#">Back to top</a></p>
			<p>&copy; <?= date('Y'); ?> RZ.</p>
		</footer>
	</main>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
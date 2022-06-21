<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
$poli = $sql->query("SELECT COUNT(*) AS total FROM poli")->fetch_object()->total;
$dokter = $sql->query("SELECT COUNT(*) AS total FROM dokter")->fetch_object()->total;
$jadwal = $sql->query("SELECT COUNT(*) AS total FROM jadwal")->fetch_object()->total;
$data = [
	['title' => 'Poli', 'count' => $poli, 'icon' => 'hospitals', 'bg' => 'primary'],
	['title' => 'Dokter', 'count' => $dokter, 'icon' => 'user-doctor', 'bg' => 'danger'],
	['title' => 'Jadwal', 'count' => $jadwal, 'icon' => 'calendar-days', 'bg' => 'success'],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/fonts/font-awesome/all.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/style.css" rel="stylesheet">
</head>

<body>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/navbar.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<?php require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/sidebar.php'); ?>
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Dashboard</h1>
				</div>
				<div class="row">
					<?php
					foreach ($data as $index => $e) {
					?>
						<div class="col-xl-4 col-sm-6 col-12 mb-4">
							<div class="card shadow border-0">
								<div class="card-body">
									<div class="d-flex justify-content-between px-md-1">
										<div class="align-self-center">
											<i class="fas fa-<?= $e['icon']; ?> text-<?= $e['bg']; ?> fa-3x"></i>
										</div>
										<div class="text-end">
											<h3><?= $e['count']; ?></h3>
											<p class="mb-0"><?= $e['title']; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</main>
		</div>
	</div>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/bootstrap.bundle.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/main.js"></script>
</body>

</html>
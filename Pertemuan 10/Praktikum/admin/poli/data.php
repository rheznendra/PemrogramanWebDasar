<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = $sql->query("SELECT * FROM poli WHERE id_poli = '$id'");
	if ($query->num_rows == 0) {
		header('location:index.php');
	} else {
		$data = $query->fetch_object();
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Poli - Admin</title>
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/fonts/font-awesome/all.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/style.css">
</head>

<body>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/navbar.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<?php require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/sidebar.php'); ?>
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Poli</h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<a href="index.php" class="btn btn-primary">
							<i class="fa-solid fa-chevron-double-left"></i> Back
						</a>
					</div>
				</div>
				<div class="card border-0 shadow">
					<div class="card-body">
						<?php require('form.php'); ?>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/bootstrap.bundle.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/axios.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/sweetalert.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/main.js"></script>
	<script>
		let submit = document.getElementById('submit')

		submit.addEventListener('click', () => {
			createAPI()
		})

		let createAPI = () => {
			let msg = document.getElementById('msg');
			msg.classList.remove('d-block');
			let poli = document.getElementById('poli')
			let type = <?= !isset($data) ? "'CREATE'" : "'UPDATE'"; ?>;
			let params = {
				type: type,
				poli: poli.value,
			};
			if (type == 'UPDATE') {
				params.id = <?= $data->id_poli ?? '0'; ?>;
			}
			axios({
					method: 'POST',
					url: 'API.php',
					data: params,
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then((response) => {
					if (response.data.code == 201 || response.data.code == 200) {
						Swal.fire('Sukses!', response.data.msg, 'success')
						if (response.data.code == 201) {
							poli.value = null
						}
					} else if (response.data.code == 412) {
						msg.innerHTML = response.data.msg;
						msg.classList.add('d-block');
					} else {
						Swal.fire('Gagal!', response.data.msg, 'error')
					}
				})
				.catch((error) => {
					Swal.fire('Terjadi Kesalahan!', 'Data gagal ditambahkan.', 'info')
				})
		}
	</script>
</body>

</html>
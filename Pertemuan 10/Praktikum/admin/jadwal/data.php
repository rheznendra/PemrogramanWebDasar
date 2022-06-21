<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = $sql->query("SELECT * FROM jadwal WHERE id_jadwal = '$id'");
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
	<title>Jadwal - Admin</title>
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/fonts/font-awesome/all.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/slimselect.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/style.css">
</head>

<body>
	<?php require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/navbar.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<?php require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/sidebar.php'); ?>
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Jadwal</h1>
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
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/slimselect.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/main.js"></script>
	<script>
		const elementsList = document.querySelectorAll("#hari, #poli, #dokter");
		const elementsArray = [...elementsList];
		elementsArray.forEach(element => {
			new SlimSelect({
				select: element,
			})
		});
		let submit = document.getElementById('submit')

		submit.addEventListener('click', () => {
			createAPI()
		})

		let createAPI = () => {
			document.querySelectorAll('.error-msg').forEach((el) => {
				el.classList.remove('d-block')
			})
			let hari = document.getElementById('hari')
			let poli = document.getElementById('poli')
			let dokter = document.getElementById('dokter')
			let jam_buka = document.getElementById('jam_buka')
			let jam_tutup = document.getElementById('jam_tutup')

			let type = <?= !isset($data) ? "'CREATE'" : "'UPDATE'"; ?>;
			let params = {
				type: type,
				hari: hari.value,
				poli: poli.value,
				dokter: dokter.value,
				jam_buka: jam_buka.value,
				jam_tutup: jam_tutup.value,
			};
			if (type == 'UPDATE') {
				params.id = <?= $data->id_jadwal ?? '0'; ?>;
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
							hari.value = null
							poli.value = null
							dokter.value = null
							jam_buka.value = null
							jam_tutup.value = null
						}
					} else if (response.data.code == 412) {
						showErrMsg(response.data.msg);
					} else {
						Swal.fire('Gagal!', response.data.msg, 'error')
					}
				})
				.catch((error) => {
					Swal.fire('Terjadi Kesalahan!', 'Data gagal ditambahkan.', 'info')
				})
		}

		const showErrMsg = (param) => {
			if (param.hari) {
				let hariEl = document.getElementById('hari').nextElementSibling.nextElementSibling;
				hariEl.innerHTML = param.hari
				hariEl.classList.add('d-block')
			}
			if (param.poli) {
				let poliEl = document.getElementById('poli').nextElementSibling.nextElementSibling
				poliEl.innerHTML = param.poli
				poliEl.classList.add('d-block')
			}
			if (param.dokter) {
				let dokterEl = document.getElementById('dokter').nextElementSibling.nextElementSibling
				dokterEl.innerHTML = param.dokter
				dokterEl.classList.add('d-block')
			}
			if (param.jam_buka) {
				let jam_bukaEl = document.getElementById('jam_buka').nextElementSibling
				jam_bukaEl.innerHTML = param.jam_buka
				jam_bukaEl.classList.add('d-block')
			}
			if (param.jam_tutup) {
				let jam_tutupEl = document.getElementById('jam_tutup').nextElementSibling
				jam_tutupEl.innerHTML = param.jam_tutup
				jam_tutupEl.classList.add('d-block')
			}
		}
	</script>
</body>

</html>
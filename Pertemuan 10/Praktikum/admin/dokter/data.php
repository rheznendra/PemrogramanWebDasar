<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = $sql->query("SELECT * FROM dokter WHERE id_dokter = '$id'");
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
	<title>Dokter - Admin</title>
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
					<h1 class="h2">Dokter</h1>
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
			document.querySelectorAll('.error-msg').forEach((el) => {
				el.classList.remove('d-block')
			})
			let nama_dokter = document.getElementById('nama_dokter')
			let profil_singkat = document.getElementById('profil_singkat')
			let riwayat_pendidikan = document.getElementById('riwayat_pendidikan')
			let riwayat_pekerjaan = document.getElementById('riwayat_pekerjaan')
			let pelatihan = document.getElementById('pelatihan')

			let type = <?= !isset($data) ? "'CREATE'" : "'UPDATE'"; ?>;
			let params = {
				type: type,
				nama_dokter: nama_dokter.value,
				profil_singkat: profil_singkat.value,
				riwayat_pendidikan: riwayat_pendidikan.value,
				riwayat_pekerjaan: riwayat_pekerjaan.value,
				pelatihan: pelatihan.value,
			};
			if (type == 'UPDATE') {
				params.id = <?= $data->id_dokter ?? '0'; ?>;
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
							nama_dokter.value = null
							profil_singkat.value = null
							riwayat_pendidikan.value = null
							riwayat_pekerjaan.value = null
							pelatihan.value = null
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
			if (param.nama_dokter) {
				let nama_dokterEl = document.getElementById('nama_dokter').nextElementSibling;
				nama_dokterEl.innerHTML = param.nama_dokter
				nama_dokterEl.classList.add('d-block')
			}
			if (param.profil_singkat) {
				let profil_singkatEl = document.getElementById('profil_singkat').nextElementSibling;
				profil_singkatEl.innerHTML = param.profil_singkat
				profil_singkatEl.classList.add('d-block')
			}
			if (param.riwayat_pendidikan) {
				let riwayat_pendidikanEl = document.getElementById('riwayat_pendidikan').nextElementSibling;
				riwayat_pendidikanEl.innerHTML = param.riwayat_pendidikan
				riwayat_pendidikanEl.classList.add('d-block')
			}
			if (param.riwayat_pekerjaan) {
				let riwayat_pekerjaanEl = document.getElementById('riwayat_pekerjaan').nextElementSibling;
				riwayat_pekerjaanEl.innerHTML = param.riwayat_pekerjaan
				riwayat_pekerjaanEl.classList.add('d-block')
			}
			if (param.pelatihan) {
				let pelatihanEl = document.getElementById('pelatihan').nextElementSibling;
				pelatihanEl.innerHTML = param.pelatihan
				pelatihanEl.classList.add('d-block')
			}
		}
	</script>
</body>

</html>
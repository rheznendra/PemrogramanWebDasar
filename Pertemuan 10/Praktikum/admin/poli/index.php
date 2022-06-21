<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Poli - Admin</title>
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/fonts/font-awesome/all.min.css">
	<link rel="stylesheet" href="//<?= $_SERVER['HTTP_HOST']; ?>/assets/css/datatables.min.css">
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
						<a href="data.php" class="btn btn-primary">
							<i class="fa-solid fa-square-plus"></i> Add Data
						</a>
					</div>
				</div>
				<div class="card border-0 shadow">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Nama Poli</th>
										<th class="text-center">#</th>
									</tr>
								</thead>
								<tbody class="text-center"></tbody>
							</table>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/datatables.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/bootstrap.bundle.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/axios.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/sweetalert.min.js"></script>
	<script src="//<?= $_SERVER['HTTP_HOST']; ?>/assets/js/main.js"></script>
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
			dom: "<'row'<'col-sm-6 col-12 mb-3 mb-sm-0 text-center text-sm-start'l><'col-sm-6 col-12 text-center text-sm-end'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6 col-12 text-center text-sm-start mb-3'i><'col-sm-6 col-12 mb-3'p>>",
			ajax: {
				type: 'POST',
				url: 'API.php',
				data: {
					type: 'GET_DATA'
				},
				dataSrc: 'data'
			},
			columns: [{
					data: 'id_poli'
				},
				{
					data: 'poli'
				},
				{
					data: null,
					render: (data, type, row) => {
						return `<a href="data.php?id=${data.id_poli}" class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip" title="Ubah"><i class="fa fa-pencil-alt"></i></a><button class="btn btn-sm btn-danger btn-delete" data-bs-toggle="tooltip" title="Hapus" data-id="${data.id_poli}"><i class="fa fa-trash-can"></i></button>`;
					}
				}
			],
			columnDefs: [{
				searchable: false,
				orderable: false,
				targets: [0, 2],
			}, ],
			order: [
				[1, 'asc']
			]
		})
		table.on('order.dt search.dt', () => {
			let i = 1;

			table.cells(null, 0, {
				search: 'applied',
				order: 'applied'
			}).every(function(cell) {
				this.data(i++);
			});
		}).draw();

		table.on('draw', () => {
			let delElem = document.querySelectorAll('.btn-delete');
			delElem.forEach(el => el.addEventListener('click', event => {
				let id = event.currentTarget.getAttribute('data-id');
				confirmDelete(id)
			}))
		})

		const confirmDelete = (id) => {
			Swal.fire({
				icon: 'warning',
				title: 'Apakah anda yakin?',
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
						icon: 'info',
						title: 'Loading...',
						allowOutsideClick: false,
						allowEscapeKey: false,
						didOpen: () => {
							Swal.showLoading()
						}
					});
					delAPI(id)
				}
			})
		}

		let delAPI = (id) => {
			axios({
					method: 'POST',
					url: 'API.php',
					data: {
						type: 'DELETE',
						id: id,
					},
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then((response) => {
					if (response.data.code == 200) {
						table.ajax.reload(null, false)
						Swal.fire('Sukses!', response.data.msg, 'success')
					} else {
						Swal.fire('Gagal!', response.data.msg, 'error')
					}
				})
				.catch((error) => {
					Swal.fire('Terjadi Kesalahan!', 'Data gagal dihapus.', 'info')
				})
		}
	</script>
</body>

</html>
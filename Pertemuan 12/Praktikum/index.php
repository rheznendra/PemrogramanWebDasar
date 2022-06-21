<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pertemuan 12</title>
	<link rel="stylesheet" href="assets/fonts/font-awesome/all.min.css">
	<link rel="stylesheet" href="assets/css/datatables.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-8 mx-auto mt-5">
					<a class="btn btn-primary me-3" href="javascript:;">
						<i class="fa-solid fa-plus-square"></i> Add Data
					</a>
					<button class="btn btn-light" id="refresh">
						<i class="fa-solid fa-refresh"></i> Refresh Data
					</button>
					<div class="card shadow-sm border-0 mt-3">
						<div class="card-body">
							<div class="table-responsive overflow-hidden">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th></th>
											<th>NIM</th>
											<th>Nama</th>
											<th>Tanggal Lahir</th>
											<th>Program Studi</th>
											<th>#</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script src="assets/js/datatables.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/axios.min.js"></script>
	<script src="assets/js/sweetalert.min.js"></script>
	<script>
		let table = new DataTable('.table', {
			ajax: {
				url: 'function/getData.php',
				dataSrc: 'data'
			},
			columns: [{
					data: null
				},
				{
					data: 'nim',
				},
				{
					data: 'nama'
				},
				{
					data: 'tgl_lahir'
				},
				{
					data: 'program_studi'
				},
				{
					data: null,
					render: (data, type, row) => {
						return `<a href="edit.php?nim=${data.nim}" class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip" title="Ubah"><i class="fa fa-pencil-alt"></i></a><button class="btn btn-sm btn-danger btn-delete" data-bs-toggle="tooltip" title="Hapus" data-id="${data.nim}"><i class="fa fa-trash-can"></i></button>`;
					}
				}
			],
			columnDefs: [{
				searchable: false,
				orderable: false,
				targets: [0, -1],
			}],
			order: [
				[1, 'asc']
			]
		})
		table.on('order.dt search.dt', () => {
			let i = 1;

			table.column(0, {
				search: 'applied',
				order: 'applied'
			}).nodes().each((cell, i) => {
				cell.innerHTML = i + 1;
			});
		}).draw();

		document.getElementById('refresh').addEventListener('click', () => {
			table.ajax.reload();
		})
	</script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="col-5 mx-auto mt-3">
					<table class="table table-striped">
						<thead class="bg-primary">
							<tr>
								<th>#</th>
								<th>Jenis</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$num = 10;
								for ($i = 1; $i <= $num; $i++) {
							?>
							<tr>
								<td><?php echo $i; ?>.</td>
								<td><?php echo ($i % 2 == 0 ? 'Genap' : 'Ganjil'); ?></td>
							</tr>
							<?php
                                }
                            ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>

</html>
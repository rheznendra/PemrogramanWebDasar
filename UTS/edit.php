<?php
session_start();
require_once('misc/validate.php');

if (isset($_GET['kode'])) {

	$data = $_SESSION['data'];
	for ($i = 0; $i < count($data); $i++) {

		if ($data[$i]['kode'] == $_GET['kode']) {
			$data = $data[$i];
			break;
		}
		if ($i == count($data) - 1) {
			header("location:index.php");
		}
	}

	if (isset($error) && !$error) {
		foreach ($_SESSION['data'] as $index => $e) {
			if ($e['kode'] == $data['kode']) {
				$_SESSION['data'][$index]['name'] = $name;
				$_SESSION['data'][$index]['price'] = $price;
				$_SESSION['data'][$index]['stock'] = $stock;
				$_SESSION['data'][$index]['disc'] = $disc;

				$data = $_SESSION['data'][$index];
				break;
			}
		}
		$success = 2;
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
			<div class="col-8 mx-auto">
				<a href="index.php" class="btn btn-primary btn-sm mb-3">Back</a>
				<?php include('misc/alert.php'); ?>
				<form action="" method="post">
					<div class="card">
						<div class="card-header bg-primary fw-bold">
							<h5 class="card-title text-light mb-0">EDIT DATA</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-6 mt-lg-3 mt-0">
									<label for="name" class="form-label">Nama Barang</label>
									<input type="text" class="form-control" name="name"
										value="<?php echo $data['name']; ?>" autocomplete="off">
								</div>
								<div class="col-6 mt-3">
									<label for="price" class="form-label">Harga</label>
									<input type="number" class="form-control" name="price" min="1"
										value="<?php echo $data['price']; ?>" autocomplete="off">
								</div>
								<div class="col-6 mt-3">
									<label for="stock" class="form-label">Stok</label>
									<input type="number" class="form-control" name="stock" min="1"
										value="<?php echo $data['stock']; ?>" autocomplete="off">
								</div>
								<div class="col-6 mt-3">
									<label for="disc" class="form-label">Diskon (1-100%)</label>
									<input type="number" class="form-control" name="disc" min="1" max="100"
										value="<?php echo ($data['disc'] > 0 ? $data['disc'] : null); ?>"
										autocomplete="off">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php } ?>
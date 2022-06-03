<?php
require_once('misc/database.php');
require_once('misc/validate.php');

if (isset($_GET['id'])) {

	$id = $_GET['id'];
	$query = "SELECT * FROM barang WHERE id = '$id'";
	$sql = $con->query($query);

	if (isset($error) && !$error) {
		$id_ktg = $_POST['kategori'];
		$q = "UPDATE barang SET nama = '$name', harga = '$price', stock = stock + $stock, diskon = '$disc', id_kategori = '$id_ktg' WHERE id = '$id'";
		if($con->query($q) === TRUE) {
			$success = 2;
		}
	}

	if ($sql->num_rows == 0) {
		header("location:index.php");
	} else {
		$data = $sql->fetch_assoc();
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
										value="<?php echo $data['nama']; ?>" autocomplete="off">
								</div>
								<div class="col-6 mt-3">
									<label for="price" class="form-label">Harga</label>
									<input type="number" class="form-control" name="price" min="1"
										value="<?php echo $data['harga']; ?>" autocomplete="off">
								</div>
								<div class="col-6 mt-3">
									<label for="stock" class="form-label">Stok</label>
									<input type="number" class="form-control" name="stock" min="1"
										value="<?php echo $data['stock']; ?>" autocomplete="off">
								</div>
								<div class="col-6 mt-3">
									<label for="disc" class="form-label">Diskon (1-100%)</label>
									<input type="number" class="form-control" name="disc" min="1" max="100"
										value="<?php echo ($data['diskon'] > 0 ? $data['diskon'] : null); ?>"
										autocomplete="off">
								</div>
								<div class="col-12 mt-3">
									<label for="kategori" class="form-label">Kategori</label>
									<select class="form-select" name="kategori">
										<option value="">Pilih</option>
										<?php
										$q = $con->query("SELECT * FROM kategori");
										while($row = $q->fetch_assoc()) { ?>
										<option value="<?= $row['id']; ?>" <?= $data['id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama']; ?></option>
										<?php } ?>
									</select>
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
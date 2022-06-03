<?php
if (isset($_POST['submit'])) {
	$error = [];
	if (empty($_POST['name'])) {
		$error['name'] = 'Nama tidak boleh kosong.';
	} else {
		if (!preg_match("/^[A-Z][a-z]*(([,.] |[ '-])[A-Za-z][a-z]*)*(\.?)$/", $_POST['name'])) {
			$error['name'] = 'Format nama tidak valid.';
		} else {
			$name = $_POST['name'];
		}
	}

	if (empty($_POST['email'])) {
		$error['email'] = 'Email tidak boleh kosong.';
	} else {
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error['email'] = 'Format email tidak valid.';
		} else {
			$email = $_POST['email'];
		}
	}

	$web = null;
	if (!empty($_POST['web'])) {
		if (!filter_var($_POST['web'], FILTER_VALIDATE_URL)) {
			$error['web'] = 'Format url website tidak valid.';
		} else {
			$web = $_POST['web'];
		}
	}

	$comment = null;
	if (!empty($_POST['comment'])) {
		$comment = $_POST['comment'];
	}

	if (empty($_POST['gender'])) {
		$error['gender'] = 'Gender wajib dipilih.';
	} else {
		if (!in_array($_POST['gender'], [1, 2])) {
			$error['gender'] = 'Gender tidak valid.';
		} else {
			$gender = $_POST['gender'];
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Form</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="row mt-3">
			<div class="col-12 col-md-8 col-xl-6 mx-auto">
				<form action="" method="POST">
					<div class="card mt-3">
						<div class="card-header bg-primary">
							<h5 class="card-title text-light">Form</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-md-6 mt-3">
									<label for="name" class="form-label">Name*</label>
									<input type="text" class="form-control" name="name" required
										value="<?= isset($name) ? $name : null; ?>">
									<?php if (isset($error['name'])) { ?>
									<div class="invalid-feedback d-block">
										<?= $error['name']; ?>
									</div>
									<?php } ?>
								</div>
								<div class="col-12 col-md-6 mt-3">
									<label for="email" class="form-label">Email*</label>
									<input type="email" class="form-control" name="email" required
										value="<?= isset($email) ? $email : null; ?>">
									<?php if (isset($error['email'])) { ?>
									<div class="invalid-feedback d-block">
										<?= $error['email']; ?>
									</div>
									<?php } ?>
								</div>
								<div class="col-12 mt-3">
									<label for="web" class="form-label">Website</label>
									<input type="url" class="form-control" name="web"
										value="<?= isset($web) ? $web : null; ?>">
									<?php if (isset($error['web'])) { ?>
									<div class="invalid-feedback d-block">
										<?= $error['web']; ?>
									</div>
									<?php } ?>
								</div>
								<div class="col-12 mt-3">
									<label for="comment" class="form-label">Comment</label>
									<textarea name="comment" class="form-control"
										rows="3"><?= isset($comment) ? $comment : null; ?></textarea>
								</div>
								<div class="col-12 mt-3">
									<label for="gender" class="form-label">Gender*</label>
									<div class="d-block">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" required name="gender"
												id="gender-l" value="1"
												<?= isset($gender) && $gender == 1 ? 'checked' : null; ?>>
											<label class="form-check-label" for="gender-l">
												Laki-laki
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" required name="gender"
												id="gender-p" value="2"
												<?= isset($gender) && $gender == 2 ? 'checked' : null; ?>>
											<label class="form-check-label" for="gender-p">
												Perempuan
											</label>
										</div>
									</div>
									<?php if (isset($error['gender'])) { ?>
									<div class="invalid-feedback d-block">
										<?= $error['gender']; ?>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary" name="submit" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-12 col-md-4 col-xl-5">
				<div class="card my-3">
					<div class="card-header bg-primary">
						<h5 class="card-title text-light">Result</h5>
					</div>
					<div class="card-body">
						<?php if (isset($error) && !count($error)) { ?>
						<div class="d-block">
							<p class="fw-bold d-inline-block">Name : </p> <?= $name; ?>
						</div>
						<div class="d-block">
							<p class="fw-bold d-inline-block">Email : </p> <?= $email; ?>
						</div>
						<?php if (isset($web)) { ?>
						<div class="d-block">
							<p class="fw-bold d-inline-block">Web : </p> <?= $web; ?>
						</div>
						<?php } ?>
						<?php if (isset($comment)) { ?>
						<div class="d-block">
							<p class="fw-bold mb-1">Comment : </p> <?= $comment; ?>
						</div>
						<?php } ?>
						<div class="d-block">
							<p class="fw-bold d-inline-block">Gender : </p>
							<?= $gender == 1 ? 'Laki-laki' : 'Perempuan'; ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
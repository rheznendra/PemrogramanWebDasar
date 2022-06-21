<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link rel="stylesheet" href="fonts/font-awesome/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="d-flex" id="wrapper">
		<div class="bg-dark" id="sidebar-wrapper">
			<div class="sidebar-heading bg-dark text-light text-center">
				<a href="javascript:;" class="sidebar-title">Admin</a>
			</div>
			<div class="list-group list-group-flush">
				<a class="list-group-item list-group-item-action list-group-item-dark p-3 active" href="#!">Dashboard</a>
				<a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Barang</a>
				<a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Kategori</a>
				<a class="list-group-item list-group-item-action list-group-item-dark p-3" href="#!">Penjualan</a>
			</div>
		</div>
		<div id="page-content-wrapper" class="bg-dark bg-opacity-25">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container-fluid">
					<button class="btn btn-dark" id="sidebarToggle">
						<i class="fa-solid fa-bars"></i>
					</button>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ms-auto mt-2 mt-lg-0">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle text-light" id="navbarDropdown" href="javascript:;" role="button" data-bs-toggle="dropdown">John Doe</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a class="dropdown-item" href="#!">Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#!">Logout</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="container-fluid">
				<h1 class="mt-4">Simple Sidebar</h1>
				<p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
				<p>
					Make sure to keep all page content within the
					<code>#page-content-wrapper</code>
					. The top navbar is optional, and just for demonstration. Just create an element with the
					<code>#sidebarToggle</code>
					ID which will toggle the menu when clicked.
				</p>
			</div>
		</div>
	</div>
	<script src="fonts/font-awesome/all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
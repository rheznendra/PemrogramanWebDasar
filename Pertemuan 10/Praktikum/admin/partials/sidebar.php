<?php
$menu = [
	['url' => '', 'title' => 'Dashboard', 'icon' => 'house'],
	['url' => 'poli', 'title' => 'Poli', 'icon' => 'hospitals'],
	['url' => 'dokter', 'title' => 'Dokter', 'icon' => 'user-doctor'],
	['url' => 'jadwal', 'title' => 'Jadwal', 'icon' => 'calendar-days']
];
$currentActive = explode('/', $_SERVER['REQUEST_URI'])[2];
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
	<div class="position-sticky pt-3">
		<ul class="nav flex-column">
			<?php
			foreach ($menu as $index => $e) { ?>
				<li class="nav-item">
					<a class="nav-link<?= $currentActive == $e['url'] ? ' active' : null; ?>" href="//<?= $_SERVER['HTTP_HOST'] . '/admin/' . $e['url']; ?>">
						<i class="fa-light fa-<?= $e['icon']; ?>"></i>
						<?= $e['title']; ?>
					</a>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link" href="//<?= $_SERVER['HTTP_HOST']; ?>" target="blank">
					<i class="fa-light fa-globe"></i>
					Preview
				</a>
			</li>
		</ul>
	</div>
</nav>
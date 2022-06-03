<?php
if (isset($error) && $error) { ?>
<div class="alert alert-danger" role="alert">
	<h5 class="alert-heading">Error!</h5>
	<ul>
		<?php foreach ($msg as $e) { ?>
		<li><?= $e ?></li>
		<?php } ?>
	</ul>
</div>
<?php } ?>
<?php if (isset($success)) { ?>
<div class="alert alert-primary" role="alert">
	<h5 class="alert-heading">Success!</h5>
	<?php if ($success == 1) { ?>
	<p>Data berhasil ditambahkan.</p>
	<?php } ?>
	<?php if ($success == 2) { ?>
	<p>Data berhasil diubah.</p>
	<?php } ?>
</div>
<?php } ?>
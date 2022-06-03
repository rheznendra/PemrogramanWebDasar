<?php
if (isset($_POST['submit'])) {
	$error = false;

	$msg = [];
	if (empty($_POST['name'])) {
		$error = true;
		$msg[] = 'Nama kategori tidak boleh kosong.';
	} else {
		$name = $_POST['name'];
	}
}
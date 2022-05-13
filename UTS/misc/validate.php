<?php
if (isset($_POST['submit'])) {
	$error = false;

	$msg = [];
	if (empty($_POST['name'])) {
		$error = true;
		$msg[] = 'Nama barang tidak boleh kosong.';
	} else {
		$name = $_POST['name'];
	}

	//validasi harga
	if (empty($_POST['price'])) {
		$error = true;
		$msg[] = 'Harga tidak boleh kosong.';
	} else if (!is_numeric($_POST['price'])) {
		$error = true;
		$msg[] = 'Format harga tidak valid.';
	} else {
		$price = $_POST['price'];
	}

	//validasi stok
	if (empty($_POST['stock'])) {
		$error = true;
		$msg[] = 'Stock tidak boleh kosong.';
	} else if (!is_numeric($_POST['stock'])) {
		$error = true;
		$msg[] = 'Format stock tidak valid.';
	} else {
		$stock = $_POST['stock'];
	}

	//validasi diskon
	$disc = 0;
	if (!empty($_POST['disc'])) {
		if (!($_POST['disc'] >= 1 && $_POST['disc'] <= 100)) {
			$error = true;
			$msg[] = 'Diskon tidak valid.';
		} else {
			$disc = $_POST['disc'];
		}
	}
}

function genKode()
{
	$param = 'qwertyuiopasdfghjklzxcvbnm1234567890';
	$text = '';
	for ($i = 0; $i < 5; $i++) {
		$text .= $param[rand(0, strlen($param) - 1)];
	}
	return strtoupper($text);
}
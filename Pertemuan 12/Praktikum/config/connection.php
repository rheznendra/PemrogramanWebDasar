<?php
$sql = new mysqli('localhost', 'root', null, 'pweb_prak');

if ($sql->connect_error) {
	die($sql->connect_error);
}

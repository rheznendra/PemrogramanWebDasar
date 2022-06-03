<?php
$con = new mysqli('localhost', 'root', null, 'prak_pweb');

if ($con->error) {
	die('Failed to connect database : ' . $con->connect_error);
}
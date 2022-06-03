<?php
$con = new mysqli('localhost', 'root', null, 'pwd');

if ($con->error) {
	die('Failed to connect database : ' . $con->connect_error);
}
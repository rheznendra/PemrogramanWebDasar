<?php

$sql = new mysqli("localhost", "root", null, "prak_pweb");

if ($sql->connect_error) {
	die($sql->connect_error);
}

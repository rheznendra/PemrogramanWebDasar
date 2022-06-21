<?php
require_once('../config/connection.php');

$i = 0;
$response = $data = [];
$query = $sql->query("SELECT * FROM mahasiswa ORDER BY nim ASC");

while ($e = $query->fetch_object()) {
	$data[$i++] = $e;
}

$response['data'] = $data;

print_r(json_encode($response));

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

$response = ['code' => 403];

if (isset($_POST['type'])) {

	if ($_POST['type'] == 'GET_DATA') {

		$response = ['data' => getData()];
	} else if ($_POST['type'] == "CREATE") {

		if (validateForm() == 201) {
			if (createData($_POST['poli'])) {
				$response = ['msg' => 'Data berhasil ditambahkan.', 'code' => 201];
			} else {
				$response = ['msg' => 'Data gagal ditambahkan.', 'code' => 400];
			}
		} else if (validateForm() == 412) {
			$response = ['msg' => 'Nama poli tidak boleh kosong.', 'code' => 412];
		} else if (validateForm() == 403) {
			$response = ['msg' => 'Forbidden.', 'code' => 403];
		}
	} else if ($_POST['type'] == "UPDATE") {

		if (validateForm() == 201) {
			if (checkData($_POST['id'])) {

				if (updateData($_POST['id'], $_POST['poli'])) {
					$response = ['msg' => 'Data berhasil diubah.', 'code' => 200];
				} else {
					$response = ['msg' => 'Data gagal diubah.', 'code' => 400];
				}
			} else {
				$response = ['msg' => 'Data tidak tersedia.', 'code' => 404];
			}
		} else if (validateForm() == 412) {
			$response = ['msg' => 'Nama poli tidak boleh kosong.', 'code' => 412];
		} else if (validateForm() == 403) {
			$response = ['msg' => 'Forbidden.', 'code' => 403];
		}
	} else if ($_POST['type'] == "DELETE") {

		$id = $_POST['id'];
		if (checkData($id)) {
			$response = deleteData($id) ? ['msg' => 'Data berhasil dihapus.', 'code' => 200] : ['msg' => 'Data gagal dihapus.', 'code' => 400];
		} else {
			$response = ['msg' => 'Data tidak tersedia.', 'code' => 404];
		}
	}
}

echo json_encode($response);

function validateForm()
{
	global $_POST;
	if (isset($_POST['poli'])) {
		if (!empty($_POST['poli'])) {
			return 201;
		}
		return 412;
	}
	return 403;
}

function getData()
{
	global $sql;
	$data = [];
	$i = 0;
	$query = $sql->query("SELECT * FROM poli");
	while ($e = $query->fetch_object()) {
		$data[$i++] = $e;
	}
	return $data;
}

function checkData($id)
{
	global $sql;
	$query = $sql->query("SELECT * FROM poli WHERE id_poli = '$id'");
	if ($query->num_rows >= 1) {
		return true;
	}
	return false;
}

function createData($poli)
{
	global $sql;
	$query = $sql->query("INSERT INTO poli VALUES (null, '$poli')");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

function updateData($id, $poli)
{
	global $sql;
	$query = $sql->query("UPDATE poli SET poli = '$poli' WHERE id_poli = $id");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

function deleteData($id)
{
	global $sql;
	$query = $sql->query("DELETE FROM poli WHERE id_poli = '$id'");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

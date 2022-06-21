<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

$response = ['code' => 403];
$errorMsg = [];
$errorForm = false;

if (isset($_POST['type'])) {

	if ($_POST['type'] == 'GET_DATA') {

		$response = ['data' => getData()];
	} else if (in_array($_POST['type'], ['CREATE', 'UPDATE'])) {

		if (validateForm() == 201) {
			if ($_POST['type'] == "CREATE") {
				if (createData()) {
					$response = ['msg' => 'Data berhasil ditambahkan.', 'code' => 201];
				} else {
					$response = ['msg' => 'Data gagal ditambahkan.', 'code' => 400];
				}
			} else if ($_POST['type'] == "UPDATE") {
				if (checkData($_POST['id'])) {
					if (updateData()) {
						$response = ['msg' => 'Data berhasil diubah.', 'code' => 200];
					} else {
						$response = ['msg' => 'Data gagal diubah.', 'code' => 400];
					}
				} else {
					$response = ['msg' => 'Data tidak tersedia.', 'code' => 404];
				}
			}
		} else if (validateForm() == 412) {
			$response = ['msg' => $errorMsg, 'code' => 412];
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
	global $_POST, $errorForm, $errorMsg, $sql;
	if (isset($_POST['hari'], $_POST['poli'], $_POST['dokter'], $_POST['jam_buka'], $_POST['jam_tutup'])) {
		if (empty($_POST['hari'])) {
			$errorForm = true;
			$errorMsg['hari'] = 'Hari wajib dipilih.';
		} else {
			if ($_POST['hari'] < 1 || $_POST['hari'] > 7) {
				$errorForm = true;
				$errorMsg['hari'] = 'Hari tidak valid.';
			}
		}

		if (empty($_POST['poli'])) {
			$errorForm = true;
			$errorMsg['poli'] = 'Poli wajib dipilih.';
		} else {
			$id = $_POST['poli'];
			$query = $sql->query("SELECT * FROM poli WHERE id_poli = '$id'");
			if (!$query->num_rows) {
				$errorForm = true;
				$errorMsg['poli'] = 'Poli tidak valid.';
			}
		}

		if (empty($_POST['dokter'])) {
			$errorForm = true;
			$errorMsg['dokter'] = 'Dokter wajib dipilih.';
		} else {
			$id = $_POST['dokter'];
			$query = $sql->query("SELECT * FROM dokter WHERE id_dokter = '$id'");
			if (!$query->num_rows) {
				$errorForm = true;
				$errorMsg['dokter'] = 'Dokter tidak valid.';
			}
		}

		if (empty($_POST['jam_buka'])) {
			$errorForm = true;
			$errorMsg['jam_buka'] = 'Jam buka tidak boleh kosong.';
		} else {
			$jb = $_POST['jam_buka'];
			if (!preg_match("/^([01]?[0-9]|2[0-3])\:+[0-5][0-9]$/", $jb)) {
				$errorForm = true;
				$errorMsg['jam_buka'] = 'Jam buka tidak valid.';
			}
		}

		if (empty($_POST['jam_tutup'])) {
			$errorForm = true;
			$errorMsg['jam_tutup'] = 'Jam tutup tidak boleh kosong.';
		} else {
			$jt = $_POST['jam_tutup'];
			if (preg_match("/^([01]?[0-9]|2[0-3])\:+[0-5][0-9]$/", $jt) == false) {
				$errorForm = true;
				$errorMsg['jam_tutup'] = 'Jam tutup tidak valid.';
			} else {
				if (date('H:i', strtotime($jt)) < date('H:i', strtotime($_POST['jam_buka']))) {
					$errorForm = true;
					$errorMsg['jam_tutup'] = 'Jam tutup harus melewati jam buka';
				}
			}
		}

		if ($errorForm == false) {
			return 201;
		} else {
			return 412;
		}
	}
	return 403;
}

function getData()
{
	global $sql;
	$data = [];
	$i = 0;
	$query = $sql->query("SELECT j.id_jadwal, h.hari, p.poli, d.nama_dokter,
									DATE_FORMAT(j.jam_buka, '%H:%i') AS jam_buka, DATE_FORMAT(j.jam_tutup, '%H:%i') AS jam_tutup
									FROM jadwal j
									INNER JOIN dokter d ON j.id_dokter = d.id_dokter
									INNER JOIN hari h ON j.id_hari = h.id_hari
									INNER JOIN poli p ON j.id_poli = p.id_poli");
	while ($e = $query->fetch_object()) {
		$data[$i++] = $e;
	}
	return $data;
}

function checkData($id)
{
	global $sql;
	$query = $sql->query("SELECT * FROM jadwal WHERE id_jadwal = '$id'");
	if ($query->num_rows >= 1) {
		return true;
	}
	return false;
}

function createData()
{
	global $sql, $_POST;
	$hari = $_POST['hari'];
	$poli = $_POST['poli'];
	$dokter = $_POST['dokter'];
	$jam_buka = $_POST['jam_buka'];
	$jam_tutup = $_POST['jam_tutup'];
	$query = $sql->query("INSERT INTO jadwal VALUES (null, '$hari', '$poli', '$dokter', '$jam_buka', '$jam_tutup')");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

function updateData()
{
	global $sql, $_POST;
	$id = $_POST['id'];
	$hari = $_POST['hari'];
	$poli = $_POST['poli'];
	$dokter = $_POST['dokter'];
	$jam_buka = $_POST['jam_buka'];
	$jam_tutup = $_POST['jam_tutup'];
	$query = $sql->query("UPDATE jadwal SET id_hari = '$hari', id_poli = '$poli', id_dokter = '$dokter', jam_buka = '$jam_buka', jam_tutup = '$jam_tutup'  WHERE id_jadwal = $id");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

function deleteData($id)
{
	global $sql;
	$query = $sql->query("DELETE FROM jadwal WHERE id_jadwal = '$id'");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

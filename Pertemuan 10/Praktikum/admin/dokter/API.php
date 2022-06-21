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
	global $_POST, $errorForm, $errorMsg;
	if (isset($_POST['nama_dokter'], $_POST['profil_singkat'], $_POST['riwayat_pendidikan'], $_POST['riwayat_pekerjaan'], $_POST['pelatihan'])) {
		if (empty($_POST['nama_dokter'])) {
			$errorForm = true;
			$errorMsg['nama_dokter'] = 'Nama dokter tidak boleh kosong.';
		}
		if (empty($_POST['profil_singkat'])) {
			$errorForm = true;
			$errorMsg['profil_singkat'] = 'Profil singkat tidak boleh kosong.';
		}
		if (empty($_POST['riwayat_pendidikan'])) {
			$errorForm = true;
			$errorMsg['riwayat_pendidikan'] = 'Riwayat pendidikan tidak boleh kosong.';
		}
		if (empty($_POST['riwayat_pekerjaan'])) {
			$errorForm = true;
			$errorMsg['riwayat_pekerjaan'] = 'Riwayat pekerjaan tidak boleh kosong.';
		}
		if (empty($_POST['pelatihan'])) {
			$errorForm = true;
			$errorMsg['pelatihan'] = 'Pelatihan tidak boleh kosong.';
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
	$query = $sql->query("SELECT * FROM dokter");
	while ($e = $query->fetch_object()) {
		$data[$i++] = $e;
	}
	return $data;
}

function checkData($id)
{
	global $sql;
	$query = $sql->query("SELECT * FROM dokter WHERE id_dokter = '$id'");
	if ($query->num_rows >= 1) {
		return true;
	}
	return false;
}

function createData()
{
	global $sql, $_POST;
	$nama = $_POST['nama_dokter'];
	$profil = $_POST['profil_singkat'];
	$pendidikan = $_POST['riwayat_pendidikan'];
	$pekerjaan = $_POST['riwayat_pekerjaan'];
	$pelatihan = $_POST['pelatihan'];
	$query = $sql->query("INSERT INTO dokter VALUES (null, '$nama', '$profil', '$pendidikan', '$pekerjaan', '$pelatihan')");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

function updateData()
{
	global $sql, $_POST;
	$id = $_POST['id'];
	$nama = $_POST['nama_dokter'];
	$profil = $_POST['profil_singkat'];
	$pendidikan = $_POST['riwayat_pendidikan'];
	$pekerjaan = $_POST['riwayat_pekerjaan'];
	$pelatihan = $_POST['pelatihan'];
	$query = $sql->query("UPDATE dokter SET nama_dokter = '$nama', profil_singkat = '$profil', riwayat_pendidikan = '$pendidikan', riwayat_pekerjaan = '$pekerjaan', pelatihan = '$pelatihan'  WHERE id_dokter = $id");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

function deleteData($id)
{
	global $sql;
	$query = $sql->query("DELETE FROM dokter WHERE id_dokter = '$id'");
	if ($query === TRUE) {
		return true;
	}
	return false;
}

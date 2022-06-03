<?php
require_once("../conf/database.php");

if (isset($_GET['act'])) {

	$act = ['create', 'update', 'delete'];
	if (in_array($_GET['act'], $act)) {
		$nim = $_GET['nim'];
		$nama = $_GET['nama'];
		$tgl_lahir = $_GET['tgl_lahir'];
		$program_studi = $_GET['program_studi'];
	}

	if ($_GET['act'] == 'read') {
		$result = read_data();
	} else if ($_GET['act'] == 'create') {
		
		//Check mahasiswa
		if(!check_data($nim)) {
			$result = create_data();
		} else {
			$result = ['msg' => 'Nim telah terdaftar.'];
		}

	} else if ($_GET['act'] == 'update') {

		//Check mahasiswa
		if(check_data($nim)) {
			$result = update_data();
		} else {
			$result = ['msg' => 'Nim tidak terdaftar.'];
		}
		
	} else if ($_GET['act'] == 'delete') {

		//Check mahasiswa
		if(check_data($nim)) {
			$result = delete_data();
		} else {
			$result = ['msg' => 'Nim tidak terdaftar.'];
		}

	} else {
		$result = ['msg' => 'Wrong action.'];
	}
	$result = json_encode($result);
	print_r($result);
}

function check_data() {
	global $con, $nim;
	$query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
	$sql = $con->query($query);
	if($sql->num_rows >= 1) {
		return true;
	}
	return false;
}

function get_data() {
	global $con, $nim;
	$query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
	$sql = $con->query($query);
	if($sql->num_rows >= 1) {
		return $sql->fetch_object();
	}
}

function read_data() {
	global $con;

	$data = [];
	$i = 0;

	$query = "SELECT * FROM mahasiswa";
	$sql = $con->query($query);

	while ($val = $sql->fetch_object()) {
		$data[$i]['nim'] = $val->nim;
		$data[$i]['nama'] = $val->nama;
		$data[$i]['tgl_lahir'] = $val->tgl_lahir;
		$data[$i]['program_studi'] = $val->program_studi;
		$i++;
	}
	return $data;
}

function create_data() {
	global $con, $nim, $nama, $tgl_lahir, $program_studi;
	$query = "INSERT INTO mahasiswa VALUES ('$nim', '$nama', '$tgl_lahir', '$program_studi')";
	$sql = $con->query($query);

	if($sql === TRUE) {
		$response = ['msg' => 'Data berhasil ditambahkan.', 'data' => get_data($nim)];
	} else {
		$response = ['msg' => 'Data gagal ditambahkan.'];
	}
	return $response;
}

function update_data() {
	global $con, $nim, $nama, $tgl_lahir, $program_studi;
	$query = "UPDATE mahasiswa SET nama = '$nama', tgl_lahir = '$tgl_lahir', program_studi = '$program_studi' WHERE nim = '$nim'";
	$sql = $con->query($query);

	if($sql === TRUE) {
		$response = ['msg' => 'Data berhasil diubah.', 'data' => get_data($nim)];
	} else {
		$response = ['msg' => 'Data gagal diubah.'];
	}
	return $response;
}

function delete_data() {
	global $con, $nim, $nama, $tgl_lahir, $program_studi;
	$query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
	$sql = $con->query($query);

	if($sql === TRUE) {
		$response = ['msg' => 'Data berhasil dihapus.'];
	} else {
		$response = ['msg' => 'Data gagal dihapus.'];
	}
	return $response;

}
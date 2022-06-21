<div class="row">
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="hari" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Hari</label>
			<div class="col-md-9 col-lg-8">
				<select name="hari" id="hari">
					<?php if (!isset($data)) { ?>
						<option value="">-----------Pilih-----------</option>
					<?php }
					$days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
					foreach ($days as $index => $day) { ?>
						<option value="<?= $index + 1; ?>" <?= isset($data) && $data->id_hari == $index + 1 ? 'selected' : null; ?>><?= $day; ?></option>
					<?php } ?>
				</select>
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="poli" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Poli</label>
			<div class="col-md-9 col-lg-8">
				<select name="poli" id="poli">
					<?php if (!isset($data)) { ?>
						<option value="">-----------Pilih-----------</option>
					<?php }
					$query = $sql->query("SELECT * FROM poli");
					while ($poli = $query->fetch_object()) { ?>
						<option value="<?= $poli->id_poli; ?>" <?= isset($data) && $data->id_poli == $poli->id_poli ? 'selected' : null; ?>><?= $poli->poli; ?></option>
					<?php } ?>
				</select>
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="dokter" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Dokter</label>
			<div class="col-md-9 col-lg-8">
				<select name="dokter" id="dokter">
					<?php if (!isset($data)) { ?>
						<option value="">-----------Pilih-----------</option>
					<?php }
					$query = $sql->query("SELECT * FROM dokter");
					while ($dokter = $query->fetch_object()) { ?>
						<option value="<?= $dokter->id_dokter; ?>" <?= isset($data) && $data->id_dokter == $dokter->id_dokter ? 'selected' : null; ?>><?= $dokter->nama_dokter; ?></option>
					<?php } ?>
				</select>
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="jam_buka" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Jam Buka</label>
			<div class="col-md-9 col-lg-8">
				<input type="time" class="form-control" id="jam_buka" value="<?= isset($data) ? $data->jam_buka : null; ?>">
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="jam_tutup" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Jam Tutup</label>
			<div class="col-md-9 col-lg-8">
				<input type="time" class="form-control" id="jam_tutup" value="<?= isset($data) ? $data->jam_tutup : null; ?>">
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-md-8 offset-0 offset-lg-1 mt-3">
		<button class="btn btn-primary" id="submit">Submit</button>
	</div>
</div>
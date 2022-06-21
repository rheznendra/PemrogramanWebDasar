<div class="row">
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="nama_dokter" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Nama Dokter</label>
			<div class="col-md-9 col-lg-8">
				<input type="text" class="form-control" id="nama_dokter" value="<?= isset($data) ? $data->nama_dokter : null; ?>">
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="profil_singkat" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Profil Singkat</label>
			<div class="col-md-9 col-lg-8">
				<textarea class="form-control" id="profil_singkat"><?= isset($data) ? $data->profil_singkat : null; ?></textarea>
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="riwayat_pendidikan" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Riwayat Pendidikan</label>
			<div class="col-md-9 col-lg-8">
				<textarea class="form-control" id="riwayat_pendidikan"><?= isset($data) ? $data->riwayat_pendidikan : null; ?></textarea>
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="riwayat_pekerjaan" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Riwayat Pekerjaan</label>
			<div class="col-md-9 col-lg-8">
				<textarea class="form-control" id="riwayat_pekerjaan"><?= isset($data) ? $data->riwayat_pekerjaan : null; ?></textarea>
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-xs-3 mb-3">
		<div class="row">
			<label for="pelatihan" class="col-md-3 col-lg-2 offset-lg-1 col-form-label">Pelatihan</label>
			<div class="col-md-9 col-lg-8">
				<textarea class="form-control" id="pelatihan"><?= isset($data) ? $data->pelatihan : null; ?></textarea>
				<div class=" invalid-feedback error-msg"></div>
			</div>
		</div>
	</div>
	<div class="col-md-8 offset-0 offset-lg-1 mt-3">
		<button class="btn btn-primary" id="submit">Submit</button>
	</div>
</div>
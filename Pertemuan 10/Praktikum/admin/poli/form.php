<div class="row">
	<div class="col-12 mt-xs-3">
		<div class="row">
			<label for="poli" class="col-md-3 col-lg-1 offset-lg-1 col-form-label">Nama Poli</label>
			<div class="col-md-9 col-lg-8 offset-lg-1">
				<input type="text" class="form-control" id="poli" value="<?= isset($data) ? $data->poli : null; ?>">
				<div class=" invalid-feedback" id="msg"></div>
			</div>
		</div>
	</div>
	<div class="col-md-8 offset-0 offset-lg-1 mt-3">
		<button class="btn btn-primary" id="submit">Submit</button>
	</div>
</div>
var data = [];

const formatRp = (num) => `Rp. ${new Intl.NumberFormat('id-ID').format(num)}`;
const getHargaBeli = (param) => Math.round(parseFloat(param) * 1.1);

const resetForm = (rsKode = true) => {
	if (rsKode) {
		$('#kode').val(null);
	}
	$('#nama').val(null);
	$('#harga-beli').val(null);
	$('#harga-jual').val(null);
	$('#stock').val(null);
	$('#form-stock').removeClass('col-md-6').addClass('col-md-12')
	$('#form-stock-baru').hide();
	$('#stock-baru').val(null);
	$('#stock').removeAttr('disabled');
	$('#alert-msg').html(null).hide();
};

const showErrorAlert = (msg) => {
	$('#alert-msg').show().html(null)
	$('#alert-msg').append('<ul class="mb-0">');
	msg.forEach((item) => {
		$('#alert-msg ul').append(`<li>${item}</li>`)
	})
	$('#alert-msg').append('<ul>');
}

const setDataOnTable = () => {
	$('#data-table').html(null);
	let newData = '';
	data.forEach((item, index) => {
		newData += '<tr>';
		newData += `<td>${index+1}.</td>`;
		newData += `<td>${item.kode}</td>`;
		newData += `<td>${item.nama}</td>`;
		newData += `<td>${formatRp(item.harga_beli)}</td>`;
		newData += `<td>${formatRp(item.harga_jual)}</td>`;
		newData += `<td>${item.stock}</td>`;
		newData += '</tr>';
	});
	$('#data-table').append(newData);
	$('#footer-table').show()
}

$('#reset-data').click(() => {
	data = [];
	let msg = '';
	msg += '<tr>'
	msg += '<td colspan="6">Tidak ada data.</td>';
	msg += '</tr>';
	$('#data-table').html(msg);
	$('#footer-table').toggle()
});

$('#reset').click(() => {
	resetForm()
});

$('#harga-beli').on('keyup change', e => {
	if (e.currentTarget.value > 0) {
		$('#harga-jual').val(formatRp(getHargaBeli(e.currentTarget.value)));
	} else {
		$('#harga-jual').val(null)
	}
});

$('#submit').click(() => {
	$('#alert-msg').hide();
	let kode = $('#kode').val();
	let nama = $('#nama').val();
	let hBeli = $('#harga-beli').val();
	let stock = $('#stock').val();
	let error = false;
	let msg = [];

	if (kode.length == 0 || kode == null) {
		msg.push('Kode Tidak Boleh Kosong.');
		error = true;
	}

	if (nama.length == 0 || nama == null) {
		msg.push('Nama Tidak Boleh Kosong.');
		error = true;
	}

	if (hBeli <= 0 || hBeli == null) {
		msg.push('Harga Tidak Boleh Kosong.');
		error = true;
	}
	if (stock <= 0 || stock == null) {
		msg.push('Stock Tidak Boleh Kosong.');
		error = true;
	}

	if (!error) {
		let hJual = getHargaBeli(hBeli);

		let o = {
			kode: kode,
			nama: nama,
			harga_beli: hBeli,
			harga_jual: hJual,
			stock: stock
		}
		if (data.length == 0) {
			data.push(o);
		} else {
			data.forEach((item, index) => {
				if (item.kode == kode) {
					let stockBaru = $('#stock-baru').val();
					if (stockBaru < 0 || stockBaru == null || stockBaru.length == 0) {
						error = true;
						msg.push('Stock Tambahan Tidak Boleh Kosong.');
					} else {
						item.nama = nama;
						item.harga_beli = hBeli;
						item.harga_jual = hJual;
						stock = parseInt(item.stock) + parseInt(stockBaru);
						item.stock = stock;
					}
					return;
				}
				if (index == data.length - 1) {
					data.push(o);
				}
			});
		}
		if (!error) {
			setDataOnTable();
			resetForm();
		} else {
			showErrorAlert(msg);
		}
	} else {
		showErrorAlert(msg);
	}
});

$('#kode').keyup((e) => {
	let kode = e.currentTarget.value;
	let found = 0;
	data.forEach((item, index) => {
		if (item.kode == kode) {
			found = 1;
			$('#nama').val(item.nama);
			$('#harga-beli').val(item.harga_beli);
			$('#harga-jual').val(formatRp(item.harga_jual));
			$('#stock').val(item.stock);
			$('#form-stock').removeClass('col-md-12').addClass('col-md-6');
			$('#stock').attr('disabled', true)
			$('#form-stock-baru').show();
			return;
		}
	})
	if (found == 0) {
		resetForm(false);
	}
})
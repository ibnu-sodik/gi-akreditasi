


const pesanSukses = $('.pesan-sukses').data('flashdata');
if (pesanSukses) {

	swal({
		title: "Berhasil!",
		text: pesanSukses,
		icon: "success",
		button: false
	});

}
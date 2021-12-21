<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">
<link href="<?= base_url() ?>fileAdmin/dropify/dropify.min.css" rel="stylesheet">

<div class="page-header">
	<h1>
		<?= $bc_aktif; ?>
		<?php if (isset($sm_text)): ?>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?= $sm_text; ?>
			</small>			
		<?php endif ?>
	</h1>
</div>

<div class="row">
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" role="form" action="<?= $form_action; ?>">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
		<div class="col-md-4 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="gambar_sambutan">Gambar </label>
				<div class="col-sm-9">
					<input type="file" name="filefoto" id="gambar_sambutan" class="dropify" data-height="300" required />
				</div>
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="konten_sambutan">Kata Sambutan
					<?= form_error('konten_sambutan') ?>
				</label>
				<div class="col-sm-9">
					<textarea name="konten_sambutan" class="form-control" id="konten_sambutan"><?= set_value('konten_sambutan') ?></textarea>
					<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
				</div>
			</div>
		</div>

	</form>
</div>

<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script type="text/javascript">
	
	$('.dropify').dropify({
		messages: {
			default: 'Tarik file disini...',
			replace: 'Ganti',
			remove:  'Hapus',
			error:   'error'
		}
	});

	$('#konten_sambutan').summernote({
		lang: 'id-ID',
		height : 400,
		placeholder: 'Tulis kata sambutan...',
		onImageUpload : function(files, editor, welEditable) {
			sendFile(files[0], editor, welEditable);
		}
	});

	function sendFile(file, editor, welEditable) {
		data = new FormData();
		data.append("file", file);
		$.ajax({
			data: data,
			type: "POST",
			url: "<?= site_url('admin/upload/upload_image') ?>",
			cache: false,
			contentType: false,
			processData: false,
			success: function(url){
				editor.insertImage(welEditable, url);
			}
		});
	}
</script>
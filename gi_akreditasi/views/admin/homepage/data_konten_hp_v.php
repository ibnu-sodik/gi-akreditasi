<?php
$data = $data_konten->row();
?>
<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">

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
	<div class="alert alert-info">
		<i class="ace-icon fa fa-hand-o-right"></i>
		Ingin menampilkan file PDF pada halaman?.
		<button type="button" class="btn btn-xs" data-toggle="modal" data-target="#exampleModal">
			Baca Petunjuk
		</button>
		<button class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
	</div>

	<form class="form-horizontal" method="POST" role="form" action="<?= $form_action.'/'.$data->id_konten; ?>">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
		<div class="col-md-12 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="isi_konten">Isi Konten
					<?= form_error('isi_konten') ?>
				</label>
				<div class="col-sm-9">
					<textarea name="isi_konten" class="form-control" id="isi_konten"><?= $data->isi_konten ?></textarea>
					<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
				</div>
			</div>
		</div>

	</form>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="exampleModalLabel">Petunjuk Menampilkan File PDF kedalam Halaman.</h5>
			</div>
			<div class="modal-body">
				<ol type="1">
					<li>Pastikan File telah terupload pada cloud storage</li>
					<li>Jika file tersimpan pada g-Drive, pastikan sudah mengubah hak akses menjadi <b>editor</b></li>
					<li>Pilih ikon <b><?php echo htmlspecialchars("</>"); ?></b> pada text editor</li>
					<li>
						Copy script
						<code>
							<?= htmlspecialchars('<div class="container-iframe">
								<iframe class="responsive-iframe" src="isi_dengan_link_file" width="100%"></iframe>
								</div>');
								?>
							</code>
							lalu paste kedalam text editor
						</li>
						<li>Masukkan link file ke bagian <code>src=""</code></li>
						<li>
							Ubah link file <code>https://drive.google.com/file/d/PDF_DRIVE_ID/view?usp=drivesdk</code>
							menjadi
						</li> 
						<li>
							<code>https://drive.google.com/file/d/PDF_DRIVE_ID/preview</code>
						</li>
						<li>
							Klik ikon <b><?php echo htmlspecialchars("</>"); ?></b> untuk kembali pada tampilan normal
						</li>
					</ol>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
	<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
	<script type="text/javascript">

		$('#isi_konten').summernote({
			lang: 'id-ID',
			height : 400,
			placeholder: 'Tulis isi konten...',
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
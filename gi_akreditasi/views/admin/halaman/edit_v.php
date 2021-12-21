<?php $row = $data->row_array(); ?>
<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">
<link href="<?= base_url() ?>fileAdmin/dropify/dropify.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap-datepicker3.min.css" />
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
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" role="form" action="<?= $form_action.'/'.$row['id_halaman']; ?>">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
		
		<div class="col-md-8 col-xs-12">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="nama_halaman">Judul Halaman</label>

				<div class="col-sm-9">
					<input type="text" id="nama_halaman" placeholder="Judul Halaman" name="nama_halaman" class="form-control judul"  value="<?= $row['nama_halaman'] ?>" />
					<?= form_error('nama_halaman'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="slug"></label>

				<div class="col-sm-9">
					<input type="text" id="slug" placeholder="Permalink" name="slug" value="<?= $row['slug_halaman'] ?>" class="form-control slug" readonly />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="konten">Konten</label>

				<div class="col-sm-9">
					<textarea class="form-control" name="konten" id="summernote"><?= $row['konten_halaman'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xs-12">

			<div class="form-group">
				<label class="control-label col-sm-3 no-padding-right" for="meta-deskripsi">Meta Deskripsi</label>
				<div class="col-sm-9">
					<textarea placeholder="Meta Deskripsi" name="deskripsi" for="meta-deskripsi" class="form-control" rows="10"><?= $row['deskripsi_halaman'] ?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-3 no-padding-right"></label>
				<div class="col-sm-9">
					<input type="hidden" name="id_halaman" value="<?= $row['id_halaman'] ?>">
					<button type="submit" name="submit" class="btn btn-block btn-primary">Publish <i class="fa fa-send"></i></button>
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

<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/form.js"></script>

<script type="text/javascript">
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
</script>
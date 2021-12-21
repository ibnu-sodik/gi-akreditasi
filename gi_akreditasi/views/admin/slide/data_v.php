<link href="<?= base_url() ?>fileAdmin/summernote/summernote.css" rel="stylesheet">
<link href="<?= base_url() ?>fileAdmin/dropify/dropify.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/colorbox.min.css" />

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

<a href="#" class="btn btn-primary tombol-layang tombol-modal" data-toggle="modal" data-target="#addModal"><i class="fa fa-fw fa-plus fa-1x"></i></a>

<div class="col-md-12 col-xl-12 col-sm-12">
	<!-- <div> -->
		<ul class="ace-thumbnails clearfix">
			<?php foreach ($data_slide->result() as $row): ?>	
				<li>
					<div>
						<?php if (file_exists('uploads/slide/'.$row->gambar_slide) && !empty($row->gambar_slide)): ?>
						<img width="200" height="200" alt="<?= $row->judul_slide ?>" src="<?= base_url('uploads/slide/'.$row->gambar_slide) ?>" /><?php else: ?>
						<img width="200" height="200" alt="<?= $row->judul_slide ?>" src="<?= base_url('fileAdmin/images/no-img.png') ?>" />
					<?php endif ?>
					<div class="text">
						<div class="inner">
							<span><?= $row->judul_slide ?></span>

							<br />
							<?php if (file_exists('uploads/slide/'.$row->gambar_slide) && !empty($row->gambar_slide)): ?>
							<a href="<?= base_url('uploads/slide/'.$row->gambar_slide) ?>" data-rel="colorbox"><?php else: ?>
							<a href="<?= base_url('fileAdmin/images/no-img.png') ?>" data-rel="colorbox">
							<?php endif; ?>
							<i class="ace-icon fa fa-search-plus"></i>
						</a>

						<a class="edit-slide" href="javascript:void(0)" title="Edit" 
						data-id="<?= $row->id_slide ?>" data-judul="<?= $row->judul_slide ?>" data-konten="<?= sanitize($row->konten_slide) ?>" data-gambar="<?= $row->gambar_slide ?>" >
						<i class="ace-icon fa fa-edit"></i>
					</a>

					<a href="<?= site_url('admin/slide/hapus/'.$row->id_slide) ?>" class="tombol-hapus" title="Hapus">
						<i class="ace-icon fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="tags">
				<?php if($row->status_aktif == 1): ?>
					<a href="<?= site_url('admin/slide/inactive/'.$row->id_slide); ?>">
						<span class="label-holder">
							<span class="label label-info">Tampil Awal</span>
						</span>
					</a>
					<?php else: ?>
						<a href="<?= site_url('admin/slide/active/'.$row->id_slide); ?>">
							<span class="label-holder">
								<span class="label label-danger">Tampil Normal</span>
							</span>
						</a>
					<?php endif; ?>

				</div>
			</div>
		</li>			
	<?php endforeach ?>
</ul>
<!-- </div> -->
</div>

<!-- modal add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modalCategory" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Slide</h4>
			</div>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=site_url('admin/slide/simpan')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="gambar_slide" class="col-sm-3 control-label no-padding-right">Gambar Slide</label>
						<div class="col-sm-9">
							<input type="file" name="filefoto" id="gambar_slide" data-height="200" required class="dropify">
						</div>
					</div>
					<div class="form-group">
						<label for="judul_slide" class="col-sm-3 control-label no-padding-right">Judul Slide</label>
						<div class="col-sm-9">
							<input type="text" name="judul_slide" id="judul_slide" placeholder="Judul Slide" class="form-control" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="konten_slide" class="col-sm-3 control-label no-padding-right">Konten Slide</label>
						<div class="col-sm-9">
							<textarea class="form-control" name="konten_slide" id="summernote2"><?= set_value('konten_slide') ?></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalCategory" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Slide</h4>
			</div>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=site_url('admin/slide/update')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="gambar_slide" class="col-sm-3 control-label no-padding-right">Gambar Slide</label>
						<div class="col-sm-3">
							<img src="" id="pict" class="img-thumbnail img-responsive" style="height: 215px;">
						</div>
						<div class="col-sm-6">
							<input type="file" name="filefoto" id="gambar_slide" data-height="200" class="dropify">
						</div>
					</div>
					<div class="form-group">
						<label for="judul_slide2" class="col-sm-3 control-label no-padding-right">Judul Slide</label>
						<div class="col-sm-9">
							<input type="text" name="judul_slide2" id="judul_slide2" placeholder="Judul Slide" class="form-control" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="konten_slide2" class="col-sm-3 control-label no-padding-right">Konten Slide</label>
						<div class="col-sm-9">
							<textarea class="form-control" name="konten_slide2" id="summernote3"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_slide">
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>fileAdmin/js/jquery.colorbox.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/dropify/dropify.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/lang/summernote-id-ID.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/form.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		$('.edit-slide').on('click', function() {
			var id = $(this).data('id');
			var judul = $(this).data('judul');
			var konten = $(this).data('konten');
			var gambar = $(this).data('gambar');

			$('[name="id_slide"]').val(id);
			$('[name="judul_slide2"]').val(judul);
			$('#summernote3').summernote('code', konten);				
			$("#pict").attr("src", "<?= base_url('uploads/slide/') ?>"+gambar);

			$('#editModal').modal('show');
		})
	})
	$('#summernote2').summernote({
		lang: 'id-ID',
		height : 200,
		onImageUpload : function(files, editor, welEditable) {
			sendFile(files[0], editor, welEditable);
		}
	});
	$('#summernote3').summernote({
		lang: 'id-ID',
		height : 200,
		onImageUpload : function(files, editor, welEditable) {
			sendFile(files[0], editor, welEditable);
		}
	});
</script>
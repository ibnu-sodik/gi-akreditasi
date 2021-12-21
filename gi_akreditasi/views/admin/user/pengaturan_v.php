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

<div id="user-profile-2" class="user-profile">
	<div class="tabbable">
		<ul class="nav nav-tabs padding-18">

			<li class="active">
				<a data-toggle="tab" href="#updatePass" aria-expanded="false">
					<i class="purple ace-icon fa fa-key bigger-120"></i>
					Ubah Password
				</a>
			</li>

		</ul>

		<div class="tab-content no-border padding-24">

			<div id="updatePass" class="tab-pane active">
				<div class="row">
					<div class="col-sm-6">
						<form action="<?= $aksi_upPass ?>" method="POST" class="form-horizontal">							
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="pass_baru">Password Baru</label>

								<div class="col-sm-9">
									<div class="input-group">							
										<input type="password" id="pass_baru" placeholder="Password Baru" name="pass_baru" class="form-control" value="<?= set_value('pass_baru') ?>" />
										<span class="input-group-addon t_passBaru">
											<i class="fa fa-eye" id="icon"></i>
										</span>
									</div>
									<?= form_error('pass_baru'); ?>
								</div>
							</div>							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="pass_conf">Konfirmasi Password</label>

								<div class="col-sm-9">
									<div class="input-group">
										<input type="password" id="pass_conf" placeholder="Konfirmasi Password" name="pass_conf" class="form-control" value="<?= set_value('pass_conf') ?>" />
										<span class="input-group-addon t_passConf">
											<i class="fa fa-eye" id="icon2"></i>
										</span>										
									</div>
									<?= form_error('pass_conf'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3 no-padding-right"></label>
								<div class="col-sm-9">
									<input type="hidden" name="id_user" value="<?= $id_user ?>">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalCategory" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Sosmed</h4>
			</div>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url('admin/profil/update_sosmed')?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_sosmed2" class="col-sm-3 control-label no-padding-right">Nama Sosmed</label>
						<div class="col-sm-9">
							<input type="text" name="nama_sosmed2" id="nama_sosmed2" placeholder="Nama Sosmed" class="form-control" autofocus>
							<?= form_error('nama_sosmed2') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="link_sosmed2" class="col-sm-3 control-label no-padding-right">Link Sosmed</label>
						<div class="col-sm-9">
							<input type="text" name="link_sosmed2" id="link_sosmed2" placeholder="Link Sosmed" class="form-control">
							<?= form_error('link_sosmed2') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="ikon_sosmed2" class="col-sm-3 control-label no-padding-right">Ikon Sosmed</label>
						<div class="col-sm-9">
							<div class="input-group">							
								<input type="text" name="ikon_sosmed2" id="ikon_sosmed2" placeholder="Ikon Sosmed" class="form-control">
								<span class="input-group-addon">
									<i class="" id="ikon"></i>
								</span>
							</div>
							<?= form_error('ikon_sosmed2') ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_sosmed">
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});

	$(document).on('click', '.t_passConf', function() {
		$('#icon2').toggleClass("fa-eye fa-eye-slash");
		var input = $("#pass_conf");
		input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password');
	});

	$(document).on('click', '.t_passBaru', function() {
		$('#icon').toggleClass("fa-eye fa-eye-slash");
		var input = $("#pass_baru");
		input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password');
	});

	jQuery(function($) {
		$('.edit-sosmed').on('click', function() {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var link = $(this).data('link');
			var ikon = $(this).data('ikon');

			$('[name="id_sosmed"]').val(id);
			$('[name="nama_sosmed2"]').val(nama);
			$('[name="link_sosmed2"]').val(link);
			$('[name="ikon_sosmed2"]').val(ikon);
			$('#ikon').addClass(ikon);

			$('#editModal').modal('show');
		})
	})

</script>
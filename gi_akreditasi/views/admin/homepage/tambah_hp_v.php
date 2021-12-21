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
	<div class="col-md-8">
		<form class="form-horizontal" method="POST" role="form" action="<?= $form_action; ?>">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="hp_sambutan">Tampilkan Konten Sambutan ? </label>
				<div class="col-sm-9">
					<div class="radio">
						<label>
							<input name="hp_sambutan" type="radio" class="ace input-lg" value="1" <?= set_radio('hp_sambutan', 1); ?>>
							<span class="lbl bigger-120"> Ya</span>
						</label>
						<label>
							<input name="hp_sambutan" type="radio" class="ace input-lg" value="0" <?= set_radio('hp_sambutan', 0); ?>>
							<span class="lbl bigger-120"> Tidak</span>
						</label>
					</div>
					<?= form_error('hp_sambutan') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="hp_konten">Tampilkan Konten Utama ? </label>
				<div class="col-sm-9">
					<div class="radio">
						<label>
							<input name="hp_konten" type="radio" class="ace input-lg" value="1" <?= set_radio('hp_konten', 1); ?>>
							<span class="lbl bigger-120"> Ya</span>
						</label>
						<label>
							<input name="hp_konten" type="radio" class="ace input-lg" value="0" <?= set_radio('hp_konten', 0); ?>>
							<span class="lbl bigger-120"> Tidak</span>
						</label>
					</div>
					<?= form_error('hp_konten') ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="hp_video">Tampilkan Konten Video ? </label>
				<div class="col-sm-9">
					<div class="radio">
						<label>
							<input name="hp_video" type="radio" class="ace input-lg" value="1" <?= set_radio('hp_video', 1); ?>>
							<span class="lbl bigger-120"> Ya</span>
						</label>
						<label>
							<input name="hp_video" type="radio" class="ace input-lg" value="0" <?= set_radio('hp_video', 0); ?>>
							<span class="lbl bigger-120"> Tidak</span>
						</label>
					</div>
					<?= form_error('hp_video') ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" for="hp_slide">Tampilkan Konten Slide ? </label>
				<div class="col-sm-9">
					<div class="radio">
						<label>
							<input name="hp_slide" type="radio" class="ace input-lg" value="1" <?= set_radio('hp_slide', 1); ?>>
							<span class="lbl bigger-120"> Ya</span>
						</label>
						<label>
							<input name="hp_slide" type="radio" class="ace input-lg" value="0" <?= set_radio('hp_slide', 0); ?>>
							<span class="lbl bigger-120"> Tidak</span>
						</label>
					</div>
					<?= form_error('hp_slide') ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 no-padding-right control-label" aria-hidden="true"></label>
				<div class="col-sm-3">

					<button type="submit" name="submit" class="btn btn-block btn-primary">Simpan <i class="fa fa-send"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>
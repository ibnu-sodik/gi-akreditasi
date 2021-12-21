<?php 
$data = $data->row_array();
?>

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
	<div class="col-xs-12 col-md-8">
		<div class="tabbable">
			<ul id="mytab" class="nav nav-tabs">
				<li>
					<a href="<?= site_url('admin/menu') ?>">
						<i class="green ace-icon fa fa-list bigger-120"></i>
						Header Menu
					</a>
				</li>

				<li class="active">
					<a href="<?= site_url('admin/menu/second') ?>" >
						<i class="purple ace-icon fa fa-list-alt bigger-120"></i>
						Footer Menu
					</a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade in active">
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<form class="form-horizontal" role="form" action="<?= $form_aksi.'/'.$data['id_menu']; ?>" method="POST">
								<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="judul"> Judul Menu </label>

									<div class="col-sm-9">
										<input type="text" id="judul" name="judul" placeholder="Judul Menu" class="form-control"  value="<?= $data['judul_menu'] ?>"/>
										<?php echo form_error('judul') ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="induk"> Induk Menu </label>

									<div class="col-sm-9">										
										<select class="form-control select2" name="induk" id="induk" data-placeholder="Pilih Induk...">
											<option value="0">Tidak Berinduk</option>
											<?php 
											foreach ($pil_induk->result() as $row):
												if ($data['parent_id'] == $row->id_menu) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $row->id_menu; ?>" <?= $cek ?>><?= $row->judul_menu; ?></option>
											<?php endforeach; ?>
										</select>
										<?php echo form_error('induk') ?>
									</div>
								</div>
								<div class="form-group" id="jenis_menu">									
									<label class="col-sm-3 control-label no-padding-right" for="jenis_menu"> Jenis Menu </label>
									<div class="col-sm-9">
										<select name="jenis_menu" class="form-control select2">
											<?php 
											$variabel = array(
												'halaman' 	=> 'Halaman',
												'kategori' 	=> 'Kategori',
												'url'	 	=> 'URL',
											);
											foreach ($variabel as $key => $value):
												if ($data['jenis_menu'] == $key) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $key ?>" <?= $cek ?>><?= $value ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="form-group" id="link_halaman">									
									<label class="col-sm-3 control-label no-padding-right" for="link_halaman"> Link Halaman </label>
									<div class="col-sm-9">
										<select name="link_halaman" class="form-control select2">
											<option value="">Pilih Halaman</option>
											<?php 
											$rhal = str_replace($url_halaman, "", $data['link']);
											foreach ($pil_halaman->result() as $row):
												if ($rhal == $row->slug_halaman) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $row->slug_halaman; ?>" <?= $cek ?>><?= $row->nama_halaman; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group" id="link_kategori">									
									<label class="col-sm-3 control-label no-padding-right" for="link_kategori"> Link Kategori </label>
									<div class="col-sm-9 col-xs-12">
										<select name="link_kategori" class="form-control select2">
											<option value="">Pilih Kategori</option>
											<?php 
											$rkat = str_replace($url_kategori, "", $data['link']);
											foreach ($pil_kategori->result() as $row):
												if ($rkat == $row->slug_kategori) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $row->slug_kategori; ?>" <?= $cek ?>><?= $row->nama_kategori; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group" id="link_url">									
									<label class="col-sm-3 control-label no-padding-right" for="jenis_link"> Link URL </label>
									<div class="col-sm-4">
										<select name="jenis_link" class="form-control select2">
											<?php 
											$pil_ring = array(
												'' 	=> '',
												'1' => 'Link Internal',
												'2' => 'Link Eksternal',
											);
											foreach($pil_ring as $key => $value):
												if ($key == $data['jenis_link']) {
													$cek = 'selected';
												}else{
													$cek = '';
												}
												?>
												<option value="<?= $key ?>" <?= $cek ?>><?= $value ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-sm-5">
										<input type="text" name="link_url2" class="form-control" placeholder="https://nama-link.domain" value="<?= $data['link'] ?>">
									</div>
								</div>
								<div class="form-group">									
									<label class="col-sm-3 control-label no-padding-right" for="urut"> Urutan </label>
									<div class="col-sm-9">
										<select name="urut" class="form-control select2">
											<option value="">--- Urutan ---</option>
											<?php 
											for ($i=1; $i <= 20 ; $i++):
												if ($data['urut'] == $i) {
													$cek = 'selected';
												} else {
													$cek = '';
												}
												?>
												<option value="<?= $i; ?>" <?= $cek ?>><?= $i; ?></option>
											<?php endfor; ?>
										</select>
									</div>
									<?= form_error('urut'); ?>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"></label>
									<div class="col-sm-9">
										<label class="inline">
											<?php 
											if ($data['target'] == "_blank") {
												$check = "checked";
											}else{
												$check = "";
											}
											?>
											<input name="target" value="_blank" type="checkbox" class="ace" <?= $check ?> >
											<span class="lbl"> Buka pada tab baru</span>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"></label>
									<div class="col-sm-9">
										<input type="hidden" readonly name="kategori_menu" value="<?= $data['kategori_menu']; ?>">
										<button type="submit" name="submit" class="btn btn-primary btn-block">Simpan <i class="fa fa-send"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>

<script type="text/javascript">
	function tampil_form(selektor){
		if ($(selektor).val()=='halaman') {
			$('#link_halaman').show();
			$('#link_kategori, #link_url').hide();
		}else if ($(selektor).val()=='kategori') {
			$('#link_kategori').show();
			$('#link_halaman, #link_url').hide();
		}else if ($(selektor).val()=='url') {
			$('#link_url').show();
			$('#link_kategori, #link_halaman').hide();
		}
	}

	tampil_form('#jenis_menu select');
	$('#jenis_menu select').change(function(){
		tampil_form(this);
	});
	
	$(".select2").select2({
    	width: '100%', // need to override the changed default
    	theme: "classic"
    });

</script>
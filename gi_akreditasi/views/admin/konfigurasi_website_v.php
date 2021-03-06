<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Tambah Data Website</title>

	<meta name="csrf-token" content="<?= $csrf_token ?>">
	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace.min.css" />

	<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/ace-rtl.min.css" />
	
	<script src="<?= base_url() ?>fileAdmin/js/jquery-2.1.4.min.js"></script>
	<script src="<?=base_url()?>fileAdmin/js/sweetalert.min.js"></script>
</head>

<body class="login-layout">
	<div class="main-container">
		<div class="main-content">			

			<div class="swal-warning" data-flashdata="<?= $this->session->flashdata('swalWarning'); ?>"></div>
			<div class="swal-info" data-flashdata="<?= $this->session->flashdata('swalInfo'); ?>"></div>
			<div class="swal-error" data-flashdata="<?= $this->session->flashdata('swalError'); ?>"></div>
			<div class="swal-sukses" data-flashdata="<?= $this->session->flashdata('swalSukses'); ?>"></div>

			<div class="pnotify-sukses" data-flashdata="<?= $this->session->flashdata('pnotifySukses'); ?>"></div>
			<div class="pnotify-notice" data-flashdata="<?= $this->session->flashdata('pnotifyWarning'); ?>"></div>
			<div class="pnotify-info" data-flashdata="<?= $this->session->flashdata('pnotifyInfo'); ?>"></div>
			<div class="pnotify-error" data-flashdata="<?= $this->session->flashdata('pnotifyError'); ?>"></div>
			
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-cog red"></i>
								<span class="red">Pengaturan</span>
								<span class="white" id="id-text2">Website</span>
							</h1>
							<h4 class="blue" id="id-company-text">&copy; Data Website</h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">

							<div id="signup-box" class="signup-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header green lighter bigger">
											<i class="ace-icon fa fa-desktop blue"></i>
											Data Website Baru
										</h4>

										<div class="space-6"></div>
										<p> Masukkan data: </p>

										<form method="POST" action="<?= $form_action ?>">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" name="site_name" class="form-control" placeholder="Nama Website" autocomplete="off"  value="<?= set_value('site_name') ?>" />
														<i class="ace-icon fa fa-desktop"></i>
														<?= form_error('site_name'); ?>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" name="site_title" class="form-control" placeholder="Judul Website" autocomplete="off" value="<?= set_value('site_title') ?>" />
														<i class="ace-icon fa fa-edit"></i>
														<?= form_error('site_title'); ?>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<textarea class="form-control" name="site_keywords" placeholder="Keywords Website"><?= set_value('site_keywords') ?></textarea>
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<textarea class="form-control" name="site_description" placeholder="Deskripsi Website"><?= set_value('site_description') ?></textarea>
														<i class="ace-icon fa fa-retweet"></i>
													</span>
												</label>

												<div class="space-24"></div>

												<div class="clearfix">
													<button type="reset" class="width-30 pull-left btn btn-sm">
														<i class="ace-icon fa fa-refresh"></i>
														<span class="bigger-110">Reset</span>
													</button>

													<button type="submit" class="width-65 pull-right btn btn-sm btn-success">
														<span class="bigger-110">Simpan</span>

														<i class="ace-icon fa fa-send icon-on-right"></i>
													</button>
												</div>
											</fieldset>
										</form>
									</div>
								</div><!-- /.widget-body -->
							</div><!-- /.signup-box -->
						</div><!-- /.position-relative -->

						<div class="navbar-fixed-top align-right">
							<br />
							&nbsp;
							<a id="btn-login-dark" href="#">Dark</a>
							&nbsp;
							<span class="blue">/</span>
							&nbsp;
							<a id="btn-login-blur" href="#">Blur</a>
							&nbsp;
							<span class="blue">/</span>
							&nbsp;
							<a id="btn-login-light" href="#">Light</a>
							&nbsp; &nbsp; &nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= base_url() ?>fileAdmin/js/jquery.pnotify.min.js"></script>
	<script src="<?= base_url() ?>fileAdmin/js/notifikasi.js"></script>

	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url() ?>fileAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
			$(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			});
		});



			//you don't need this, just used for changing background
			jQuery(function($) {
				$('#btn-login-dark').on('click', function(e) {
					$('body').attr('class', 'login-layout');
					$('#id-text2').attr('class', 'white');
					$('#id-company-text').attr('class', 'blue');

					e.preventDefault();
				});
				$('#btn-login-light').on('click', function(e) {
					$('body').attr('class', 'login-layout light-login');
					$('#id-text2').attr('class', 'grey');
					$('#id-company-text').attr('class', 'blue');

					e.preventDefault();
				});
				$('#btn-login-blur').on('click', function(e) {
					$('body').attr('class', 'login-layout blur-login');
					$('#id-text2').attr('class', 'white');
					$('#id-company-text').attr('class', 'light-blue');

					e.preventDefault();
				});

			});
		</script>
	</body>
	</html>

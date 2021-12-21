<?php 

if (isset($canonical) && isset($url)) {
	$canonical 	= $canonical;
	$url 		= $url;
}else{
	$canonical 	= site_url('');
	$url 		= site_url('');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<link rel="profile" href="<?= base_url() ?>">

	<?php if(isset($title)): ?>
		<title><?=$title?> - <?= $site_title; ?></title>
		<meta property="og:title" content="<?= $title;?>" /><?php else: ?>
		<title><?= $site_title; ?></title>
		<meta property="og:title" content="<?= $site_title;?>" />
	<?php endif; ?>
	<meta name="keywords" content="<?= $site_keywords; ?>">

	<?php if (isset($description)): ?>
		<meta name="description" content="<?= $description; ?>" />
		<meta property="og:description" content="<?= $description;?>" /><?php else: ?>
		<meta name="description" content="<?= $site_description; ?>" />
		<meta property="og:description" content="<?= $site_description;?>" />
	<?php endif; ?>

	<?php if (isset($author)): ?>
		<meta name="publishedby" content="<?= $author; ?>">
		<meta name="author" content="<?= $site_author; ?>"><?php else: ?>
		<meta name="author" content="<?= $site_author; ?>">
	<?php endif; ?>

	<?php if (isset($gambar)): ?>		
		<meta property="og:image" content="<?= $gambar; ?>" />
		<meta property="og:image:secure_url" content="<?= $gambar; ?>" /><?php else: ?>
		<meta property="og:image" content="<?= base_url('fileWeb/images/'.$site_favicon); ?>" />
		<meta property="og:image:secure_url" content="<?= base_url('fileWeb/images/'.$site_favicon); ?>" />
	<?php endif; ?>

	<meta name="generator" content="WordPress 5.8.1" />
	<link rel="canonical" href="<?= $canonical; ?>">
	<?php if(isset($url_prev)): ?>
		<link rel="prev" href="<?= $url_prev;?>" />
	<?php endif; ?>
	<?php if (isset($url_next)): ?>
		<link rel="next" href="<?= $url_next;?>" />
	<?php endif; ?>

	<meta property="og:image:width" content="560" />
	<meta property="og:image:height" content="315" />
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= $url; ?>" />
	<meta property="og:site_name" content="<?= $site_name;?>" />

	<meta name='robots' content='noindex, nofollow' />

	<link rel='shortlink' href='<?= $url ?>?' />

	<link rel="icon" href="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" sizes="32x32" />
	<link rel="icon" href="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" sizes="192x192" />
	<link rel="apple-touch-icon" href="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" />
	<meta name="msapplication-TileImage" content="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" />

	<link rel="stylesheet" href="<?= base_url('fileAdmin') ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url('fileAdmin') ?>/font-awesome/4.5.0/css/font-awesome.min.css" />


	<link rel="stylesheet" href="<?= base_url('fileAdmin') ?>/css/fonts.googleapis.com.css" />

	<link rel="stylesheet" href="<?= base_url('fileAdmin') ?>/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="<?= base_url('fileAdmin') ?>/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?= base_url('fileAdmin') ?>/css/ace-rtl.min.css" />

	<script src="<?= base_url('fileAdmin') ?>/js/ace-extra.min.js"></script>

</head>

<body class="no-skin">

	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try{ace.settings.loadState('main-container')}catch(e){}
		</script>

		<div class="main-content">
			<div class="main-content-inner">

				<div class="page-content">

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->

							<div class="error-container">
								<div class="well">
									<h1 class="grey lighter smaller">
										<span class="blue bigger-125">
											<i class="ace-icon fa fa-sitemap"></i>
											404
										</span>
										Halaman tidak ditemukan
									</h1>

									<hr />
									<h3 class="lighter smaller">
										Kami mencari di mana-mana tetapi kami tidak dapat menemukannya!
									</h3>

									<div>

										<div class="space"></div>
										<h4 class="smaller">Coba salah satu dari cara berikut ini:</h4>

										<ul class="list-unstyled spaced inline bigger-110 margin-15">
											<li>
												<i class="ace-icon fa fa-hand-o-right blue"></i>
												Periksa kembali url anda
											</li>

											<li>
												<i class="ace-icon fa fa-hand-o-right blue"></i>
												Hubungi developer.
											</li>
										</ul>
									</div>

									<hr />
									<div class="space"></div>

									<div class="center">
										<a href="javascript:history.back()" class="btn btn-grey">
											<i class="ace-icon fa fa-arrow-left"></i>
											Kembali
										</a>
										<a href="<?= $pesan_wa ?>" class="btn btn-success">
											Kontak Developer&nbsp;
											<i class="ace-icon fa fa-whatsapp"></i>
										</a>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div>

	<script src="<?= base_url('fileAdmin') ?>/js/jquery-2.1.4.min.js"></script>

	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url('fileAdmin') ?>/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>
	<script src="<?= base_url('fileAdmin') ?>/js/bootstrap.min.js"></script>

	<script src="<?= base_url('fileAdmin') ?>/js/ace-elements.min.js"></script>
	<script src="<?= base_url('fileAdmin') ?>/js/ace.min.js"></script>

</body>
</html>

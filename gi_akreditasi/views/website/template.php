<?php 

if (isset($canonical) && isset($url)) {
	$canonical 	= $canonical;
	$url 		= $url;
}else{
	$canonical 	= site_url('');
	$url 		= site_url('');
}

$hari_ini = date('Y-m-d');

?>
<!DOCTYPE html> <html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel='dns-prefetch' href='//fonts.googleapis.com' />
	<link rel='dns-prefetch' href='//s.w.org' />

	<link rel="alternate" type="application/rss+xml" title="<?= $site_title ?> &raquo; Feed" href="<?= base_url('fileWeb/') ?>feed/" />
	<link rel="alternate" type="application/rss+xml" title="<?= $site_title ?> &raquo; Comments Feed" href="<?= base_url('fileWeb/') ?>comments/feed/" />
	
	<link rel='stylesheet' id='wp-block-library-css'  href='<?= base_url('fileWeb/') ?>css/style-block.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='fontawesome-css'  href='<?= base_url('fileWeb/') ?>third-party/font-awesome/css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='education-hub-google-fonts-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A600%2C400%2C400italic%2C300%2C100%2C700%7CMerriweather+Sans%3A400%2C700' type='text/css' media='all' />
	<link rel='stylesheet' id='education-hub-style-css'  href='<?= base_url('fileWeb/css/') ?>style.css' type='text/css' media='all' />
	<link rel='stylesheet' id='education-hub-block-style-css'  href='<?= base_url('fileWeb') ?>/css/blocks.css' type='text/css' media='all' />
	<link rel="stylesheet" type="text/css" href="<?= base_url('fileWeb/responsive-iframe.css') ?>">


	<script type='text/javascript' src="<?= base_url('fileWeb/js') ?>/jquery.min.js"></script>
	<script type='text/javascript' src="<?= base_url('fileWeb/js') ?>/jquery-migrate.min.js"></script>
	<script src="<?= base_url() ?>fileAdmin/js/jquery-2.1.4.min.js"></script>

	<script type='text/javascript' src='<?= site_url('fileWeb/js') ?>/skip-link-focus-fix.min.js' id='education-hub-skip-link-focus-fix-js'></script>
	<script type='text/javascript' src='<?= base_url('fileWeb/') ?>/third-party/cycle2/js/jquery.cycle2.min.js' id='cycle2-js'></script>
	<script type='text/javascript' src='<?= site_url('fileWeb/js') ?>/custom.min.js' id='education-hub-custom-js'></script>
	<script type='text/javascript' id='education-hub-navigation-js-extra'>
		/* <![CDATA[ */
		var EducationHubScreenReaderText = {"expand":"<span class=\"screen-reader-text\">expand child menu<\/span>","collapse":"<span class=\"screen-reader-text\">collapse child menu<\/span>"};
		/* ]]> */
	</script>
	<script type='text/javascript' src='<?= site_url('fileWeb/js') ?>/navigation.min.js' id='education-hub-navigation-js'></script>
	<script type='text/javascript' src='<?= base_url('fileWeb/') ?>js/wp-embed.min.js' id='wp-embed-js'></script>

	<link rel='shortlink' href='<?= $url ?>?' />

	<link rel="icon" href="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" sizes="32x32" />
	<link rel="icon" href="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" sizes="192x192" />
	<link rel="apple-touch-icon" href="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" />
	<meta name="msapplication-TileImage" content="<?= base_url('fileWeb/') ?>images/<?= $site_favicon ?>" />
</head>

<body class="page-template-default page page-id-12 custom-background wp-custom-logo wp-embed-responsive site-layout-fluid global-layout-right-sidebar">

	<div id="page" class="container hfeed site">
		<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
		<div id="tophead">
			<div class="container">
				<div id="quick-contact">
					<?php if (isset($site_email)): ?>
						<ul>
							<li class="">
								<a href="mailto:<?= $site_email ?>">
									<span class="fa fa-envelope" style="margin-right: 5px"></span>
									<?= $site_email ?></a>
								</li>
							</ul>
						<?php endif; ?>

						<div class="top-news border-left">
							<span class="fa fa-calendar" style="margin-right: 5px"></span>
							<span><?= tanggal_indo($hari_ini); ?></span>
							<span style="margin-right: 5px">|</span>
							<span class="fa fa-clock-o" style="margin-right: 5px"></span>
							<span id="timestamp"></span>
						</div>
					</div>

				</div>
			</div>

			<?php include 'part/header.php'; ?>
			<?php include 'part/navbar.php'; ?>

			<?php 
			if ($contents) {
				echo $contents;
			}
			?>

			<div id="footer-widgets">
				<div class="container">
					<div class="inner-wrapper">
						<?php 
						$sql_query = $this->db->query("SELECT * FROM tb_sosmedweb ORDER BY nama_sosmed ASC");
						if($sql_query->num_rows() > 0):
							?>
							<div class="footer-active-3 footer-widget-area">
								<aside id="education-hub-social-2" class="widget education_hub_widget_social">
									<h3 class="widget-title">Link Sosial Media</h3>
									<ul id="menu-social-menu-1" class="menu">
										<?php 
										foreach($sql_query->result() as $row):
											?>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-<?= $row->id_sosmed ?>">
												<a href="<?= $row->link_sosmed ?>">
													<span class="screen-reader-text"><?= $row->nama_sosmed ?></span>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</aside>
							</div>
						<?php endif; ?>

						<div class="footer-active-3 footer-widget-area">
							<aside id="nav_menu-2" class="widget widget_nav_menu">
								<h3 class="widget-title">Kategori</h3>
								<div class="menu-quick-links-container">
									<ul id="menu-quick-links-1" class="menu">
										<?php 
										$query = $this->db->query("SELECT * FROM tb_kategori ORDER BY id_kategori ASC LIMIT 6");
										foreach($query->result() as $row):
											$query = $this->db->query("SELECT * FROM tb_instrumen WHERE kategori_instrumen = '$row->id_kategori'");
											$jumlah_data = $query->num_rows();
											?>
											<li class="menu-item menu-item-<?= $row->id_kategori ?>">
												<a href="<?= site_url('kategori/'.$row->slug_kategori) ?>">
													<?= ucwords($row->nama_kategori) ?>
													<span style="float: right;">(<?= $jumlah_data ?>)</span>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</aside>
						</div>
						<div class="footer-active-3 footer-widget-area">
							<aside id="recent-posts-3" class="widget widget_recent_entries">
								<h3 class="widget-title">Halaman</h3>
								<ul>
									<?php 
									$query = $this->db->query("SELECT * FROM tb_halaman ORDER BY nama_halaman, id_halaman DESC LIMIT 6");
									foreach($query->result() as $row):
										?>
										<li>
											<a href="<?= site_url('halaman/'.$row->slug_halaman) ?>"><?= ucwords($row->nama_halaman) ?></a>
										</li>
									<?php endforeach; ?>
								</ul>

							</aside>
						</div>
					</div>
				</div>
			</div>
			<?php include 'part/footer.php'; ?>
		</div>

		<a href="#page" class="scrollup" id="btn-scrollup">
			<i class="fa fa-chevron-up">
			</i>
		</a>
		
		<script type="text/javascript" src="<?= base_url('fileWeb/js/goblog.js') ?>"></script>

	</body>
	</html>

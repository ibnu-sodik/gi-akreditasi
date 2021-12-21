<header id="masthead" class="site-header" role="banner">
	<div class="container">
		<div class="site-branding">

			<a href="<?= base_url() ?>" class="custom-logo-link" rel="beranda" title="Beranda" aria-current="page">
				<img width="188" height="171" src="<?= base_url('fileWeb/images/'.$site_logo); ?>" class="custom-logo" alt="<?= $site_title ?> ">
			</a>
			<div id="site-identity">
				<p class="site-title">
					<a href="https://demo.wenthemes.com/education-hub/" rel="beranda" title="Beranda"><?= $site_title ?> </a>
				</p>
				<p class="site-description"><?= $site_name ?> </p>
			</div>

		</div>

		<div class="search-section">
			<form role="search" method="GET" class="search-form" action="<?= site_url('search') ?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<label>
					<span class="screen-reader-text">Pencarian:</span>
					<input type="search" class="search-field" placeholder="Pencarian..." name="search_query" title="Pencarian:" required>
				</label>
				<input type="submit" class="search-submit" value="Cari">
			</form>
		</div>

	</div>
	<!-- .container -->
</header>
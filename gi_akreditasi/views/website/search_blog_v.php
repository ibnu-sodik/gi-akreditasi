<div id="content" class="site-content">
	<div class="container">
		<div class="inner-wrapper">    
			<section id="primary" class="content-area">
				<main id="main" class="site-main" role="main">


					<header class="page-header">
						<h1 class="page-title"><span><?= $judul ?></span></h1>
					</header><!-- .page-header -->


					<?php foreach($pencarian->result() as $row): ?>
						<article id="post-<?= $row->id_instrumen ?>" class="post-<?= $row->id_instrumen ?> post type-post status-publish format-standard has-post-thumbnail hentry category-<?= strtolower($row->nama_kategori) ?>">
							<header class="entry-header">
								<h2 class="entry-title">
									<a href="<?= site_url('instrumen/'.$row->slug_instrumen) ?>" rel="bookmark"><?= ucwords($row->nama_instrumen) ?></a>
								</h2>
								<div class="entry-meta">
									<span class="posted-on">
										<a href="javascript:void(0)" rel="bookmark">
											<time class="entry-date published" datetime="<?= $row->tanggal_up ?>"><?= tanggal_indo($row->tanggal_up) ?></time>
										</a>
									</span>	
								</div>
							</header>

							<footer class="entry-footer">
								<span class="cat-links">
									<a href="<?= site_url('kategori/'.$row->slug_kategori) ?>" rel="category tag"><?= ucwords($row->nama_kategori) ?></a>
								</span>
							</footer>
						</article>
					<?php endforeach; ?>

					<?= $pagination ?>

				</main>
			</section>

			<div id="sidebar-primary" class="widget-area" role="complementary">

				<?php if ($kategori->num_rows() > 0): ?>
					<aside id="categories-2" class="widget widget_categories">
						<h2 class="widget-title">Kategori Instrumen <span style="float: right;">(<?= $kategori->num_rows() ?>)</span></h2>
						<ul>
							<?php 
							foreach ($kategori->result() as $row):
								$query = $this->db->query("SELECT * FROM tb_instrumen WHERE kategori_instrumen = '$row->id_kategori'");
								$jumlah_data = $query->num_rows();
								?>
								<li>
									<a href="<?= site_url('kategori/'.$row->slug_kategori) ?>">
										<?= ucwords($row->nama_kategori) ?>
										<span style="float: right;">(<?= $jumlah_data ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</aside>
				<?php endif; ?>

				<aside id="recent-posts-2" class="widget widget_recent_entries">
					<h2 class="widget-title">Video <?= $site_title ?> Official</h2>
					<ul>
						<?php 
						foreach($video->result() as $row):
							?>
							<li>
								<a href="<?= site_url('video/'.$row->slug_video) ?>"><?= $row->nama_video ?></a>
							</li>
							<?php 
						endforeach;
						?>
					</ul>

				</aside>

			</div>
		</div>
	</div>
</div>
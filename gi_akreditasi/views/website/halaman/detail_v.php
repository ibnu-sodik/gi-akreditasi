<div id="content" class="site-content">
	<div class="container">
		<div class="inner-wrapper">    
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<article id="post-<?= $id_halaman ?>" class="post-<?= $id_halaman ?> post type-post status-publish format-standard has-post-thumbnail hentry category-events">
						<header class="entry-header">
							<h1 class="entry-title"><?= $title ?></h1>
							<div class="entry-meta">
								<span class="posted-on">
									<a href="javascript:void(0)" rel="bookmark">
										<time class="entry-date published" datetime="<?= $post_date ?>">
											<?= tanggal_indo($post_date) ?>
										</time>
									</a>
								</span>	
							</div>
						</header>

						<div class="entry-content">
							<?= $konten ?>
						</div>
					</article>

				</main>
			</div>

			<div id="sidebar-primary" class="widget-area" role="complementary">

				<aside id="recent-posts-2" class="widget widget_recent_entries">
					<h2 class="widget-title"><?= $limit_post ?> Instrumen Terbaru</h2>
					<ul>
						<?php 
						foreach($instrumen_baru->result() as $row):
							?>
							<li>
								<a href="<?= site_url('instrumen/'.$row->slug_instrumen) ?>"><?= $row->nama_instrumen ?></a>
							</li>
							<?php 
						endforeach;
						?>
					</ul>
				</aside>

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
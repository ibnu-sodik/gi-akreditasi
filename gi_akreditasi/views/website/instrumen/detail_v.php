<div id="content" class="site-content">
	<div class="container">
		<div class="inner-wrapper">    
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<article id="post-<?= $id_instrumen ?>" class="post-<?= $id_instrumen ?> post type-post status-publish format-standard has-post-thumbnail hentry category-events">
						<header class="entry-header">
							<h1 class="entry-title"><?= $title ?></h1>
							<div class="entry-meta">
								<span class="posted-on">
									<a href="javascript:void(0)" rel="bookmark">
										<time class="entry-date published" datetime="<?= $post_date ?>"><?= tanggal_indo($post_date) ?></time>
									</a>
								</span>	
							</div>
						</header>

						<div class="entry-content">
							<?= $konten ?>
						</div>
						<footer class="entry-footer">
							<span class="cat-links">
								<a href="<?= site_url('kategori/'.$slug_kategori) ?>" rel="category tag"><?= $nama_kat ?></a>
							</span>	
						</footer>
					</article>

					<?php 
					$prev = $instrumen_sebelumnya;
					$next = $instrumen_selanjutnya;
					if (($prev->num_rows() > 0) OR ($next->num_rows() > 0)):
						?>
					<nav class="navigation post-navigation" role="navigation" aria-label="Posts">
						<h2 class="screen-reader-text">Post navigation</h2>
						<div class="nav-links">
							<?php 
							if ($prev->num_rows() > 0):
								foreach ($prev->result() as $row):
									?>
									<div class="nav-previous">
										<a title="<?= $row->nama_instrumen ?>" href="<?= site_url('instrumen/'.$row->slug_instrumen) ?>" rel="prev">
											<span class="fa fa-chevron-circle-left"></span>&nbsp;
											<?= batasi_kata($row->nama_instrumen, 5).'...' ?>
										</a>
									</div>
									<?php 
								endforeach;
							endif;
							?>
							<?php 
							if ($next->num_rows() > 0):
								foreach ($next->result() as $row):
									?>
									<div class="nav-next">
										<a title="<?= $row->nama_instrumen ?>" href="<?= site_url('instrumen/'.$row->slug_instrumen) ?>" rel="next">
											<?= batasi_kata($row->nama_instrumen, 5).'...' ?>&nbsp;
											<span class="fa fa-chevron-circle-right"></span>
										</a> 
									</div>
									<?php 
								endforeach;
							endif;
							?>
						</div>
					</nav>
				<?php endif; ?>
			</main>
		</div>

		<div id="sidebar-primary" class="widget-area" role="complementary">
			<?php 
			if ($instrumen_by_kategori->num_rows() > 0):
				$jumlah = $instrumen_by_kategori->num_rows();
				$data_kat = $instrumen_by_kategori->row();
				?>
				<aside id="categories" class="widget widget_categories">
					<h2 class="widget-title"><?= $jumlah ?> Instrumen lain dari <?= $data_kat->nama_kategori ?></h2>
					<ul>
						<?php 
						foreach ($instrumen_by_kategori->result() as $row):
							?>
							<li>
								<a href="<?= site_url('instrumen/'.$row->slug_instrumen) ?>"><?= $row->nama_instrumen ?></a>
							</li>
							<?php 
						endforeach;
						?>
					</ul>
				</aside>
				<?php
			endif;
			?>

			<?php 
			if ($kategori->num_rows() > 0):
				foreach ($kategori->result() as $row):
					?>
					<aside id="categories" class="widget widget_categories">
						<h2 class="widget-title"><?= $row->nama_kategori ?></h2>
						<ul id="categories">
							<?php 
							$query = $this->db->query("SELECT * FROM tb_instrumen WHERE kategori_instrumen = '$row->id_kategori'");
							foreach($query->result() as $row_in):
								?>
								<li>
									<a href="<?= site_url('instrumen/'.$row_in->slug_instrumen) ?>"><?= $row_in->nama_instrumen ?></a>
								</li>
								<?php 
							endforeach;
							?>
						</ul>
					</aside>
					<?php 
				endforeach;
			endif;
			?>

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
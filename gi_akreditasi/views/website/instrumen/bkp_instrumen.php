<?php 
foreach($instrumen->result() as $row):
	$konten = batasi_kata($row->deskripsi_instrumen, 15);
	?>
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

		<div class="entry-content">
			<?= nl2br($konten) ?>
		</div>

		<footer class="entry-footer">
			<span class="cat-links">
				<a href="<?= site_url('kategori/'.$row->slug_kategori) ?>" rel="category tag"><?= ucwords($row->nama_kategori) ?></a>
			</span>
		</footer>
	</article>
<?php endforeach; ?>
<?= $pagination; ?>
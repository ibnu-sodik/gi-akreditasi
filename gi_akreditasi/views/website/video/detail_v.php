
<link rel="stylesheet" href="<?= base_url('fileWeb/light-gallery/dist/css/lightgallery.css') ?>" />
<link rel="stylesheet" href="<?= base_url('fileWeb/css/lg-video.css') ?>" />

<div id="content" class="site-content">
	<div class="container">
		<div class="inner-wrapper">    
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<article id="post-<?= $id_video ?>" class="post-<?= $id_video ?> post type-post status-publish format-standard has-post-thumbnail hentry category-events">
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
							<iframe id="ytplayer" type="text/html" width="100%" height="460"
							src="<?= getYoutubeEmbedUrl($link) ?>"
							frameborder="0"></iframe>
							<hr>
							<?= nl2br($konten) ?>
						</div>
						<footer class="entry-footer">
							<span class="cat-links">
								<a target="_blank" href="<?= $link ?>" rel="category tag">Link Video</a>
							</span>	
						</footer>
					</article>
				</main>
			</div>

			<div id="sidebar-primary" class="widget-area" role="complementary">
				<?php if ($video_lain->num_rows() > 0): ?>
					<aside class="widget widget_recent_entries">
						<h2 class="widget-title">
							Playlist
						</h2>
						<ul id="videoList">
							<?php foreach ($video_lain->result() as $row):	?>
								<li>
									<div class="services">
										<a class="video-list" href="https://www.youtube.com/watch?v=<?= getYouTubeVideoId($row->link_video) ?>">
											<img src="<?= getThumbnailYt($row->link_video, 'MAXIMUM') ?>">
											<div class="play-button">
												<img class="play-but" src="<?= site_url('fileWeb/images/play-button.png') ?>">
											</div>
										</a>
									</div>
									<a href="<?= site_url('video/'.$row->slug_video) ?>"><?= batasi_kata($row->nama_video, 10) ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</aside>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>

<script src="<?= base_url('fileWeb/light-gallery/lib/jquery.mousewheel.min.js') ?>"></script>
<script src="<?= base_url('fileWeb/light-gallery/lib/picturefill.min.js') ?>"></script>

<script src="<?= base_url('fileWeb/light-gallery/dist/js/lightgallery.min.js') ?>"></script>

<script src="<?= base_url('fileWeb') ?>/light-gallery/modules/lg-share.min.js"></script>
<script src="<?= base_url('fileWeb') ?>/light-gallery/modules/lg-video.min.js"></script>
<script src="<?= base_url('fileWeb') ?>/light-gallery/modules/lg-zoom.min.js"></script>
<script src="<?= base_url('fileWeb') ?>/light-gallery/modules/lg-thumbnail.min.js"></script>
<script src="<?= base_url('fileWeb') ?>/light-gallery/modules/lg-fullscreen.min.js"></script>
<script type="text/javascript">


	$(document).ready(function() {
		$("#main").lightGallery({
			selector: '.video',
			thumbnail: true,
			counter:true,
			html:true 
		}); 
		$("#videoList").lightGallery({
			selector: '.video-list',
			thumbnail: true,
			counter:true,
			html:true 
		}); 
	});
</script>
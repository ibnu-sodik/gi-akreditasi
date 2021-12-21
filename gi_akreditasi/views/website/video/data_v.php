
<link rel="stylesheet" href="<?= base_url('fileWeb/light-gallery/dist/css/lightgallery.css') ?>" />
<link type="text/css" rel="stylesheet" href="<?= base_url('fileWeb/css/lg-video.css') ?>" />

<div id="featured-content">
	<div class="container">
		<div class="inner-wrapper featured-content-column-3" id="galeriVideo">
			<?php foreach ($video->result() as $row): ?>
				<article>
					<a  class="video" data-sub-html="#kapsion<?= $row->id_video ?>" href="https://www.youtube.com/watch?v=<?= getYouTubeVideoId($row->link_video) ?>">
						<img src="<?= getThumbnailYt($row->link_video, 'MAXIMUM') ?>">
					</a>
					<div class="entry-content">
						<h3>
							<a href="<?= site_url('video/'.$row->slug_video) ?>">
								<span id="kapsion<?= $row->id_video ?>"><?= $row->nama_video; ?></span>
							</a>
						</h3>
						<div>
							<?= batasi_kata($row->deskripsi_video, 20).' ...' ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<?= $pagination; ?>
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
		$("#galeriVideo").lightGallery({
			selector: '.video',
			thumbnail: true,
			counter:true,
			html:true 
		}); 
	});
</script>
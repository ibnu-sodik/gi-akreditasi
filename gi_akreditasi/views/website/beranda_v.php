<?php 
$set_hp = $data_homepage->row();
?>

<link rel="stylesheet" href="<?= base_url('fileWeb/light-gallery/dist/css/lightgallery.css') ?>" />
<link type="text/css" rel="stylesheet" href="<?= base_url('fileWeb/css/lg-video.css') ?>" />


<?php if ($set_hp->hp_slide == 1): ?>
	<?php if ($data_slide->num_rows() > 0): ?>
		<div id="featured-slider">
			<div class="container">
				<div class="cycle-slideshow" id="main-slider" data-cycle-fx="fadeout" data-cycle-speed="1000" data-cycle-pause-on-hover="true" data-cycle-loader="true" data-cycle-log="true" data-cycle-swipe="true" data-cycle-auto-height="container" data-cycle-caption-template="<h3>{{title}}</h3><p>{{excerpt}}</p>" data-cycle-timeout="3000" data-cycle-slides="article" style="height: 300px;">

					<div class="cycle-prev"></div>
					<div class="cycle-next"></div>

					<?php foreach ($data_slide->result() as $row): ?>						
						<article class="cycle-slide <?= (($row->status_aktif == 1) ? 'cycle-slide-active' : '') ?>" data-cycle-title="<?= $row->judul_slide ?>" data-cycle-excerpt="<?= $row->konten_slide ?>" style="visibility: hidden; position: absolute; top: 0px; left: 0px; z-index: 99; opacity: 1; display: block;">

							<img src="<?= base_url('uploads/slide/'.$row->gambar_slide) ?>" alt="<?= $row->judul_slide ?>">

						</article>

						<?php if (empty($row->judul_slide)): ?>
							<div class="cycle-caption">
								<h3><?= $site_name ?></h3>
								<p><?= $site_description ?></p>
							</div>
						<?php endif; ?>

					<?php endforeach ?>
				</div>
			</div>
		</div>
		<?php 
	endif;
endif; 
?>

<?php 
if($set_hp->hp_sambutan == 1):
	if($data_sambutan->num_rows() > 0):
		foreach($data_sambutan->result() as $row):
			$src = base_url('uploads/sambutan/'.$row->gambar_sambutan);
			?>
			<div id="featured-content">
				<div class="container">
					<div class="inner-wrapper featured-content-column-1">
						<article>
							<header class="entry-header">
								<h1 class="entry-title">Salam dari kami.</h1>
							</header>
						</article>
					</div>
					<div class="inner-wrapper featured-content-column-1"  id="gambarSambutan">
						<article>
							<a class="gambar_sambutan" href="<?= $src ?>">
								<img class="img-responsive round" src="<?= $src ?>" alt="<?= $row->gambar_sambutan ?>" align="left" hspace="10" vspace="10" />
							</a>
							
							<div class="entry-content">
								<div>
									<?= $row->konten_sambutan ?>
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>
			<?php 
		endforeach;
	endif;
endif;
?>

<?php 
if ($set_hp->hp_konten == 1):
	if ($data_konten->num_rows() > 0):
		foreach($data_konten->result() as $row):
			?>
			<div id="featured-content">
				<div class="container">				
					<div class="inner-wrapper featured-content-column-1">
						<article>
							<header class="entry-header">
								<h1 class="entry-title"><?= $site_title ?></h1>
							</header>
						</article>
					</div>
					<div class="inner-wrapper featured-content-column-1">
						<article>
							<div class="entry-content">
								<div>
									<?= $row->isi_konten ?>
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>
			<?php 
		endforeach;
	endif;
endif;
?>

<?php 
if ($set_hp->hp_video == 1):
	if ($video_baru->num_rows() > 0):
		?>
		<div id="featured-content">
			<div class="container">
				<div class="inner-wrapper featured-content-column-1">
					<article>
						<header class="entry-header">
							<h1 class="entry-title">Video <?= $site_title ?> Official</h1>
						</header>
					</article>
				</div>
				<div class="inner-wrapper featured-content-column-3" id="galeriVideo">				
					<?php foreach ($video_baru->result() as $row): ?>
						<article>
							<a  class="video" data-sub-html="#kapsion<?= $row->id_video ?>" href="https://www.youtube.com/watch?v=<?= getYouTubeVideoId($row->link_video) ?>">
								<img src="<?= getThumbnailYt($row->link_video, 'MAXIMUM') ?>">
							</a>
							<div class="news-content">
								<h3>
									<a href="<?= site_url('video/'.$row->slug_video) ?>">
										<span id="kapsion<?= $row->id_video ?>"><?= $row->nama_video; ?></span>
									</a>
								</h3>
								<div class="block-meta">
									<a href="javascript:void(0)" rel="bookmark">
										<time class="entry-date published" datetime="<?= $row->tgl_upload ?>"><?= tanggal_indo($row->tgl_upload) ?></time>
									</a>	  					
								</div>
								<?= batasi_kata($row->deskripsi_video, 20).' ...' ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php 
	endif;
endif;
?>

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
		$("#gambarSambutan").lightGallery({
			selector: '.gambar_sambutan',
			thumbnail: true,
			counter:true,
			html:true 
		}); 
		$("#galeriVideo").lightGallery({
			selector: '.video',
			thumbnail: true,
			counter:true,
			html:true 
		}); 
	});
</script>
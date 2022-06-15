<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap-treeview.min.css" />
<div id="content" class="site-content">
	<div class="container">
		<div class="inner-wrapper">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<header class="entry-header">
						<h1 class="entry-title"></h1>
					</header>
					<div style="margin-bottom:5px "></div>
					<div id="treeview2"></div>

					<div style="margin-bottom:5px "></div>
				</main>
			</div>

			<div id="sidebar-primary" class="widget-area" role="complementary">

				<?php if ($kategori_terisi->num_rows() > 0): ?>
					<aside id="categories-2" class="widget widget_categories">
						<h2 class="widget-title">Kategori Instrumen <span style="float: right;">(<?= $kategori_terisi->num_rows() ?>)</span></h2>
						<ul>
							<?php 
							foreach ($kategori_terisi->result() as $row):
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
<script src="<?= base_url() ?>fileAdmin/js/bootstrap-treeview.js"></script>
<script type="text/javascript">
	var defaultData = [
	<?php
	$kategori = $this->instrumen_model->getKategori();
	$no = 0;
	foreach ($kategori as $key => $value) {
		$no++;
		$subKat = $this->instrumen_model->getSubKategori($value['id_kategori']);
		echo "{
			text: '$no. $value[nama_kategori]',
			tags: ['".count($subKat)."'],
			nodes : [
			";
			$no1 = 0;
			foreach ($subKat as $key2 => $value2) {
				$no1++;
				$instrumen = $this->instrumen_model->getInstrumen($value2['id_kategori']);
				echo "{
					text: '$no1. $value2[nama_kategori]',
					tags: ['".count($instrumen)."'],
					nodes: [
					";
					$no2 = 0;
					foreach ($instrumen as $key3 => $value3) {
						$no2++;
						$link = site_url('instrumen/'.$value3["slug_instrumen"]);
						echo "{text: '".$no2.". <a href=".$link.">".ucwords($value3['nama_instrumen'])."</a>'},";
					}
					echo "]
				},";
			}
			echo "]
		},";

	}
	?>
	];

	$('#treeview2').treeview({
		levels: 1,
		expandIcon: 'glyphicon glyphicon-folder-close',
		collapseIcon: 'glyphicon glyphicon-folder-open',
		showTags: true,
		enableLinks: true,
		data: defaultData
	});
</script>
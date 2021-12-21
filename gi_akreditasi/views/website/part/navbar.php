<?php 
$uri_nama = $this->uri->segment(1);
?>
<div id="main-nav" class="clear-fix">
	<div class="container">
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-expanded="false">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<i class="fa fa-bars"></i>
				<i class="fa fa-close"></i>
			Menu</button>
			<div class="wrap-menu-content">
				<div class="menu-header-menu-container">
					<ul id="primary-menu" class="menu">
						<?php 
						$sql_m1 = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'main' AND parent_id = '0' ORDER BY urut");
						if ($sql_m1->num_rows() > 0):
							foreach ($sql_m1->result() as $row):
								if ($uri_nama == strtolower($row->judul_menu)) {
									$link_aktif = "current-menu-item";
								}else{
									$link_aktif = "";
								}
								if ($row->jenis_link == 1) {
									$link = site_url($row->link);
								}elseif ($row->jenis_link == 2) {
									$link = $row->link;
								}
								$id_menu = $row->id_menu;
								$sql_m2 = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'main' AND parent_id = '$id_menu' ORDER BY urut");
								if($sql_m2->num_rows() > 0):
									?>
									<li id="menu-item-<?= $row->id_menu ?>" class="<?= $link_aktif ?> menu-item menu-item-has-children menu-item-<?= $row->id_menu ?>" aria-haspopup="true">
										<a href="#" target="<?= $row->target ?>"><?= strtoupper($row->judul_menu) ?></a>
										<button class="dropdown-toggle" aria-expanded="false">
											<span class="screen-reader-text"></span>
										</button>
										<ul class="sub-menu">
											<?php 
											foreach ($sql_m2->result() as $row2):
												if ($row2->jenis_link == '1') {
													$link2 = site_url($row2->link);
												}elseif ($row2->jenis_link == '2') {
													$link2 = $row2->link;
												}
												?>
												<li id="menu-item-<?= $row2->id_menu ?>" class="menu-item menu-item-<?= $row2->id_menu ?>">
													<a href="<?= $link2 ?>" target="<?= $row2->target ?>"><?= strtoupper($row2->judul_menu) ?></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</li>
									<?php 
								else: 
									?>
									<li id="menu-item-<?= $row->id_menu ?>" class="<?= $link_aktif ?> menu-item menu-item-<?= $row->id_menu ?>">
										<a href="<?= $link ?>" target="<?= $row->target ?>"><?= strtoupper($row->judul_menu); ?></a>
									</li>
									<?php 
								endif;
							endforeach;
						endif;
						?>
					</ul>
				</div>           
			</div>
		</nav>
	</div>
</div>
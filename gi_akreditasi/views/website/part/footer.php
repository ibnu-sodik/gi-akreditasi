
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">    
		<div id="footer-navigation" class="menu-quick-links-container">
			<ul id="menu-quick-links-2" class="menu">
				<?php 
				$query = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'second' AND parent_id = '0' ORDER BY urut ");
				if ($query->num_rows() > 0):
					foreach ($query->result() as $row):						
						if ($row->jenis_link == 1) {
							$link = site_url($row->link);
						}elseif ($row->jenis_link == 2) {
							$link = $row->link;
						}
						?>
						<li class="menu-item menu-item-<?= $row->link ?> menu-item-<?= $row->id_menu ?>">
							<a href="<?= $link ?>" target="<?= $row->target ?>"><?= ucwords($row->judul_menu) ?></a>
						</li>
						<?php 
					endforeach;
				endif;
				?>
			</ul>
		</div>	    	    	      
		<div class="copyright">
			Copyright. All rights reserved.	     
		</div>
		<div class="site-info">
			<?= $site_name ?>
			<span class="sep"> | </span>
			<?php
			if ($tahun_buat == date('Y')) {
				echo date('Y');
			}else{
				echo $tahun_buat.' - '.date('Y');
			}
			?>
		</div>
	</div>
</footer>
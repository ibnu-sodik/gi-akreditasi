
<div id="content" class="site-content"><div class="container">
	<div class="inner-wrapper">    

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">			

				<div class="swal-warning" data-flashdata="<?= $this->session->flashdata('swalWarning'); ?>"></div>
				<div class="swal-info" data-flashdata="<?= $this->session->flashdata('swalInfo'); ?>"></div>
				<div class="swal-error" data-flashdata="<?= $this->session->flashdata('swalError'); ?>"></div>
				<div class="swal-sukses" data-flashdata="<?= $this->session->flashdata('swalSukses'); ?>"></div>

				<article id="post-108" class="post-108 page type-page status-publish hentry">
					<header class="entry-header">
						<h1 class="entry-title">Kontak</h1>	</header>

						<div class="entry-content">
							<div role="form" class="wpcf7" id="wpcf7-f110-p108-o1" lang="en-US" dir="ltr">
								<div class="screen-reader-response">
									<p role="status" aria-live="polite" aria-atomic="true"></p>
									<ul></ul>
								</div>
								<form action="<?= $form_action ?>" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init">
									<div style="display: none;">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
									</div>
									<p>
										<label> Nama (harus diisi)
											<br>
											<span class="wpcf7-form-control-wrap nama">
												<input autocomplete="off" type="text" name="nama" value="<?= set_value('nama') ?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Nama">
												<?= form_error('nama') ?>
											</span> 
										</label>
									</p>
									<p>
										<label>Email (harus diisi)
											<br>
											<span class="wpcf7-form-control-wrap email"><input autocomplete="off" type="email" name="email" value="<?= set_value('email') ?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email">
												<?= form_error('email') ?>
											</span> 
										</label>
									</p>
									<p>
										<label> Subjek
											<br>
											<span class="wpcf7-form-control-wrap subjek">
												<input autocomplete="off" type="text" name="subjek" value="<?= set_value('subjek') ?>" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Subjek">
											</span> 
										</label>
									</p>
									<p>
										<label> Pesan (harus diisi)
											<br>
											<span class="wpcf7-form-control-wrap pesan">
												<textarea name="pesan" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Pesan..."><?= set_value('pesan') ?></textarea>
												<?= form_error('pesan') ?>
											</span> 
										</label>
									</p>
									<p>
										<input type="submit" value="Kirim" class="wpcf7-form-control wpcf7-submit">
										<span class="ajax-loader"></span>
									</p>
									<div class="wpcf7-response-output" aria-hidden="true">
									</div>
								</form>
							</div>
						</div>

						<footer class="entry-footer">
						</footer>
					</article>

				</main>
			</div>

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
<script src="<?= base_url() ?>fileAdmin/js/sweetalert.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/notifikasi.js"></script>

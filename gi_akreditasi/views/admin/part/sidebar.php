<?php 

$query = $this->db->get('tb_homepage');
$homepage = $query->row();

?>
<div id="sidebar" class="sidebar responsive ace-save-state">
	<script type="text/javascript">
		try{ace.settings.loadState('sidebar')}catch(e){}
	</script>

	<div class="sidebar-shortcuts" id="sidebar-shortcuts">			
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<button class="btn-block" id="timestamp" style="font-size: 2em;"></button>
		</div>

		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="" id="timestamp"></span>
		</div>
	</div>

	<ul class="nav nav-list">
		<li class="<?= (($title == 'Dashboard') ? 'active' : ''); ?>">
			<a href="<?= site_url('admin/dashboard') ?>">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="<?= (($title == 'Instrumen' || $title == 'Kategori') ? 'active open' : '') ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-folder-open-o"></i>
				<span class="menu-text">
					Data Master
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li class="<?= (($title == 'Instrumen') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/instrumen') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Data Instrumen
					</a>

					<b class="arrow"></b>
				</li>

				<li class="<?= (($title == 'Kategori') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/kategori') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Kategori Instrumen
					</a>

					<b class="arrow"></b>
				</li>

			</ul>
		</li>

		<li class="<?= (($title == "Halaman" ||	$title == "Tambah Halaman" ||	$title == "Edit Halaman") ? 'active' : ''); ?>">
			<a href="<?= site_url('admin/halaman') ?>">
				<i class="menu-icon fa fa-list-alt"></i>
				<span class="menu-text"> Halaman </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="<?= (($title == 'Menu' || $title == 'Menu Footer' || $title == 'Pengaturan Website' || $title == 'Pengaturan Homepage' || $title == 'Pengaturan Konten' || $title == 'Tambah Konten' || $title == 'Pengaturan Sambutan' || $title == 'Pengaturan Video' || $title == "Tambah Sambutan") ? 'active open' : ''); ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-wrench"></i>
				<span class="menu-text"> Pengaturan </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="<?= (($title == "Menu" || $title == 'Menu Footer') ? 'active' : '') ?>">
					<a href="<?= site_url('admin/menu') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Menu
					</a>

					<b class="arrow"></b>
				</li>

				<li class="<?= (($title == 'Pengaturan Homepage') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/homepage') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Homepage
					</a>

					<b class="arrow"></b>
				</li>

				<li class="<?= (($title == 'Pengaturan Website') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/website') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Website
					</a>

					<b class="arrow"></b>
				</li>
				
				<li class="<?= (($title == 'Pengaturan Sambutan' || $title == 'Tambah Sambutan') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/homepage/sambutan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Sambutan
					</a>

					<b class="arrow"></b>
				</li>
				
				<li class="<?= (($title == 'Pengaturan Konten' || $title == 'Tambah Konten') ? 'active' : ''); ?>">
					<a href="<?= site_url('admin/homepage/konten') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Konten
					</a>

					<b class="arrow"></b>
				</li>

			</ul>
		</li>

		<li class="<?= (($title == "Video" ||	$title == "Tambah Video" ||	$title == "Edit Video") ? 'active' : ''); ?>">
			<a href="<?= site_url('admin/video') ?>">
				<i class="menu-icon fa fa-film"></i>
				<span class="menu-text"> Video </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="<?= (($title == "Slide" ||	$title == "Tambah Slide" ||	$title == "Edit Slide") ? 'active' : ''); ?>">
			<a href="<?= site_url('admin/slide') ?>">
				<i class="menu-icon fa fa-image"></i>
				<span class="menu-text"> Slide Gambar </span>
			</a>

			<b class="arrow"></b>
		</li>

		<?php 
		if ($this->session->userdata('access') == 1):
			?>
			<li class="<?= (($title == "User" ||	$title == "Tambah User" ||	$title == "Edit User") ? 'active' : ''); ?>">
				<a href="<?= site_url('admin/user') ?>">
					<i class="menu-icon fa fa-user-secret"></i>
					<span class="menu-text"> User </span>
				</a>

				<b class="arrow"></b>
			</li>
			<?php 
		endif;
		?>

	</ul>

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>
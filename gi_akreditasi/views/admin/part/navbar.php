
<div id="navbar" class="navbar navbar-default          ace-save-state">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="<?= site_url('') ?>" class="navbar-brand">
				<small>
					<i class="fa fa-certificate"></i>
					<?= $site_name ?>
				</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">

				<li class="">
					<a href="<?= base_url('') ?>" title="Lihat Website" target="_blank">
						<i class="ace-icon fa fa-eye"></i>
					</a>
				</li>

				<li class="light-blue dropdown-modal">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<?php 
						$file = file_exists(base_url('./uploads/user/'.$user_data['foto']));
						if (!$file && !empty($user_data['foto'])): ?>
							<img class="nav-user-photo" src="<?= base_url() ?>uploads/user/<?= $user_data['foto'] ?>" alt="<?= $user_data['full_name']; ?>" /><?php else: ?>
							<img class="nav-user-photo" src="<?= get_gravatar($user_data['email']) ?>" alt="<?= $user_data['full_name'] ?>" />
						<?php endif ?>

						<span class="user-info">
							<small>Welcome,</small>
							<?= $user_data['username']; ?>
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?= site_url('admin/profil/pengaturan') ?>">
								<i class="ace-icon fa fa-cog"></i>
								Settings
							</a>
						</li>

						<li>
							<a href="<?= site_url('admin/profil') ?>">
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="<?= site_url('admin/logout') ?>" class="tombol-logout">
								<i class="ace-icon fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
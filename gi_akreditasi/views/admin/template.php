<!DOCTYPE HTML> 
<html lang="en-US">
<?php
if ($this->session->userdata('login_goblog') != TRUE) {
	$text = "Silahkan login terlebih dahulu.";
	$this->session->set_flashdata('swalInfo', $text);
	$url = base_url('admin');
	redirect($url);
}
$user_id 	= $this->session->userdata('id_login');
$query 		= $this->db->get_where('tb_user', array('id' => $user_id));
$user_data 	= $query->row_array();
$timestamp = strtotime(date('Y-m-d H:i:s'));
?>
<head>
	<meta charset="utf-8" />
	<?php if(isset($title)): ?>
		<title><?=$title?> | <?= $site_title; ?></title><?php else: ?>
		<title><?= $site_title; ?></title>
	<?php endif; ?>

	<meta name="description" content="<?= $site_description; ?>">
	<meta name="author" content="<?= $site_author; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<meta name="csrf-token" content="<?= $csrf_token ?>">
	<meta property="og:image" content="<?= base_url('fileWeb/images/'.$site_logo); ?>" />
	<meta property="og:image:secure_url" content="<?= base_url('fileWeb/images/'.$site_logo); ?>" />
	<meta property="og:image:width" content="560" />
	<meta property="og:image:height" content="315" />

	<link rel="shortcut icon" href="<?= base_url('fileWeb/images/'.$site_logo) ?>" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?= base_url('fileWeb/images/'.$site_logo) ?>">

	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="application" />
	<meta property="og:url" content="<?= $url; ?>" />
	<meta property="og:site_name" content="<?= $site_name;?>" />

	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/font-awesome/4.5.0/css/font-awesome.min.css" />


	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/fonts.googleapis.com.css" />

	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/chosen.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/colorbox.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/ace-rtl.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/dropify/dropify.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/select2.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/pnotify.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/toastr.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/ace-ie.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>fileAdmin/css/custom.css" />

	<script src="<?= base_url(); ?>fileAdmin/js/jquery-2.1.4.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/ace-extra.min.js"></script>

	<script src="<?= base_url(); ?>fileAdmin/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/jquery.dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url('fileAdmin/js/select2.min.js'); ?>"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/chosen.jquery.min.js"></script>

	<script src="<?= base_url(); ?>fileAdmin/js/jquery-ui.custom.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/jquery.ui.touch-punch.min.js"></script>

	<script src="<?= base_url(); ?>fileAdmin/js/jquery.colorbox.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/jquery.toast.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/ace-elements.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/ace.min.js"></script>

</head>

<body class="skin-3">

	<?php include 'part/navbar.php'; ?>

	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try{ace.settings.loadState('main-container')}catch(e){}
		</script>

		<?php include 'part/sidebar.php'; ?>

		<div class="main-content">

			<div class="main-content-inner">

				<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="<?= site_url('admin/dashboard') ?>">Home</a>
						</li>
						<?php if (isset($bc_menu)): ?>
							<li><a href="<?= site_url('admin/'.strtolower($bc_menu)) ?>"><?= $bc_menu ?></a></li>							
						<?php endif ?>
						<?php if (isset($bc_aktif)): ?>
							<li class="active"><?= $bc_aktif ?></li>							
						<?php endif ?>
					</ul>						
				</div>

				<div class="page-content">
					<?php include 'part/ace-settings.php'; ?>

					<?php 
					if ($contents) {
						echo $contents;
					}
					?>

				</div>
			</div>
		</div>

		<div class="swal-warning" data-flashdata="<?= $this->session->flashdata('swalWarning'); ?>"></div>
		<div class="swal-info" data-flashdata="<?= $this->session->flashdata('swalInfo'); ?>"></div>
		<div class="swal-error" data-flashdata="<?= $this->session->flashdata('swalError'); ?>"></div>
		<div class="swal-sukses" data-flashdata="<?= $this->session->flashdata('swalSukses'); ?>"></div>

		<div class="pnotify-admin" data-flashdata="<?= $this->session->flashdata('pnotifySukses'); ?>"></div>
		<div class="pnotify-notice" data-flashdata="<?= $this->session->flashdata('pnotifyWarning'); ?>"></div>
		<div class="pnotify-info" data-flashdata="<?= $this->session->flashdata('pnotifyInfo'); ?>"></div>
		<div class="pnotify-error" data-flashdata="<?= $this->session->flashdata('pnotifyError'); ?>"></div>

		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="blue bolder"><?= singkatan($site_name) ?></span>
						- <?= $site_name ?> &copy; <?= date('Y') ?>
					</span>
					&nbsp; &nbsp;
					<span class="action-buttons">
						<?php 
						$sql_query = $this->db->query("SELECT * FROM tb_sosmedweb ORDER BY nama_sosmed ASC");
						foreach($sql_query->result() as $row):
							?>
							<a href="<?= $row->link_sosmed ?>" target="_blank" title="<?= $row->nama_sosmed ?>">
								<i class="ace-icon <?= $row->ikon_sosmed ?> bigger-150"></i>
							</a>
						<?php endforeach; ?>
					</span>
				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-200"></i>
		</a>
	</div>
	
	<script src="<?= base_url(); ?>fileAdmin/js/jquery.pnotify.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/sweetalert.min.js"></script>
	<script src="<?= base_url(); ?>fileAdmin/js/notifikasi.js"></script>

	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url(); ?>fileAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>


	<script src="<?= base_url(); ?>fileAdmin/js/custom.js"></script>

	<script type="text/javascript">
		$(function() {

			var serverTime = <?php if(!empty($timestamp)){ echo $timestamp; } ?>;
			var counterTime=0;
			var date;

			setInterval(function() {
				date = new Date();

				serverTime = serverTime+1;

				date.setTime(serverTime*1000);
				time = date.toLocaleTimeString();
				$("#timestamp").html(time);
			}, 1000);

		});
	</script>
</body>
</html>
<?php 
$data = $data_homepage->row();
?>
<div class="page-header">
	<h1>
		<?= $bc_aktif; ?>
		<?php if (isset($sm_text)): ?>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?= $sm_text; ?>
			</small>			
		<?php endif ?>
	</h1>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="table-responsive">
			<table class="table table-hover table-bordered border-primary">
				<tr>
					<th>Tampilkan Konten Sambutan ?</th>
					<td class="text-center">:</td>
					<td class="text-center">
						<label>
							<input data-id="<?= $data->id_hp ?>" data-nama="hp_sambutan" <?= $data->hp_sambutan == 1 ? 'checked' : ''; ?> class="ace ace-switch ace-switch-6 hp_sambutan" type="checkbox">
							<span class="lbl"></span>
						</label>
					</td>
				</tr>
				<tr>
					<th>Tampilkan Konten Utama ?</th>
					<td class="text-center">:</td>
					<td class="text-center">

						<label>
							<input data-id="<?= $data->id_hp ?>" data-nama="hp_konten" <?= $data->hp_konten == 1 ? 'checked' : ''; ?> class="ace ace-switch ace-switch-6 hp_konten" type="checkbox">
							<span class="lbl"></span>
						</label>
					</td>
				</tr>
				<tr>
					<th>Tampilkan Konten Video ?</th>
					<td class="text-center">:</td>
					<td class="text-center">

						<label>
							<input data-id="<?= $data->id_hp ?>" data-nama="hp_video" <?= $data->hp_video == 1 ? 'checked' : ''; ?> class="ace ace-switch ace-switch-6 hp_video" type="checkbox">
							<span class="lbl"></span>
						</label>
					</td>
				</tr>
				<tr>
					<th>Tampilkan Konten Slide ?</th>
					<td class="text-center">:</td>
					<td class="text-center">

						<label>
							<input data-id="<?= $data->id_hp ?>" data-nama="hp_slide" <?= $data->hp_slide == 1 ? 'checked' : ''; ?> class="ace ace-switch ace-switch-6 hp_slide" type="checkbox">
							<span class="lbl"></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php 
	$pilihan = array(
		'hp_sambutan' 	=> 'hp_sambutan',
		'hp_konten' 	=> 'hp_konten',
		'hp_video' 		=> 'hp_video',
		'hp_slide' 		=> 'hp_slide',
	);

	foreach ($pilihan as $key => $value):
		?>
		$(document).ready(function() {

			$('.<?= $key ?>').change(function() {
				var id 		= $(this).data('id');
				var nama 	= $(this).data('nama');
				var status 	= $(this).prop('checked') === true ? 1 : 0;

				$.ajax({
					type : "GET",
					dataType : "JSON",
					url : "<?= site_url('admin/homepage/ubah_status/') ?>"+id,
					data : {
						'status' : status,
						'nama' : nama
					},
					success : function(data)
					{
						var tipe = data.tipe;
						toastr.options.closeButton = true;
						toastr.options.closeMethod = 'fadeOut';
						toastr.options.closeDuration = 100;
						Command: toastr[tipe](data.pesan, data.notif);
					}
				});

			});

		});
	<?php endforeach; ?>
</script>
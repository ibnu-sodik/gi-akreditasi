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

<a href="<?=site_url('admin/instrumen/tambah');?>" class="btn btn-primary tombol-layang tombol-modal"><i class="fa fa-fw fa-plus fa-1x"></i></a>

<div class="row">
	<div class="col-md-3 col-xs-12">
		<div class="control-group">
			<label class="form-control-label bolder blue">Filter Berdasarkan Kategori</label>
			<?php foreach ($fil_kategori->result() as $row): ?>			
				<input type="hidden" class="val_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<div class="checkbox">
					<label>
						<input name="kategori" class="fil_selector kategori ace ace-checkbox-2" type="checkbox" value="<?= $row->id_kategori ?>" />
						<span class="lbl"> <?= $row->nama_kategori ?></span>
					</label>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="col-md-9 col-xs-12">
		<div class="table-responsive">
			<table id="dynamic-table" class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center">Nomor</th>
						<th class="text-center">Nama Instrumen</th>
						<th class="text-center">Opsi</th>
					</tr>
				</thead>
				<tbody id="filter_data">
					
				</tbody>
			</table>
		</div>
	</div>
	<!-- <div class="col-sm-12 text-center" id="pagination_link">

	</div> -->
</div>

<!-- modal detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="modalCategory" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Detail Instrumen</h4>
			</div>
			<div class="modal-body">
				<div id="showData">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>fileAdmin/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/buttons.colVis.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/dataTables.select.min.js"></script>


<script type="text/javascript">
	$(document).ready(function() {

		$(document).on('click', '#tombolHapus', function(e) {
			var id_instrumen = $(this).data('id');
			swalHapus(id_instrumen);
			e.preventDefault();
		});

		function swalHapus(id_instrumen) {
			swal({
				title: "Apakah Anda Yakin?",
				text: "Data Ini Akan Saya Hapus!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				showCancelButton: true,
				allowOutsideClick: false
			})
			.then((willDelete) => {
				if (willDelete) {
					document.location.href = "<?= site_url('admin/instrumen/hapus/') ?>"+id_instrumen;
				}else{
					swal("Batal", "Data tidak kami hapus :)", "error");
				}
			});
		}

		$(document).on('click', "#detailInstrumen", function(e) {
			$('#detailModal #showData').html('<div id="loading"></div>');
			var id = $(this).data('id');
			e.preventDefault();

			var csrfName = $('.val_csrf').attr('name')
			var csrfHash = $('.val_csrf').val();

			$.ajax({
				url : "<?= site_url('admin/instrumen/detail/') ?>"+id,
				method : "GET",
				dataType : "JSON",
				data : {
					[csrfName]: csrfHash
				},
				success : function(data)
				{
					// Update CSRF hash
					$('.val_csrf').val(data.token);
					$('#detailModal #showData').html(data.detail_instrumen);
				}
			});
			$('#detailModal').modal('show');
		});

		filter_data(1);

		function filter_data(page)
		{
			$('#filter_data').html('<tr><td colspan="3"><div id="loading"></div></td></tr>');

			var action = 'get_data';
			var kategori = filtrasi('kategori');

			var csrfName = $('.val_csrf').attr('name')
			var csrfHash = $('.val_csrf').val();

			$.ajax({
				url : "<?= base_url('admin/instrumen/get_data/') ?>"+page,
				method : "POST",
				dataType : "JSON",
				data : {
					[csrfName]: csrfHash,
					action : action,
					kategori : kategori
				},
				success : function(data)
				{
          			 // Update CSRF hash
          			 $('.val_csrf').val(data.token);
          			 $('#filter_data').html(data.daftar_instrumen);
          			 // $('#pagination_link').html(data.pagination_link);
          			 $('#dynamic-table').DataTable();
          			}
          		});
		}

		function filtrasi(class_name) {
			var filter = [];
			$('.' + class_name + ':checked').each(function() {
				filter.push($(this).val());
			});
			return filter;
		}

		$(document).on("click", ".pagination li a", function(event){
			event.preventDefault();
			var page = $(this).data("ci-pagination-page");
			filter_data(page);
		});

		$('.fil_selector').click(function() {
			filter_data(1);
		});

	});

</script>
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/select2.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>fileAdmin/css/bootstrap-treeview.min.css" />
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
	<div class="col-md-4 col-xs-12" id="formTambah">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Tambah Kategori</h4>
			</div>
			<form method="post" action="<?=site_url('admin/kategori/simpan_kategori')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<div class="widget-body">
					<div class="widget-main">
						<div>
							<label for="form-field-8">Parent Kategori</label>

							<select class="form-control select2" name="parent_id" id="parent_id" data-placeholder="Pilih Parent Kategori...">
								<option value="0">INDUK KATEGORI</option>
								<?php foreach ($data_kategori->result() as $row): ?>
									<option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
								<?php endforeach ?>
							</select>
							<?= form_error('parent_id'); ?>
						</div>
						<hr>
						<div>
							<label for="form-field-9">Nama Kategori</label>

							<input type="text" name="kategori" id="kategori" required placeholder="Nama Kategori" class="form-control" autofocus>
							<?= form_error('kategori'); ?>
						</div>
						<hr>
						<div>						
							<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-save"></i> Simpan</button>
							<button type="reset" class="btn btn-secondary">Reset <i class="fa fa-fw fa-remove"></i></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4 col-xs-12" id="formEdit" style="display: none;">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Edit Kategori</h4>
			</div>
			<form method="post" action="<?=site_url('admin/kategori/update_kategori')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<div class="widget-body">
					<div class="widget-main">
						<div>
							<label for="form-field-8">Parent Kategori</label>

							<select class="form-control select2" name="parent_id" id="parent_id" data-placeholder="Pilih Parent Kategori...">
								<option value="0">INDUK KATEGORI</option>
								<?php foreach ($data_kategori->result() as $row): ?>
									<option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
								<?php endforeach ?>
							</select>
							<?= form_error('parent_id'); ?>
						</div>
						<hr>
						<div>
							<label for="kategori2">Nama Kategori</label>

							<input type="text" name="kategori2" id="kategori2" required placeholder="Nama Kategori" class="form-control" autofocus>
							<?= form_error('kategori2'); ?>
						</div>
						<hr>
						<div>						
							<input type="hidden" name="id_kategori">
							<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-save"></i> Simpan</button>
							<button type="reset" class="btn btn-secondary" id="batalEdit">Batal <i class="fa fa-fw fa-remove"></i></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="col-md-4 col-xs-12">		
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div id="treeview_json"></div>
	</div>
	<div class="col-md-4 col-xs-12">
		<table id="dynamic-table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">Nomor</th>
					<th>Nama Kategori</th>
					<th class="text-center">Opsi</th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$no = 0;
				foreach ($data_kategori->result() as $row):
					$no++;
					?>
					<tr>
						<td class="text-center"><?= $no; ?></td>
						<td><?= $row->nama_kategori; ?></td>

						<td class="text-center">
							<a href="javascript:void(0);" title="Edit" data-id="<?=$row->id_kategori; ?>" data-kategori="<?=$row->nama_kategori; ?>" data-parentId="<?=$row->parent_id; ?>" class="green edit-kategori">
								<i class="ace-icon fa fa-edit bigger-130"></i>
							</a>

							<a class="red tombol-hapus" href="<?=site_url('admin/kategori/hapus_kategori/'.$row->id_kategori); ?>">
								<i class="ace-icon fa fa-trash bigger-130"></i>
							</a>


						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalCategory" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Kategori</h4>
			</div>
			<form method="post" action="<?=site_url('admin/kategori/update_kategori')?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="parent_id2">INDUK KATEGORI</label>
						<select class="form-control select2" name="parent_id2" id="parent_id2" data-placeholder="Pilih Parent Kategori...">
							<option value="0">INDUK KATEGORI</option>
							<?php foreach ($data_kategori->result() as $row): ?>
								<option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('parent_id2'); ?>
					</div>
					<div class="form-group">
						<label for="kategori2">Nama Kategori</label>
						<input type="hidden" name="id_kategori">
						<input type="text" name="kategori2" id="kategori2" required autofocus placeholder="Nama Kategori" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>fileAdmin/js/dataTables.select.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/bootstrap-treeview.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/select2.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/summernote/summernote.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/form.js"></script>
<script type="text/javascript">
	$(document).ready(function(){  

		var treeData;  

		$.ajax({  
			type: "GET",    
			url: "<?= base_url() ?>item/getItem",  
			dataType: "json",         
			success: function(response)    
			{  
				initTree(response)  
			}     
		});  

		function initTree(treeData) {  
			$('#treeview_json').treeview(
			{
				// levels: 1,
				expandIcon: 'glyphicon glyphicon-folder-close',
				collapseIcon: 'glyphicon glyphicon-folder-open',
				showTags: true,
				data: treeData
			});  
		}

	});

	jQuery(function($) {

		$('#batalEdit').on('click', function() {
			document.getElementById('formTambah').style.display = 'block';
			document.getElementById('formEdit').style.display = 'none';
		})

		$('.edit-kategori').on('click', function() {
			document.getElementById('formTambah').style.display = 'none';
			document.getElementById('formEdit').style.display = 'block';
			var id = $(this).data('id');
			var name = $(this).data('kategori');

			$('[name="id_kategori"]').val(id);
			$('[name="kategori2"]').val(name);
	 	// $('#editModal').modal('show');
	 });

		var myTable = $('#dynamic-table').DataTable();

	});

	$(".select2").select2({
		width: '100%',
		theme: "classic"
	});
</script>
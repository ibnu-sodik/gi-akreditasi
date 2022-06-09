tampilkan_data_prodi();

var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    	// Form Tambah Prodi
    	$("#tombolSimpanProdi").on('click', function (e) {
    		e.preventDefault();
    		var nama_prodi = $('#nama_prodi').val();
    		var kode_prodi = $('#kode_prodi').val();

    		if (nama_prodi === "") {
    			Command: toastr['warning']('Nama Prodi harus diisi.', 'Perhatian');
    		}else if (kode_prodi === ""){
    			Command: toastr['warning']('Kode Prodi harus diisi.', 'Perhatian');
    		}else if(kode_prodi.length > 3){
    			Command: toastr['warning']('Kode Prodi tidak boleh lebih dari 3.', 'Perhatian');
    		}else{
    			$.ajax({
    				url: "<?= base_url('admin/jalurpendaftaran/simpan_prodi') ?>",
    				type: "POST",
    				data: {
    					nama_prodi: nama_prodi,
    					kode_prodi: kode_prodi,
    					[csrfName]: csrfHash
    				},
    				cache: false,
    				success : function (dataResult) {
    					var dataResult = JSON.parse(dataResult);
    					// var ajax_load = "<img src='<?= base_url('dists/images/loading.gif') ?>' alt='loading...' />";
    					var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...' />";
    					if (dataResult.statusCode == 200) {
    						$('#formTambahProdi')[0].reset();
    						$('#loading').html(ajax_load);
    						// tampilkan_data_prodi();
    						csrfName = dataResult.csrfName;
    						csrfHash = dataResult.csrfHash;
    						$('#tabelKu').dataTable();
    						var tipe = dataResult.tipe;
    						toastr.options.closeButton = true;
    						toastr.options.closeMethod = 'fadeOut';
    						toastr.options.closeDuration = 100;
    						Command: toastr[tipe](dataResult.pesan, dataResult.notif);
    					}
    					else if(dataResult.statusCode==201){  
    						$('#loading').html(ajax_load);
    						// tampilkan_data_prodi();
    						csrfName = dataResult.csrfName;
    						csrfHash = dataResult.csrfHash;
    						$('#tabelKu').dataTable();
    						var tipe = dataResult.tipe;
    						toastr.options.closeButton = true;
    						toastr.options.closeMethod = 'fadeOut';
    						toastr.options.closeDuration = 100;
    						Command: toastr[tipe](dataResult.pesan, dataResult.notif);
    					}
    				},
    				error : function() {
    					var dataResult = JSON.parse(dataResult);$('#dataProdi').html(ajax_load).tampilkan_data_prodi();
    					csrfName = dataResult.csrfName;
    					csrfHash = dataResult.csrfHash;
    					$('#tabelKu').dataTable();
    					var tipe = dataResult.tipe;
    					toastr.options.closeButton = true;
    					toastr.options.closeMethod = 'fadeOut';
    					toastr.options.closeDuration = 100;
    					Command: toastr[tipe](dataResult.pesan, dataResult.notif);

    				}
    			})
    		}
    	});

		// fungsi tanpilkan data prodi
		function tampilkan_data_prodi() {
			$.ajax({
				type  : 'ajax',
				url   : "<?= base_url('admin/jalurpendaftaran/get_data_prodi') ?>",
				async : false,
				dataType : 'JSON',
				cache : false,
				data : {[csrfName]: csrfHash},
				success : function(data) {
					csrfName = data.csrfName;
					csrfHash = data.csrfHash;
					$('#dataProdi').html(data.dataProdi);
					$('#tabelKu').dataTable();
				}
			})
		};


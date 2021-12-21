<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('admin/Homepage_model', 'homepage_model');
		$this->load->model('admin/Sambutan_model', 'sambutan_model');
		$this->load->model('admin/Konten_model', 'konten_model');

		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('swalError', $text);
			redirect('admin');
		}	
		$this->load->library('upload');
	}

	public function update_konten($id_konten)
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('isi_konten', 'Isi Konten', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$text = "Terjadi kesalahan saat akan menyimpan data.";
			$this->session->set_flashdata('swalError', $text);
			$this->konten();
		}else{
			$isi_konten 	= $this->input->post('isi_konten');

			$this->konten_model->update_konten($id_konten, $isi_konten);

					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id_login'), 3, 'Update Data Konten');

			$text = "Konten berhasil disimpan.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/homepage/konten');
		}
	}

	public function simpan_konten()
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('isi_konten', 'Isi Konten', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$text = "Terjadi kesalahan saat akan menyimpan data.";
			$this->session->set_flashdata('swalError', $text);
			$this->tambah_data_konten();
		}else{
			$isi_konten 	= $this->input->post('isi_konten');

			$this->konten_model->simpan_konten($isi_konten);

					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id_login'), 2, 'Menambah Data Konten');

			$text = "Sambutan berhasil disimpan.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/homepage/konten');
		}
	}

	public function tambah_data_konten()
	{	
		$data_konten 				= $this->konten_model->get_konten_data();
		if ($data_konten->num_rows() > 0) {
			$text = "Dilarang mengakses halaman ini.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/homepage/konten');
		}	
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/homepage/konten');
		$data['canonical'] 			= site_url('admin/homepage/konten');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Konten";
		$data['bc_aktif'] 			= "Tambah Konten";
		$data['title'] 				= "Tambah Konten";

		$data['form_action'] 		= site_url('admin/homepage/simpan_konten');

		$this->template->load('admin/template', 'admin/homepage/tambah_konten_v', $data);
	}

	public function konten()
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/homepage');
		$data['canonical'] 			= site_url('admin/homepage');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Homepage";
		$data['bc_aktif'] 			= "Pengaturan Konten";
		$data['title'] 				= "Pengaturan Konten";


		$data_konten 				= $this->konten_model->get_konten_data();
		if ($data_konten->num_rows() == 0) {
			$text = "Silahkan tambah homepage untuk konten.";
			$this->session->set_flashdata('swalInfo', $text);
			$this->tambah_data_konten();
		} else {
			$data['form_action'] 	= site_url('admin/homepage/update_konten');
			$data['data_konten'] 	= $this->konten_model->get_konten_data();
			$this->template->load('admin/template', 'admin/homepage/data_konten_hp_v', $data);
		}
	}

	public function update_sambutan($id_sambutan)
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('konten_sambutan', 'Konten Sambutan', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		error_reporting(0);
		if ($this->form_validation->run() === FALSE) {
			$text = "Terjadi kesalahan saat akan menyimpan data.";
			$this->session->set_flashdata('swalError', $text);
			$this->sambutan();
		} else {

			$config['upload_path'] = './uploads/images/';
			$config['allowed_types'] = 'jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if (!empty($_FILES['filefoto']['name'])) {
				$data = $this->sambutan_model->get_sambutan_data_by_id($id_sambutan)->row();
				$gambar_lama = 'uploads/sambutan/'.$data->gambar_sambutan;
				unlink($gambar_lama);

				if ($this->upload->do_upload('filefoto')) {
					$img 			= $this->upload->data();
					$image 			= $img['file_name'];
					$konten_sambutan 	= $this->input->post('konten_sambutan');

					$this->compress_tinify($image);
					$this->sambutan_model->update_sambutan($id_sambutan, $image, $konten_sambutan);

					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
					$this->log_model->save_log($this->session->userdata('id_login'), 3, 'Update Data Kata sambutan');

					$foto_lama = './uploads/images/'.$image;
					unlink($foto_lama);
					
					$text = "Update data berhasil.";
					$this->session->set_flashdata('pnotifySukses', $text);
					redirect('admin/homepage/sambutan');
				} else {
					$text = "Update gagal.";
					$this->session->set_flashdata('pesan_error', $text);
					redirect('admin/homepage/sambutan');
				}
			} else {
				$konten_sambutan 	= $this->input->post('konten_sambutan');

				$this->sambutan_model->update_sambutan_no_img($id_sambutan, $konten_sambutan);

					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$this->log_model->save_log($this->session->userdata('id_login'), 3, 'Update Data Kata sambutan');

				$text = "Update data berhasil.";
				$this->session->set_flashdata('pnotifySukses', $text);
				redirect('admin/homepage/sambutan');
			}

		}
	}

	public function simpan_sambutan()
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('konten_sambutan', 'Kata Sambutan', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$text = "Terjadi kesalahan saat akan menyimpan data.";
			$this->session->set_flashdata('swalError', $text);
			$this->tambah_data_sambutan();
		} else {

			$config['upload_path'] = './uploads/images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if (!empty($_FILES['filefoto']['name'])) {
				if ($this->upload->do_upload('filefoto')) {
					$img 			= $this->upload->data();
					$image 			= $img['file_name'];
					$konten_sambutan 	= $this->input->post('konten_sambutan');

					$this->compress_tinify($image);
					$this->sambutan_model->simpan_konten($image, $konten_sambutan);

					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
					$this->log_model->save_log($this->session->userdata('id_login'), 2, 'Menambah Data Baru Kata sambutan');

					$foto_lama = './uploads/images/'.$image;
					unlink($foto_lama);
					
					$text = "Sambutan berhasil disimpan.";
					$this->session->set_flashdata('pnotifySukses', $text);
					redirect('admin/homepage/sambutan');
				} else {
					$text = "Gagal menyimpan data.";
					$this->session->set_flashdata('pnotifyError', $text);
					redirect('admin/homepage/sambutan');
				}
			} else {
				$text = "Gagal mengunggah gambar sambutan.";
				$this->session->set_flashdata('swalError', $text);
				redirect('admin/homepage/sambutan');
			}

		}
	}

	public function tambah_data_sambutan()
	{	
		$data_sambutan 				= $this->sambutan_model->get_sambutan_data();
		if ($data_sambutan->num_rows() > 0) {
			$text = "Dilarang mengakses halaman ini.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/homepage/sambutan');
		}	
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/homepage/sambutan');
		$data['canonical'] 			= site_url('admin/homepage/sambutan');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Sambutan";
		$data['bc_aktif'] 			= "Tambah Sambutan";
		$data['title'] 				= "Tambah Sambutan";

		$data['form_action'] 		= site_url('admin/homepage/simpan_sambutan');

		$this->template->load('admin/template', 'admin/homepage/tambah_sambutan_v', $data);
	}

	public function sambutan()
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/homepage');
		$data['canonical'] 			= site_url('admin/homepage');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Homepage";
		$data['bc_aktif'] 			= "Pengaturan Sambutan";
		$data['title'] 				= "Pengaturan Sambutan";


		$data_sambutan 				= $this->sambutan_model->get_sambutan_data();
		if ($data_sambutan->num_rows() == 0) {
			$text = "Silahkan tambah homepage untuk sambutan.";
			$this->session->set_flashdata('swalInfo', $text);
			$this->tambah_data_sambutan();
		} else {
			$data['form_action'] 	= site_url('admin/homepage/update_sambutan');
			$data['data_sambutan'] 	= $this->sambutan_model->get_sambutan_data();
			$this->template->load('admin/template', 'admin/homepage/data_sambutan_hp_v', $data);
		}
	}

	public function ubah_status($id_hp)
	{
		$data 		= $this->homepage_model->get_data_by_id($id_hp);
		$status 	= $this->input->get('status', TRUE);
		$nama 		= $this->input->get('nama', TRUE);

		$this->homepage_model->ubah_status($id_hp, $nama, $status);
		$pilihan = array(
			'hp_sambutan' 	=> 'Sambutan',
			'hp_konten' 	=> 'Utama',
			'hp_video' 		=> 'Video',
			'hp_slide' 		=> 'Slide',
		);
		foreach ($pilihan as $key => $value) {
			if ($key == $nama) {
				$keterangan = $value;

				if ($status == 1) {
					$text = "Konten $keterangan berhasil ditampilkan.";
					$tipe = "success";
					$notif = "Berhasil..!";
				} else {
					$text = "Konten $keterangan tidak ditampilkan.";
					$tipe = "info";
					$notif = "Perhatian..!";
				}
			}
		}
		$data = array(
			'pesan' => $text, 
			'tipe' 	=> $tipe,
			'notif' => $notif
		);
		echo json_encode($data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('hp_sambutan', 'Konten Sambutan', 'trim|required|is_numeric');
		$this->form_validation->set_rules('hp_konten', 'Konten Fakta', 'trim|required|is_numeric');
		$this->form_validation->set_rules('hp_video', 'Konten Video', 'trim|required|is_numeric');
		$this->form_validation->set_rules('hp_slide', 'Konten Slide', 'trim|required|is_numeric');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$this->tambah_data();
		} else {
			$hp_sambutan 	= $this->input->post('hp_sambutan', TRUE);
			$hp_konten 		= $this->input->post('hp_konten', TRUE);
			$hp_video 		= $this->input->post('hp_video', TRUE);
			$hp_slide 		= $this->input->post('hp_slide', TRUE);

			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id_login'), 2, 'Menambah Data Baru Pengaturan Tampilan Konten');
			$this->homepage_model->simpan($hp_sambutan, $hp_konten, $hp_video, $hp_slide);

			$text = "Data baru konten tampilan berhasil disimpan.";
			$this->session->set_flashdata('pnotify', $text);
			redirect('admin/homepage');
		}
	}

	public function tambah_data()
	{	
		$data_homepage 				= $this->homepage_model->get_data();
		if ($data_homepage->num_rows() > 0) {
			$text = "Dilarang mengakses halaman ini.";
			$this->session->set_flashdata('swalError', $text);
			redirect('admin/homepage');
		}	
		$data['timestamp'] 			= strtotime(date('Y-m-d H:i:s'));
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/homepage');
		$data['canonical'] 			= site_url('admin/homepage');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Homepage";
		$data['bc_aktif'] 			= "Pengaturan Homepage";
		$data['title'] 				= "Pengaturan Homepage";

		$data['form_action'] 		= site_url('admin/homepage/simpan');

		$this->template->load('admin/template', 'admin/homepage/tambah_hp_v', $data);
	}

	public function index()
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/homepage');
		$data['canonical'] 			= site_url('admin/homepage');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Homepage";
		$data['bc_aktif'] 			= "Pengaturan Homepage";
		$data['title'] 				= "Pengaturan Homepage";


		$data_homepage 		= $this->homepage_model->get_data();
		if ($data_homepage->num_rows() == 0) {
			$text = "Silahkan atur homepage terlebih dahulu.";
			$this->session->set_flashdata('swalInfo', $text);
			$this->tambah_data();
		}else{
			$data['form_action'] 		= site_url('admin/homepage/update');
			$data['data_homepage'] 		= $this->homepage_model->get_data();

			$this->template->load('admin/template', 'admin/homepage/set_homepage_v', $data);
		}
		
	}

	public function compress_tinify($gambar_asli)
	{
		$site = $this->site_model->get_site_data()->row_array();
		$this->load->library('tiny_png', array('api_key' => $site['api_tinify']));

		$sumber = './uploads/images/'.$gambar_asli;
		$menuju = './uploads/sambutan/'.$gambar_asli;

		$this->tiny_png->fileCompress($sumber, $menuju);
	}

}

/* End of file Homepage.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Homepage.php */

?>
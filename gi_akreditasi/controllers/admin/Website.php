<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Website_model', 'website_model');
		$this->load->model('admin/Sosmed_model', 'sosmed_model');
		$this->load->library('upload');
	}

	public function update_api()
	{
		$this->form_validation->set_rules('api_tinify', 'API Tinify', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$api_tinify 		= $this->input->post('api_tinify', TRUE);

			$simpan = $this->website_model->simpan_api($api_tinify);

			if ($simpan) {
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update API Tinify website');
			}

			$url 	= site_url('admin/website');
			$text 	= "API Tinify Website berhasil diperbarui";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect($url);
		}
	}

	public function update_kontak()
	{
		$this->form_validation->set_rules('site_email', 'Email Website', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$site_email 		= $this->input->post('site_email', TRUE);

			$simpan = $this->website_model->simpan_kontak($site_email);

			if ($simpan) {
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update data email website');
			}

			$url 	= site_url('admin/website');
			$text 	= "Email Website berhasil diperbarui";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect($url);
		}
	}

	public function update_logo()
	{
		$data 		= $this->site_model->get_site_data()->row();
		$site_name 	= $data->site_name;

		$f_sf 		= "./fileWeb/images/".$data->site_favicon;
		$f_sl 		= "./fileWeb/images/".$data->site_logo;

		$config['upload_path'] 		= './fileWeb/images/';
		$config['allowed_types'] 	= 'png|ico';
		$config['encrypt_name'] 	= TRUE;
		
		$this->upload->initialize($config);

		$site_favicon 	= $_FILES['site_favicon']['name'];
		$site_logo 		= $_FILES['site_logo']['name'];

		error_reporting(0);
		if (!empty($site_favicon) && !empty($site_logo)) {
			unlink($f_sf);
			unlink($f_sl);

			// Upload semua gambar
			if ($this->upload->do_upload('site_favicon')) {
				$sf = $this->upload->data();
				$site_favicon = $sf['file_name'];
			}
			if ($this->upload->do_upload('site_logo')) {
				$sl = $this->upload->data();
				$site_logo = $sl['file_name'];
			}
			$update = $this->website_model->update_img($site_favicon, $site_logo);
			if($update){
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update Logo dan Ikon website');
			}

			$text = 'Logo dan Ikon '.$site_name.' Berhasil Diubah.!';
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/website');
		} elseif (!empty($site_favicon) && empty($site_logo)) {
			// hanya upload favicon
			unlink($f_sf);
			if ($this->upload->do_upload('site_favicon')) {
				$sf = $this->upload->data();
				$site_favicon = $sf['file_name'];
			}
			$update = $this->website_model->update_img_icon($site_favicon);
			if($update){
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update Ikon website');
			}

			$text = 'Ikon '.$site_name.' Berhasil Diubah.!';
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/website');
		} elseif (empty($site_favicon) && !empty($site_logo)) {
			// hanya upload logo
			unlink($f_sl);
			if ($this->upload->do_upload('site_logo')) {
				$sl = $this->upload->data();
				$site_logo = $sl['file_name'];
			}
			$update = $this->website_model->update_img_logo($site_logo);
			if($update){
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update Logo website');
			}

			$text = 'Logo '.$site_name.' Berhasil Diubah.!';
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/website');			
		} else {
			// tidak berubah			
			$text = 'Logo dan Ikon '.$site_name.' Tidak Diubah.!';
			$this->session->set_flashdata('pesan_error', $text);
			redirect('admin/website');			
		}
		// compress tinify
	}

	public function update_sosmed()
	{
		$this->form_validation->set_rules('nama_sosmed2', 'Nama Sosmed', 'trim|required');
		$this->form_validation->set_rules('link_sosmed2', 'Link Sosmed', 'trim|required');
		$this->form_validation->set_rules('ikon_sosmed2', 'Ikon Sosmed', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$url 	= site_url('admin/website');
			$text 	= "Terjadi kesalahan saat akan mengupdate Sosmed Website.";
			$this->session->set_flashdata('pesan_error', $text);
			redirect($url, 'refresh');
		}else{
			$id_sosmed 	 	= $this->input->post('id_sosmed', TRUE);
			$nama_sosmed  	= $this->input->post('nama_sosmed2', TRUE);
			$link_sosmed  	= $this->input->post('link_sosmed2', TRUE);
			$ikon_sosmed  	= $this->input->post('ikon_sosmed2', TRUE);

			$simpan = $this->sosmed_model->update_sosmed($id_sosmed, $nama_sosmed, $link_sosmed, $ikon_sosmed);

			if ($simpan) {
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update Akun Sosial Media '.$nama_sosmed.' pada Website');
			}

			$url 	= site_url('admin/website');
			$text 	= $nama_sosmed." Pada Website berhasil diupdate.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect($url, 'refresh');
		}

	}

	public function simpan_sosmed()
	{
		$this->form_validation->set_rules('nama_sosmed', 'Nama Sosmed', 'trim|required');
		$this->form_validation->set_rules('link_sosmed', 'Link Sosmed', 'trim|required');
		$this->form_validation->set_rules('ikon_sosmed', 'Ikon Sosmed', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$nama_sosmed 		= $this->input->post('nama_sosmed', TRUE);
			$link_sosmed 		= $this->input->post('link_sosmed', TRUE);
			$ikon_sosmed 		= $this->input->post('ikon_sosmed', TRUE);

			$simpan = $this->sosmed_model->simpan_sosmed($nama_sosmed, $link_sosmed, $ikon_sosmed);

			if ($simpan) {
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 1, 'Menambah Akun Sosial Media '.$nama_sosmed.' pada Website');
			}

			$url 	= site_url('admin/website');
			$text 	= "Berhasil menambahkan akun ".$nama_sosmed." pada Website.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect($url, 'refresh');
		}
	}

	public function update()
	{
		$this->form_validation->set_rules('site_title', 'Judul Website', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('site_name', 'Nama Website', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('site_keywords', 'Keywords Website', 'trim|required');
		$this->form_validation->set_rules('site_description', 'Deskripsi Website', 'trim|required');
		$this->form_validation->set_rules('tahun_buat', 'Tahun Pembuatan', 'trim|required');
		$this->form_validation->set_rules('limit_post', 'Batas Jumlah Postingan', 'trim|required|numeric');

		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->index();
		}else{
			$site_name 			= $this->input->post('site_name', TRUE);
			$site_title 		= $this->input->post('site_title', TRUE);
			$site_keywords 		= $this->input->post('site_keywords', TRUE);
			$site_description 	= $this->input->post('site_description', TRUE);
			$tahun_buat 		= $this->input->post('tahun_buat', TRUE);
			$limit_post 		= $this->input->post('limit_post', TRUE);

			$simpan = $this->website_model->simpan_basic($site_name, $site_title, $site_keywords, $site_description, $tahun_buat, $limit_post);

			if ($simpan) {
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update data profil website');
			}

			$url 	= site_url('admin/website');
			$text 	= "Pengaturan berhasil disimpan";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect($url);
		}
	}

	public function index()
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/website');
		$data['canonical'] 			= site_url('admin/website');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Website";
		$data['bc_aktif'] 			= "Pengaturan Website";
		$data['title'] 				= "Pengaturan Website";

		$data['aksi_basic'] 		= site_url('admin/website/update');
		$data['aksi_logo'] 			= site_url('admin/website/update_logo');
		$data['aksi_kontak'] 		= site_url('admin/website/update_kontak');
		$data['aksi_api'] 			= site_url('admin/website/update_api');
		$data['aksi_sosmed'] 		= site_url('admin/website/simpan_sosmed');

		$data['data']				= $this->website_model->get_data();
		$data['data_sosmed']		= $this->sosmed_model->get_data();

		$this->template->load('admin/template', 'admin/website/data_v', $data);
	}

	public function simpan_web()
	{
		$this->load->helper(array('form', 'html'));

		if ($this->site_model->get_site_data()->num_rows() > 0) {
			$url = base_url('admin');
			$text = "Anda tidak berhak berada dihalaman ini.";
			$this->session->set_flashdata('swalError', $text);
			redirect($url);
		}else{
			$this->form_validation->set_rules('site_name', 'Nama Website', 'trim|required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('site_title', 'Judul Website', 'trim|required|min_length[3]|max_length[50]');

			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			$this->form_validation->set_message('required', 'Masukkan %s');

			if ($this->form_validation->run() === FALSE) {
				$text 	= "Periksa kembali data yang anda masukkan.";
				$this->session->set_flashdata('swalError', $text);
				$this->konfigurasi_website();
			} else {			
				$site_name 			= $this->input->post('site_name', TRUE);
				$site_title 		= $this->input->post('site_title', TRUE);
				$site_keywords 		= $this->input->post('site_keywords', TRUE);
				$site_description 	= $this->input->post('site_description', TRUE);

				$this->site_model->simpan_web_pertama($site_name, $site_title, $site_keywords, $site_description);

				$url 	= base_url('admin');
				$text 	= "Website baru berhasil disimpan";
				$this->session->set_flashdata('swalSukses', $text);
				redirect($url);

			}

		}
	}

	public function konfigurasi_website()
	{
		if ($this->site_model->get_site_data()->num_rows() > 0) {
			$url = base_url('admin');
			$text = "Anda tidak berhak berada dihalaman ini.";
			$this->session->set_flashdata('swalError', $text);
			redirect($url);
		}
		$data['form_action'] 	= base_url('admin/website/simpan_web');
		$data['csrf_token'] 	= $this->security->get_csrf_hash();

		$this->load->view('admin/konfigurasi_website_v', $data);
	}

}

/* End of file Website.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Website.php */

?>
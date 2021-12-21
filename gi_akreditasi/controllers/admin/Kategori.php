<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Kategori_model', 'kategori_model');
		$this->load->helper('text');
	}

	public function hapus_kategori($id_kategori)
	{
		$kategori_lama		= $this->kategori_model->get_kategori_by_id($id_kategori)->row_array();
		// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id_login'), 4, 'Menghapus kategori '.$kategori_lama['nama_kategori']);

		$this->kategori_model->hapus_kategori($id_kategori);
		$text = 'Kategori Berhasil Dihapus.!';
		$this->session->set_flashdata('pnotifySukses', $text);
		redirect('admin/kategori');
	}

	public function update_kategori()
	{
		$id = $this->input->post('id_kategori',TRUE);
		$kategori = strip_tags(htmlspecialchars($this->input->post('kategori2',TRUE),ENT_QUOTES));
		$string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $kategori);
		$trim     = trim($string);
		$slug     = strtolower(str_replace(" ", "-", $trim));
		$this->kategori_model->_update_kategori($id, $kategori, $slug);

		// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id_login'), 3, 'Merubah kategori menjadi '.$kategori);
		$text = $kategori. ' Berhasil Diubah.!';
		$this->session->set_flashdata('pnotifySukses', $text);
		redirect('admin/kategori');
	}

	public function simpan_kategori()
	{
		$kategori 	= strip_tags(htmlspecialchars($this->input->post('kategori',TRUE),ENT_QUOTES));
		$string   	= preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $kategori);
		$trim     	= trim($string);
		$slug     	= strtolower(str_replace(" ", "-", $trim));
		$this->kategori_model->_simpan_kategori($kategori, $slug);

		// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$this->log_model->save_log($this->session->userdata('id_login'), 2, 'Menambah kategori '.$kategori);
		$text = 'Berhasil Menambah Kategori '.$kategori;
		$this->session->set_flashdata('pnotifySukses', $text);
		redirect('admin/kategori');
	}

	public function index()
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/kategori');
		$data['canonical'] 			= site_url('admin/kategori');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Kategori";
		$data['bc_aktif'] 			= "Kategori";
		$data['title'] 				= "Kategori";

		$data['data_kategori']		= $this->kategori_model->get_data();

		$this->template->load('admin/template', 'admin/kategori/data_v', $data);
	}

}

/* End of file Kategori.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Kategori.php */

 ?>
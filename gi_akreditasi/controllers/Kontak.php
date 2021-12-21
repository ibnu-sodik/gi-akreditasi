<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Instrumen_model', 'instrumen_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->helper('email');
	}

	public function kirim_pesan()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('pesan', 'Email', 'trim|required');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$text = "Mohon periksa kembali pesan anda.";
			$this->session->set_flashdata('swalWarning', $text);
			$this->index();
		} else {

			$this->load->model('admin/Pesan_model', 'pesan_model');

			$nama 	= $this->input->post('nama', TRUE);
			$email 	= $this->input->post('email', TRUE);
			$subjek = $this->input->post('subjek', TRUE);
			$pesan 	= $this->input->post('pesan', TRUE);

			$this->pesan_model->simpan($nama, $email, $subjek, $pesan);

			$text = "Pesan anda terkirim.!";
			$this->session->set_flashdata('swalSukses', $text);
			redirect('kontak','refresh');
		}

	}

	public function index()
	{		
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_email'] 		= $site['site_email'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['limit_post'] 		= $site['limit_post'];
		$data['title']				= "Kontak";
		$data['bc_link']			= site_url('kontak');
		$data['title']				= "Kontak";

		$data['video']				= $this->beranda_model->get_video();
		$data['instrumen_baru']		= $this->instrumen_model->get_instrumen_baru_limit($site['limit_post']);
		$data['kategori']			= $this->kategori_model->get_kategori();
		
		$data['form_action']		= site_url("kontak/kirim-pesan");

		$this->template->load('website/template', 'website/kontak_v', $data);
	}

}

/* End of file Kontak.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Kontak.php */

?>
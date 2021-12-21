<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('admin/Homepage_model', 'homepage_model');
		$this->load->model('Visitor_model', 'visitor_model');
		$this->visitor_model->hitung_visitor();
	}

	public function index()
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['url']				= site_url('beranda');
		$data['canonical']			= site_url('beranda');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_email'] 		= $site['site_email'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['title']				= "Beranda";
		$data['bc_link']			= site_url('beranda');

		$data['data_slide'] 		= $this->beranda_model->get_slide();
		$data['data_sambutan'] 		= $this->beranda_model->get_sambutan();
		$data['data_konten'] 		= $this->beranda_model->get_konten();
		$data['video_baru']			= $this->beranda_model->get_new_video();
		$data['video_populer']		= $this->beranda_model->get_populer_video();
		
		$data['data_homepage']		= $this->homepage_model->get_data();

		$this->template->load('website/template', 'website/beranda_v', $data);
	}

}

/* End of file Beranda.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Beranda.php */

?>
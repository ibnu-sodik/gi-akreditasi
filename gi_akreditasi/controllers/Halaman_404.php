<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman_404 extends CI_Controller {

	public function index()
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('halaman_404');
		$data['canonical'] 			= site_url('halaman_404');
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
		$data['bc_aktif'] 			= "Halaman 404";
		$data['title']				= "Halaman 404";
		$data['bc_link']			= site_url('halaman_404');

		$nomor_wa 			= "6281314225017";
		$text 				= "Saya mengalami kendala saat akan membuka alamat url pada situs ".site_url('');
		$text .= " Mohon bantuannya.!";
		$data['pesan_wa'] 	= "https://wa.me/".$nomor_wa."?text=".$text;

		$this->load->view('errors/404_page', $data);
	}

}

/* End of file Halaman_404.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Halaman_404.php */

?>
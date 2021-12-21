<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Halaman_model', 'halaman_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Instrumen_model', 'instrumen_model');
	}

	public function index()
	{
		redirect(base_url());
	}

	public function detail($slug)
	{
		$site 						= $this->site_model->get_site_data()->row_array();
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
		$data['title']				= "Halaman";
		$data['bc_link']			= site_url('halaman');
		$data['video']				= $this->beranda_model->get_video();
		$data['instrumen_baru']		= $this->instrumen_model->get_instrumen_baru_limit($site['limit_post']);

		$query = $this->halaman_model->get_data_by_slug($slug);
		if ($query->num_rows() > 0) {
			$value = $query->row();

			$id_halaman 		= $value->id_halaman;
			$data['id_halaman']	= $id_halaman;
			$data['url'] 		= site_url('halaman/'.$value->slug_halaman);
			$data['canonical'] 	= site_url('halaman/'.$value->slug_halaman);
			$data['title'] 		= $value->nama_halaman;
			$data['konten']		= $value->konten_halaman;
			$data['slug']		= $value->slug_halaman;
			$data['bc_aktif']	= $value->nama_halaman;
			if (!empty($value->deskripsi_halaman)) {
				$data['description'] = strip_tags(word_limiter($value->deskripsi_halaman), 15);
			}else{
				$data['description'] = strip_tags(word_limiter($value->konten_halaman), 15);
			}
			$data['post_date'] 		= $value->halaman_date;
			$data['post_update'] 	= $value->halaman_update;

			// $data['artikel_populer'] 	= $this->artikel_model->get_artikel_populer($site['limit_post']);
			// $data['artikel_review'] 	= $this->artikel_model->get_artikel_review($site['limit_post']);

			$this->template->load('website/template', 'website/halaman/detail_v', $data);
		}else{
			redirect($this->index());
		}
	}

}

/* End of file Halaman.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Halaman.php */

?>
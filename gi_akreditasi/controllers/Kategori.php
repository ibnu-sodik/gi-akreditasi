<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Instrumen_model', 'instrumen_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		redirect('instrumen');
	}

	public function detail($slug)
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['site_email'] 		= $site['site_email'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['limit_post']			= $site['limit_post'];
		$data['bc_title']			= "Kategori";
		$data['bc_link']			= site_url('kategori');
		$data['title']				= "Kategori";
		$data['video']				= $this->beranda_model->get_video();
		$data['instrumen_baru']		= $this->instrumen_model->get_instrumen_baru_limit($site['limit_post']);
		$data['all_kategori']			= $this->kategori_model->get_kategori();

		$data_kategori				= $this->kategori_model->get_instrumen_by_kategori($slug);
		if ($data_kategori->num_rows() > 0) {
			$value = $data_kategori->row();

			$id_kategori = $value->id_kategori;

			$jumlah 					= $data_kategori->num_rows();
			$halaman 					= $this->uri->segment(3);
			if (!$halaman) {
				$mati = 0;
			}else{
				$mati = $halaman;
			}
			$limit 						= $site['limit_post'];
			$offset 					= $mati > 0 ? (($mati - 1) * $limit) : $mati;
			$config['base_url'] 		= base_url().'kategori/'.$slug.'/';		
			$config['total_rows'] 		= $jumlah;
			$config['per_page'] 		= $limit;
			$config['uri_segment'] 		= 3;
			$config['use_page_numbers']	= TRUE;

			$config["full_tag_open"] 	= '<div class="nav-links">';
			$config["full_tag_close"]	= '</div>';
			$config["first_tag_open"] 	= '<span>';
			$config["first_tag_close"] 	= '</span>';
			$config["last_tag_open"] 	= '<span>';
			$config["last_tag_close"] 	= '</span>';
			$config['next_link'] 		= '&gt;';
			$config["next_tag_open"] 	= '<span>';
			$config["next_tag_close"] 	= '</span>';
			$config["prev_link"] 		= '&lt;';
			$config["prev_tag_open"] 	= '<span>';
			$config["prev_tag_close"] 	= '</span>';
			$config["cur_tag_open"] 	= '<span class="current page-numbers">';
			$config["cur_tag_close"] 	= '</span>';
			$config["num_tag_open"] 	= ' ';
			$config["num_tag_close"] 	= ' ';

			$config['prev_link'] 		= 'Sebelumnya';
			$config['next_link'] 		= 'Selanjutnya';
			$config['last_link'] 		= 'Terakhir';
			$config['first_link'] 		= 'Pertama';

			$this->pagination->initialize($config);

			$data['pagination']			= $this->pagination->create_links();
			$data['kategori']			= $this->kategori_model->get_kategori_instrumen_perpage($offset, $limit, $id_kategori);

			$data['url'] 				= site_url('kategori/'.$slug);
			$data['canonical'] 			= site_url('kategori/'.$slug);
			$data['bc_link']			= site_url('kategori');

			$data['title']				= "Kategori";
			$data['bc_title']			= "Kategori : $value->nama_kategori";
			$data['sm_text'] 			= "$jumlah instrumen dari kategori $value->nama_kategori";

		} else {
			$dk					= $this->kategori_model->get_kategori_by_slug($slug)->row();
			$data['bc_title']	= "Kategori : ".ucwords($dk->nama_kategori).'.';
			$data['sm_text'] 	= "Tidak ada instrumen pada kategori ".ucwords($dk->nama_kategori).'.';
			$data['pagination'] = "";
		}
		$this->template->load('website/template', 'website/kategori/data_v', $data);
	}

}

/* End of file Kategori.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Kategori.php */

?>
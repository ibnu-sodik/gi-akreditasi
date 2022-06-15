<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Instrumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Instrumen_model', 'instrumen_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->library('pagination');
	}

	public function detail($slug)
	{
		error_reporting(0);
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
		$data['title']				= "Instrumen";
		$data['bc_link']			= site_url('instrumen');
		$data['video']				= $this->beranda_model->get_video();
		$data['instrumen_baru']		= $this->instrumen_model->get_instrumen_baru_limit($site['limit_post']);

		$query = $this->instrumen_model->get_data_by_slug($slug);
		if ($query->num_rows() > 0) {
			$value = $query->row();
			$id_instrumen 		= $value->id_instrumen;
			$kategori_instrumen = $value->kategori_instrumen;
			$data['id_instrumen']	= $id_instrumen;
			$data['url'] 		= site_url('instrumen/'.$value->slug_instrumen);
			$data['canonical'] 	= site_url('instrumen/'.$value->slug_instrumen);
			$data['title'] 		= $value->nama_instrumen;
			$data['konten']		= $value->konten_instrumen;
			$data['slug']		= $value->slug_instrumen;
			$data['bc_aktif']	= $value->nama_instrumen;
			if (!empty($value->deskripsi_instrumen)) {
				$data['description'] = strip_tags(word_limiter($value->deskripsi_instrumen), 15);
			}else{
				$data['description'] = strip_tags(word_limiter($value->konten_instrumen), 15);
			}
			$data['post_date'] 		= $value->tanggal_up;
			$data['nama_kat'] 		= $value->nama_kategori;
			$data['slug_kategori']	= $value->slug_kategori;

			$data['instrumen_by_kategori'] = $this->instrumen_model->get_instrumen_by_kategori($kategori_instrumen, $id_instrumen);
			$data['kategori'] = $this->kategori_model->get_kategori_kecuali($kategori_instrumen);

			$data['instrumen_sebelumnya'] = $this->instrumen_model->get_data_sebelumnya($id_instrumen);
			$data['instrumen_selanjutnya'] = $this->instrumen_model->get_data_selanjutnya($id_instrumen);

			$this->template->load('website/template', 'website/instrumen/detail_v', $data);
		}else{
			redirect('instrumen','refresh');
		}
	}

	public function index()
	{
		$site 						= $this->site_model->get_site_data()->row_array();

		$jumlah 					= $this->instrumen_model->get_instrumen();
		$halaman 					= $this->uri->segment(3);

		if (!$halaman) {
			$mati = 0;
		}else{
			$mati = $halaman;
		}
		$limit 						= $site['limit_post'];
		$offset 					= $mati > 0 ? (($mati - 1) * $limit) : $mati;
		$config['base_url'] 		= base_url().'instrumen/halaman/';		
		$config['total_rows'] 		= $jumlah->num_rows();
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
		$data['instrumen']			= $this->instrumen_model->get_data_perpage($offset, $limit);

		if (empty($this->uri->segment(3))) {
			$next_page = 2;
			$data['canonical'] 	= site_url('instrumen');
			$data['url'] 		= site_url('instrumen');
			$data['url_prev'] 	= "";
		}elseif ($this->uri->segment(3)=='1') {
			$next_page = 2;
			$data['canonical'] 	= site_url('instrumen');
			$data['url'] 		= site_url('instrumen');
			$data['url_prev'] 	= site_url('instrumen');
		}elseif ($this->uri->segment(3)=='2') {
			$next_page 			= $this->uri->segment(3)+1;
			$data['canonical'] 	= site_url('instrumen/halaman/'.$this->uri->segment(3));
			$data['url'] 		= site_url('instrumen/halaman/'.$this->uri->segment(3));
			$data['url_prev'] 	= site_url('instrumen');
		}else{
			$next_page 			= $this->uri->segment(3)+1;
			$prev_page 			= $this->uri->segment(3)-1;
			$data['canonical'] 	= site_url('instrumen/halaman/'.$this->uri->segment(3));
			$data['url'] 		= site_url('instrumen/halaman/'.$this->uri->segment(3));
			$data['url_prev'] 	= site_url('instrumen/halaman/'.$prev_page);
		}
		$data['url_next'] 		= site_url('instrumen/halaman/'.$next_page);

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
		$data['bc_title']			= "Instrumen";
		$data['bc_link']			= site_url('instrumen');

		$data['title']				= "Instrumen";
		$data['video']				= $this->beranda_model->get_video();
		$data['instrumen_baru']		= $this->instrumen_model->get_instrumen_baru_limit($site['limit_post']);
		$data['kategori_terisi']	= $this->kategori_model->get_kategori_terisi();

		$this->template->load('website/template', 'website/instrumen/data_v', $data);
		
	}

}

/* End of file Instrumen.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Instrumen.php */

?>
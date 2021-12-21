<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->model('Site_model', 'site_model');
		$this->load->model('Result_model', 'result_model');
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Visitor_model', 'visitor_model');
		$this->visitor_model->hitung_visitor();
		$this->load->helper('text');
		$this->load->library('pagination');
	}

	function index()
	{
		redirect('instrumen');
	}

	function search()
	{
		$q_cari = $this->input->get('search_query', TRUE);
		$token_name = $this->input->get('csrf_token_gi_akreditasi_name', true);

		$build_query = http_build_query($_GET, '', "&");
		$replace_q = str_replace("csrf_token_gi_akreditasi_name=$token_name&", "", $build_query);
		$hasil_cari =  $this->result_model->hitung_jumlah_cari($q_cari);

		// pagination
		$site = $this->site_model->get_site_data()->row_array();
		$config = array();
		if ($q_cari) $config['suffix'] = '?' . $replace_q;
		$page = $this->uri->segment(2);
		if (!$page) {
			$mati = 0;
		}else{
			$mati = $page;
		}
		$limit = $site['limit_post'];
		$offset = $mati > 0 ? (($mati - 1) * $limit) : $mati;
		$config['base_url'] = site_url('search');
		$config['first_url'] = $config['base_url'].'?'.$replace_q;
		$config['total_rows'] = $hasil_cari->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;
		// $config['num_links'] = 4;

		// Styling
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

		$data['pencarian'] = $this->result_model->get_pencarian_perpage($limit, $offset, $q_cari);
		$data['pagination'] = $this->pagination->create_links();
		if (empty($this->uri->segment(2))) {
			$next_page = 2;
			$data['canonical'] = site_url('search');
			$data['url_prev'] = "";
		}elseif ($this->uri->segment(2)=='1') {
			$next_page = 2;
			$data['canonical'] = site_url('search/page/'.$this->uri->segment(3));
			$data['url_prev'] = site_url('search');
		}elseif ($this->uri->segment(2)=='2') {
			$next_page = $this->uri->segment(2)+1;
			$data['canonical'] = site_url('search/page/'.$this->uri->segment(2));
			$data['url_prev'] = site_url('search/page/ikilho');
		}else{
			$next_page = $this->uri->segment(2)+1;
			$prev_page = $this->uri->segment(2)-1;
			$data['canonical'] = site_url('search/page/'.$this->uri->segment(2));
			$data['url_prev'] = site_url('search/page/'.$prev_page);
		}
		$data['url_next'] = site_url('search/page/'.$next_page);


		if ($hasil_cari->num_rows() > 0) {
			$data['cari'] = $hasil_cari;
			$data['judul'] = $hasil_cari->num_rows().' Hasil Dari Kata : <i>'.$q_cari.'</i>';
			$data['isi'] = $q_cari;
		}else{
			$data['cari'] = $hasil_cari;
			$data['judul'] = $q_cari.' Tidak Ditemukan.!';
			$data['isi'] = $q_cari;
		}

		$data['font_awesome']	= "fa fa-search bg-orange";

		$data['video']				= $this->beranda_model->get_video();
		$data['kategori']			= $this->kategori_model->get_kategori();

		$data['url'] 				= $config['base_url'].'?'.$replace_q;
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_email'] 		= $site['site_email'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$this->template->load('website/template', 'website/search_blog_v', $data);
	}

}

/* End of file Result.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Result.php */

?>
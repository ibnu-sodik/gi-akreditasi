<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Video_model', 'video_model');
		$this->load->model('Beranda_model', 'beranda_model');
		$this->load->model('Kategori_model', 'kategori_model');
		$this->load->library('pagination');
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
		$data['title']				= "Instrumen";
		$data['bc_link']			= site_url('video');

		$query = $this->video_model->get_data_by_slug($slug);
		if ($query->num_rows() > 0) {
			$value = $query->row();
			$data['id_video']	= $value->id_video;
			$data['url'] 		= site_url('video/'.$value->slug_video);
			$data['canonical'] 	= site_url('video/'.$value->slug_video);
			$data['title'] 		= $value->nama_video;
			$data['konten']		= $value->deskripsi_video;
			$data['slug']		= $value->slug_video;
			$data['link']		= $value->link_video;
			$data['bc_aktif']	= $value->nama_video;
			if (!empty($value->deskripsi_video)) {
				$data['description'] = strip_tags(word_limiter($value->deskripsi_video), 15);
			}
			$data['post_date'] 		= $value->tgl_upload;

			$data['video_lain'] 	= $this->video_model->get_video_kecuali($value->id_video, $site['limit_post']);

			$this->template->load('website/template', 'website/video/detail_v', $data);;
		}else{
			redirect('video','refresh');
		}
	}

	public function index()
	{
		$site 						= $this->site_model->get_site_data()->row_array();

		$jumlah 					= $this->beranda_model->get_video();
		$halaman 					= $this->uri->segment(3);

		if (!$halaman) {
			$mati = 0;
		}else{
			$mati = $halaman;
		}
		$limit 						= $site['limit_post'];
		$offset 					= $mati > 0 ? (($mati - 1) * $limit) : $mati;
		$config['base_url'] 		= base_url().'video/halaman/';		
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
		$data['video']				= $this->video_model->get_data_perpage($offset, $limit);

		if (empty($this->uri->segment(3))) {
			$next_page = 2;
			$data['canonical'] 	= site_url('video');
			$data['url'] 		= site_url('video');
			$data['url_prev'] 	= "";
		}elseif ($this->uri->segment(3)=='1') {
			$next_page = 2;
			$data['canonical'] 	= site_url('video');
			$data['url'] 		= site_url('video');
			$data['url_prev'] 	= site_url('video');
		}elseif ($this->uri->segment(3)=='2') {
			$next_page 			= $this->uri->segment(3)+1;
			$data['canonical'] 	= site_url('video/halaman/'.$this->uri->segment(3));
			$data['url'] 		= site_url('video/halaman/'.$this->uri->segment(3));
			$data['url_prev'] 	= site_url('video');
		}else{
			$next_page 			= $this->uri->segment(3)+1;
			$prev_page 			= $this->uri->segment(3)-1;
			$data['canonical'] 	= site_url('video/halaman/'.$this->uri->segment(3));
			$data['url'] 		= site_url('video/halaman/'.$this->uri->segment(3));
			$data['url_prev'] 	= site_url('video/halaman/'.$prev_page);
		}
		$data['url_next'] 		= site_url('video/halaman/'.$next_page);

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
		$data['bc_title']			= "Video";
		$data['bc_link']			= site_url('video');
		$data['title']				= "Video";

		$this->template->load('website/template', 'website/video/data_v', $data);
	}

}

/* End of file Video.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/Video.php */

?>
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Instrumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Instrumen_model', 'instrumen_model');
		$this->load->model('admin/Kategori_model', 'kategori_model');
		$this->load->library('pagination');
	}

	public function hapus($id_instrumen)
	{
		if (!is_numeric($id_instrumen)) {
			$text = "Data tidak ditemukan.";
			$this->session->set_flashdata('swalError', $text);
			redirect('admin/instrumen','refresh');
		}else{
			$data = $this->instrumen_model->get_instrumen_by_id($id_instrumen)->row();
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id_login');
			$this->log_model->save_log($id_author, 4, 'Hapus instrumen dengan judul '.$data->nama_instrumen);
			$this->instrumen_model->hapus($id_instrumen);
			$text = "Data Instrumen dengan nama <strong>".$data->nama_instrumen."</strong> Berhasil Dihapus.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/instrumen');
		}
	}

	public function detail($id_instrumen)
	{
		sleep(1);
		$data = $this->instrumen_model->get_instrumen_by_id($id_instrumen)->row();
		$kategori = $this->kategori_model->get_kategori_by_id($data->kategori_instrumen)->row();
		$hasil = '
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="widget-box">
						<div class="widget-body">
							<div class="widget-main">
								<h3 class="header smaller blue">'.$data->nama_instrumen.'</h3>
								<div class="clearfix">
									<span class="label label-lg label-pink arrowed-right">
										<i class="fa fa-calendar"></i>
										<span>'.tanggal_indo($data->tanggal_up).'</span>
									</span>
								</div>
								<br>
								<div class="clearfix"></div>
								'.$data->konten_instrumen.'
								<hr>
								<span class="btn btn-info btn-sm">'.$kategori->nama_kategori.'</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		';

		$data = array(
			'detail_instrumen' => $hasil
		);
		echo json_encode($data);
	}

	public function update($id_instrumen)
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$this->tambah();
		} else {

			$judul 		= strip_tags(htmlspecialchars($this->input->post('judul', true), ENT_QUOTES));
			$konten 	= $this->input->post('konten');
			$kategori 	= $this->input->post('kategori', true);
			$preslug 	= strip_tags(htmlspecialchars($this->input->post('slug', true), ENT_QUOTES));
			$string   	= preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $preslug);
			$trim 		= trim($string);
			$praslug 	= strtolower(str_replace(" ", "-", $trim));
			$query 		= $this->db->get_where('tb_instrumen', array('slug_instrumen'=>$praslug, 'id_instrumen' => '!=$id_instrumen'));

			if ($query->num_rows() > 0) {
				$unique_string = rand();
				$slug = $praslug.'-'.$unique_string;
			}else{
				$slug = $praslug;
			}

			$deskripsi = htmlspecialchars($this->input->post('deskripsi', true));;

			$this->instrumen_model->update_instrumen($id_instrumen, $judul, $konten, $kategori, $slug, $deskripsi);

					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id_login');
			$this->log_model->save_log($id_author, 3, 'Update instrumen dengan judul '.$judul);

					// $this->send_email();

			$text = $judul.' Berhasil Diupdate.!';
			$data['swal'] = $this->session->set_flashdata('swalSukses', $text);
			redirect('admin/instrumen');

		}

	}

	public function edit($id_instrumen)
	{
		$user_edit					= $this->instrumen_model->get_instrumen_by_id($id_instrumen)->row_array();

		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/instrumen/edit/'.$id_instrumen);
		$data['canonical'] 			= site_url('admin/instrumen/edit/'.$id_instrumen);
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Instrumen";
		$data['bc_aktif'] 			= "Edit Instrumen";
		$data['title'] 				= "Edit Instrumen";

		$data['form_action']		= site_url('admin/instrumen/update');
		$data['kategori'] 			= $this->kategori_model->get_data();
		$data['data']				= $this->instrumen_model->get_instrumen_by_id($id_instrumen);

		$this->template->load('admin/template', 'admin/instrumen/edit_v', $data);
	}

	public function simpan()
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() === FALSE) {
			$this->tambah();
		} else {

			$judul 		= strip_tags(htmlspecialchars($this->input->post('judul', true), ENT_QUOTES));
			$konten 	= $this->input->post('konten');
			$kategori 	= $this->input->post('kategori', true);
			$preslug 	= strip_tags(htmlspecialchars($this->input->post('slug', true), ENT_QUOTES));
			$string   	= preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $preslug);
			$trim 		= trim($string);
			$praslug 	= strtolower(str_replace(" ", "-", $trim));
			$query 		= $this->db->get_where('tb_instrumen', array('slug_instrumen'=>$praslug));

			if ($query->num_rows() > 0) {
				$unique_string = rand();
				$slug = $praslug.'-'.$unique_string;
			}else{
				$slug = $praslug;
			}

			$deskripsi = htmlspecialchars($this->input->post('deskripsi', true));;

			$this->instrumen_model->simpan_instrumen($judul, $konten, $kategori, $slug, $deskripsi);

					// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id_login');
			$this->log_model->save_log($id_author, 2, 'Menambah instrumen dengan judul '.$judul);

					// $this->send_email();

			$text = $judul.' Berhasil Dipublish.!';
			$data['swal'] = $this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/instrumen');

		}

	}

	public function tambah()
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/instrumen');
		$data['canonical'] 			= site_url('admin/instrumen');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Instrumen";
		$data['bc_aktif'] 			= "Tambah Instrumen";
		$data['title'] 				= "Tambah Instrumen";

		$data['form_action']		= site_url('admin/instrumen/simpan');
		$data['kategori'] 			= $this->kategori_model->get_data();

		$this->template->load('admin/template', 'admin/instrumen/tambah_v', $data);
	}

	public function get_data()
	{
		sleep(1);
		$site 		= $this->site_model->get_site_data()->row_array();
		$kategori 	= $this->input->post('kategori');
		$jumlah 	= $this->instrumen_model->hitung_data($kategori);
		// $limit 		= $site['limit_post'];

		// $config = array();
		// $config['base_url']			= '#';
		// $config['total_rows']		= $jumlah;
		// $config['per_page']			= $site['limit_post'];
		// $config['uri_segment']		= 4;
		// $config['use_page_numbers'] = TRUE;

		// $config["full_tag_open"] 	= '<ul class="pagination">';
		// $config["full_tag_close"]	= '</ul>';
		// $config["first_tag_open"] 	= '<li>';
		// $config["first_tag_close"] 	= '</li>';
		// $config["last_tag_open"] 	= '<li>';
		// $config["last_tag_close"] 	= '</li>';
		// $config['next_link'] 		= '&gt;';
		// $config["next_tag_open"] 	= '<li>';
		// $config["next_tag_close"] 	= '</li>';
		// $config["prev_link"] 		= "&lt;";
		// $config["prev_tag_open"] 	= "<li>";
		// $config["prev_tag_close"] 	= "</li>";
		// $config["cur_tag_open"] 	= "<li class='active'><a href='#'>";
		// $config["cur_tag_close"] 	= "</a></li>";
		// $config["num_tag_open"] 	= "<li>";
		// $config["num_tag_close"] 	= "</li>";

		// $config['prev_link'] 		= 'Sebelumnya';
		// $config['next_link'] 		= 'Selanjutnya';
		// $config['last_link'] 		= 'Terakhir';
		// $config['first_link'] 		= 'Pertama';

		// $this->pagination->initialize($config);
		// $page 		= $this->uri->segment('4');
		// $offset 	= ($page - 1) * $config['per_page'];
		// echo $page;die();

		$hasil = array(
			'token' => $this->security->get_csrf_hash(),
			// 'pagination_link'	=> $this->pagination->create_links(),
			'daftar_instrumen' 	=> $this->instrumen_model->gabungkan_data($kategori)
		);

		echo json_encode($hasil);
	}

	public function index()
	{
		$site 						= $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/instrumen');
		$data['canonical'] 			= site_url('admin/instrumen');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_aktif'] 			= "Instrumen";
		$data['title'] 				= "Instrumen";

		$data['fil_kategori']		= $this->kategori_model->get_data();

		$this->template->load('admin/template', 'admin/instrumen/data_v', $data);
		
	}

}

/* End of file Instrumen.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Instrumen.php */

?>
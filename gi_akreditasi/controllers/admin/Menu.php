<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Menu_model', 'menu_model');
		$this->load->model('admin/Kategori_model', 'kategori_model');
		$this->load->model('admin/Halaman_model', 'halaman_model');
	}

	public function edit_second($id_menu)
	{		
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/menu/edit_second/'.$id_menu);
		$data['canonical'] 			= site_url('admin/menu/edit_second/'.$id_menu);
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Edit Footer Menu";
		$data['title'] 				= "Menu Footer";

		$data['data']				= $this->menu_model->get_menu_by_id($id_menu);
		$data['pil_induk']			= $this->menu_model->get_second_menu_kecuali_id($id_menu);
		$data['form_aksi']			= site_url('admin/menu/update');

		$user_id 					= $this->session->userdata('id');
		$data['pil_kategori'] 		= $this->kategori_model->get_data();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();

		$data['url_kategori']		= 'kategori/';
		$data['url_halaman']		= 'halaman/';

		$this->template->load('admin/template', 'admin/menu/edit_second_v', $data);
	}

	public function tambah_second()
	{
		
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/menu/second/tambah_second');
		$data['canonical'] 			= site_url('admin/menu/second/tambah_second');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Tambah Menu Footer";
		$data['title'] 				= "Menu";

		$data['second_menu']		= $this->menu_model->get_second_menu();
		$data['form_aksi']			= site_url('admin/menu/simpan');

		$user_id 					= $this->session->userdata('id');
		$data['pil_kategori'] 		= $this->kategori_model->get_data();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();

		$this->template->load('admin/template', 'admin/menu/tambah_second_v', $data);
	}

	public function second()
	{
		
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/menu/second');
		$data['canonical'] 			= site_url('admin/menu/second');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Menu Footer";
		$data['title'] 				= "Menu Footer";

		$data['second_menu']		= $this->menu_model->get_second_menu();

		$this->template->load('admin/template', 'admin/menu/data_second_v', $data);
	}

	public function delete($id_menu)
	{
		$query = $this->db->query("SELECT * FROM tb_menu WHERE parent_id = '$id_menu' ");
		$jumlah = $query->num_rows();
		$data = $this->menu_model->get_menu_by_id($id_menu)->row_array();
		if ($jumlah > 0) {
			$text = "Terdapat ".$jumlah." Submenu pada menu ".$data['judul_menu_menu'];
			$this->session->set_flashdata('swalError', $text);
			redirect('admin/menu');
		}else{
			if ($data['kategori_menu'] == 'main') {
				$url = 'admin/menu';
			}else{
				$url = 'admin/menu/second';
			}
			// kurang hapus
			$this->menu_model->hapus($id_menu);
			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id_login'), 4, 'Menghapus menu '.$data['judul_menu']);
			$text = $data['judul_menu']." berhasil dihapus.";
			$this->session->set_flashdata('swalSukses', $text);
			redirect($url);
		}
	}

	public function update($id_menu)
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('judul', 'Judul Menu', 'trim|required');
		$this->form_validation->set_rules('urut', 'Nomor Urut Menu', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->tambah();
		} else {
			$judul 			= $this->input->post('judul', true);
			$induk 			= $this->input->post('induk', true);
			$kategori_menu 	= $this->input->post('kategori_menu', true);
			$jenis_menu 	= $this->input->post('jenis_menu', true);
			$link_halaman 	= $this->input->post('link_halaman', true);
			$link_kategori 	= $this->input->post('link_kategori', true);
			$jenis_link 	= $this->input->post('jenis_link', true);
			$link_url2		= $this->input->post('link_url2', true);
			$urut 			= $this->input->post('urut', true);
			$target 		= $this->input->post('target', true);

			if ($jenis_menu=="halaman") {
				$data_link = 'halaman/'.$link_halaman;
			}elseif ($jenis_menu=="kategori") {
				$data_link = 'kategori/'.$link_kategori;
			}else{
				$data_link = $link_url2;
			}

			if ($kategori_menu == 'main') {
				$ket = "Header";
				$url = 'admin/menu';
			}else{
				$ket = "Footer";
				$url = 'admin/menu/second';
			}

			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id_login'), 3, 'Update menu '.$judul);

			$this->menu_model->update($id_menu, $judul, $induk, $kategori_menu, $jenis_menu, $jenis_link, $urut, $data_link, $target);
			$text = $judul.' berhasil diupdate';
			$this->session->set_flashdata('swalSukses', $text);
			redirect($url);

		}
	}

	public function edit($id_menu)
	{		
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/menu/edit/'.$id_menu);
		$data['canonical'] 			= site_url('admin/menu/edit/'.$id_menu);
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Edit Menu";
		$data['title'] 				= "Menu";

		$data['data']				= $this->menu_model->get_menu_by_id($id_menu);
		$data['pil_induk']			= $this->menu_model->get_main_menu_kecuali_id($id_menu);
		$data['form_aksi']			= site_url('admin/menu/update');

		$data['pil_kategori'] 		= $this->kategori_model->get_data();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();

		$data['url_kategori']		= 'kategori/';
		$data['url_halaman']		= 'halaman/';

		$this->template->load('admin/template', 'admin/menu/edit_v', $data);
	}

	public function simpan()
	{
		$this->load->helper(array('form', 'html'));

		$this->form_validation->set_rules('judul', 'Judul Menu', 'trim|required');
		$this->form_validation->set_rules('urut', 'Nomor Urut Menu', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() === FALSE) {
			$this->tambah();
		} else {
			$judul 			= $this->input->post('judul', true);
			$induk 			= $this->input->post('induk', true);
			$kategori_menu 	= $this->input->post('kategori_menu', true);
			$jenis_menu 	= $this->input->post('jenis_menu', true);
			$link_halaman 	= $this->input->post('link_halaman', true);
			$link_kategori 	= $this->input->post('link_kategori', true);
			$jenis_link 	= $this->input->post('jenis_link', true);
			$link_url2		= $this->input->post('link_url2', true);
			$urut 			= $this->input->post('urut', true);
			$target 		= $this->input->post('target', true);

			if ($jenis_menu=="halaman") {
				$data_link = 'halaman/'.$link_halaman;
			}elseif ($jenis_menu=="kategori") {
				$data_link = 'kategori/'.$link_kategori;
			}else{
				$data_link = $link_url2;
			}

			if ($kategori_menu == 'main') {
				$ket = "Header";
				$url = 'admin/menu';
			}else{
				$ket = "Footer";
				$url = 'admin/menu/second';
			}

			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$this->log_model->save_log($this->session->userdata('id_login'), 2, 'Menambah menu '.$judul. ' kategori '.$ket);

			$this->menu_model->simpan($judul, $induk, $kategori_menu, $jenis_menu, $jenis_link, $urut, $data_link, $target);
			$text = 'Berhasil Menambah '.$judul.' Ke '.$ket.' Menu';
			$this->session->set_flashdata('swalSukses', $text);
			redirect($url);

		}
	}

	public function tambah()
	{		
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/menu/tambah');
		$data['canonical'] 			= site_url('admin/menu/tambah');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Menu";
		$data['bc_aktif'] 			= "Tambah Menu";
		$data['title'] 				= "Menu";

		$data['main_menu']			= $this->menu_model->get_main_menu();
		$data['form_aksi']			= site_url('admin/menu/simpan');

		$data['pil_kategori'] 		= $this->kategori_model->get_data();
		$data['pil_halaman']		= $this->halaman_model->get_all_halaman();

		$this->template->load('admin/template', 'admin/menu/tambah_v', $data);
	}

	public function index()
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/menu');
		$data['canonical'] 			= site_url('admin/menu');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Pengaturan";
		$data['bc_aktif'] 			= "Menu";
		$data['title'] 				= "Menu";

		$data['main_menu']			= $this->menu_model->get_main_menu();
		// $data['data_menu']		= $this->menu_model->get_all_data();

		$this->template->load('admin/template', 'admin/menu/data_v', $data);
		
	}

}

/* End of file Menu.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Menu.php */

 ?>
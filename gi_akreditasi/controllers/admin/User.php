<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/User_model', 'user_model');
		if ($this->session->userdata('access') != 1) {
			$text = "Terjadi kesalahan saat mengakses halaman.";
			$this->session->set_flashdata('swalInfo', $text);
			redirect('admin');
		}
	}

	public function hapus($id)
	{
		error_reporting(0);
		$data_p = $this->user_model->get_data_by_id($id);
		if ($data_p->num_rows() > 0) {
			$data = $data_p->row();
			$foto_p = "uploads/user/".$data->foto;
			chmod('uploads/user/', 0777);
			unlink($foto_p);
		}

		$pilihan = array(
			'tb_user' 				=> 'id',
			// 'tb_instrumen' 			=> 'id_author',
			// 'tb_label_instrumen' 	=> 'user_id_label',
			// 'tb_kategori_instrumen' => 'user_id_kategori',
			'tb_log' 				=> 'log_userid',
			// 'tb_sosmed_user' 		=> 'id_user_sosmed',
		);
		foreach ($pilihan as $table => $kolom) {
			$this->user_model->hapus_multi($id, $table, $kolom);
		}

		// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
		$id_author = $this->session->userdata('id_login');					
		$this->log_model->save_log($id_author, 4, 'Hapus seluruh data '.$data_p->full_name);

		$text = "Data Instrumen, Kategori dan Profil <strong>$full_name</strong> berhasil dihapus.";
		$this->session->set_flashdata('pnotifySukses', $text);
		redirect('admin/user');
	}

	public function update($id)
	{
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('full_name', 'Nama Lengkap','required|strip_tags|min_length[3]');
		$this->form_validation->set_rules('jenis_fungsi', 'Fungsi/ Jabatan','required|strip_tags|trim');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run() === FALSE) {
			$this->edit($id);
		}else{
			$errors = array();
			$username 		= $this->input->post('username', TRUE);
			$email 			= $this->input->post('email', TRUE);
			$full_name 		= $this->input->post('full_name', TRUE);
			$jenis_fungsi 	= $this->input->post('jenis_fungsi', TRUE);
			$level 	= $this->input->post('level', TRUE);

			if (empty($username)) {
				$errors[] = "Username harus diisi.";
			}
			$cek_us = $this->db->query("SELECT * FROM tb_user WHERE username = '$username' AND id != '$id'");
			if ($cek_us->num_rows() > 0) {
				$errors[] = "Username $username sudah digunakan.";
			}
			if (empty($email)) {
				$errors[] = "Email harus diisi.";
			}
			$cek_us = $this->db->query("SELECT * FROM tb_user WHERE email = '$email' AND id != '$id'");
			if ($cek_us->num_rows() > 0) {
				$errors[] = "Email $email sudah digunakan.";
			}

			if (!empty($errors)) {
				foreach ($errors as $error) {
					$this->session->set_flashdata('pesan_error', $error);
					redirect('admin/user/edit/'.$id, 'refresh');
				}
			}else{
				$this->user_model->update($id, $full_name, $username, $email, $jenis_fungsi, $level);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');					
				$this->log_model->save_log($id_author, 3, 'Update data user '.$full_name);
				$text = "Data <strong>$full_name</strong> berhasil disimpan.";
				$this->session->set_flashdata('pnotifySukses', $text);
				redirect('admin/user', 'refresh');
			}

		}
	}

	public function edit($id)
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/user/edit');
		$data['canonical'] 			= site_url('admin/user/edit');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "User";
		$data['bc_aktif'] 			= "Edit User";
		$data['title'] 				= "User";
		$data['data'] 				= $this->user_model->get_data_by_id($id);
		$data['form_action'] 		= site_url('admin/user/update');

		$this->template->load('admin/template', 'admin/user/edit_v', $data);
	}

	public function lock($id)
	{
		$data = $this->user_model->get_data_by_id($id);
		if ($data->num_rows() < 0) {
			$text = "Akun tidak ditemukan.";
			$this->session->set_flashdata('swalWarning', $text);
			redirect('admin/user');
		}else{
			$row = $data->row();
			$this->user_model->lock($id);

			$text = "Akun <strong>".$row->full_name."</strong> berhasil diNonAktifkan.";
			$this->session->set_flashdata('pnotifyInfo', $text);
			redirect('admin/user');
		}
	}

	public function unlock($id)
	{
		$data = $this->user_model->get_data_by_id($id);
		if ($data->num_rows() < 0) {
			$text = "Akun tidak ditemukan.";
			$this->session->set_flashdata('swalWarning', $text);
			redirect('admin/user');
		}else{
			$row = $data->row();
			$this->user_model->unlock($id);

			$text = "Akun <strong>".$row->full_name."</strong> berhasil diaktifkan.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/user');
		}
	}

	public function save()
	{
		$this->form_validation->set_rules('full_name', 'Nama Lengkap','required|strip_tags|min_length[3]');
		$this->form_validation->set_rules('email', 'Email','required|strip_tags|valid_email|min_length[3]|is_unique[tb_user.email]');
		$this->form_validation->set_rules('username', 'Username','required|strip_tags|is_unique[tb_user.username]|min_length[3]');
		$this->form_validation->set_rules('password', 'Password','required|strip_tags|min_length[6]');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		$this->form_validation->set_message('username', 'Username %s sudah digunakan.');
		$this->form_validation->set_message('email', 'Email %s sudah terdaftar.');

		if ($this->form_validation->run() === FALSE) {
			$this->index();
		} else {
			
			$username = $this->input->post('username', true);
			$password_in 	= $this->input->post('password', true);
			$opsi = ['cost'=>12];
			$password = password_hash($password_in, PASSWORD_BCRYPT, $opsi);
			$full_name 	= $this->input->post('full_name', true);
			$email 		= $this->input->post('email', true);

			$password_text = $this->input->post('password', true);

			$kode_aktivasi = $this->get_code();
			$this->send_email_notif($email, $kode_aktivasi, $full_name, $username, $password_text);

			$simpan = $this->user_model->tambah_data($username, $password, $full_name, $email);

			// $this->user_model->save_aktivasi($email, $kode_aktivasi);

			$text = "<strong>".$full_name."</strong> berhasil disimpan pada data User. Silahkan cek email untuk mengaktifkan akun.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/user');
		}
	}

	public function index()
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/user');
		$data['canonical'] 			= site_url('admin/user');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_aktif'] 			= "User";
		$data['title'] 				= "User";

		$data['data_user']		= $this->user_model->get_all_data();

		$this->template->load('admin/template', 'admin/user/data_v', $data);
	}

	public function simpan_user()
	{
		$this->form_validation->set_rules('full_name', 'Nama', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('conf_password', 'Konfimasi Password', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$text = 'Periksa kembali data yang anda masukkan.!';
			$this->session->set_flashdata('swalError', $text);
			$this->konfigurasi_user();
		} else {
			$full_name 		= $this->input->post('full_name', TRUE);
			$username 		= $this->input->post('username', TRUE);
			$email 			= $this->input->post('email', TRUE);
			$password 		= $this->input->post('password', TRUE);

			$opsi = ['cost'=>12];
			$hash = password_hash($password, PASSWORD_BCRYPT, $opsi);

			$this->user_model->_simpan($full_name, $username, $email, $hash);

			$url = base_url('admin');
			$text = 'User baru berhasil disimpan.!';
			$this->session->set_flashdata('swalSukses', $text);
			redirect($url);
		}
	}

	public function konfigurasi_user()
	{
		$data['form_action'] 	= site_url('admin/user/simpan_user');
		$data['csrf_token'] 	= $this->security->get_csrf_hash();

		$this->load->view('admin/konfigurasi_user_v', $data);
	}

	public function send_email_notif($email, $kode_aktivasi, $full_name, $username, $password_text)
	{
		$this->load->config('email');
		$this->load->library('email');
		$site = $this->site_model->get_site_data()->row_array();

		$subjek 				= "User Baru Pada ".$site['site_name'];
		$data['subjek'] 		= $subjek;
		$data['url_aktivasi']	= site_url('admin/aktivasi/'.$kode_aktivasi);
		$data['site_name']		= $site['site_name'];
		$data['tahun_buat'] 	= $site['tahun_buat'];
		$data['kode_aktivasi']	= $kode_aktivasi;
		$data['full_name']		= $full_name;
		$data['username']		= $username;
		$data['password']		= $password_text;
		$this->email->from($this->config->item('smtp_user'), 'admin@'.$site['site_name']);
		$this->email->to($email);

		$this->email->subject($subjek);
		$this->email->message($this->load->view('email/aktivasi_user_v', $data, TRUE));
		// $this->email->message("Email isi disini");

		if ($this->email->send()) {
			// simpan data pada db
			$this->user_model->save_aktivasi($email, $kode_aktivasi);
			// echo $this->email->print_debugger();
			$text = "Kode aktivasi akun telaha dikirim ke ".$email;
			$this->session->set_flashdata('pnotifySukses', $text);
			$url = site_url('admin/user');
			redirect($url);
		}else{
			// echo $this->email->print_debugger();
			// die();
			$text = "Gagal mengirim email";
			$this->session->set_flashdata('pnotifyError', $text);
			$url = site_url('admin/user');
			redirect($url);
		}
	}

	public function get_code()
	{
		$this->load->helper('string');
		$string = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		return substr(str_shuffle($string), 0, 43);
		// return random_string('alnum', 42);
	}

}

/* End of file User.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/User.php */

?>
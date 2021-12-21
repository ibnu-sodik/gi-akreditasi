<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Login_model', 'login_model');
		$this->load->model('admin/User_model', 'user_model');

		if ($this->session->userdata('login_goblog') == TRUE) {
			$url = base_url('admin/dashboard');
			redirect($url);
		}
	}

	public function auth()
	{
		$this->load->helper(array('form', 'html'));
		$this->form_validation->set_rules('username', 'Username/ Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$text 	= "Periksa kembali data yang anda masukkan.";
			$this->session->set_flashdata('swalError', $text);
			$this->index();
		} else {
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);
			$validasi = $this->login_model->validasi($username);

			// cek apakah username ada pada database
			if ($validasi->num_rows() > 0) {
				$user_data = $validasi->row_array();
				$pass_hash = password_verify($password, $user_data['password']);

				// validasi password
				if ($pass_hash == TRUE) {
					$this->session->set_userdata('login_goblog', TRUE);
					$this->session->set_userdata('id_login', $user_data['id']);

					$id = $user_data['id'];

					if ($user_data['level'] == 1) {
						$this->session->set_userdata('access', '1');
						$this->log_model->save_log($id, 0, 'Login Website');

						$text = $user_data['full_name']." berhasil Login.";
						$this->session->set_flashdata('swalSukses', $text);
						redirect('admin/dashboard');
					}elseif ($user_data['level'] == 2) {
						$this->session->set_userdata('access', '2');
						$this->log_model->save_log($id, 0, 'Login Website');
						
						$text = $user_data['full_name']." berhasil Login.";
						$this->session->set_flashdata('swalSukses', $text);
						redirect('admin/dashboard');
					}else{
						$text = "Anda tidak memiliki izin untuk login.";
						$this->session->set_flashdata('swalError', $text);
						$this->index();
					}					
				}else{
					$text = "Password yang anda masukkan salah.";
					$this->session->set_flashdata('swalInfo', $text);
					$this->index();
				}
			}else{
				$text = "Username tidak ditemukan.";
				$this->session->set_flashdata('swalError', $text);
				$this->index();
			}
		}
	}

	public function index()
	{
		$data_web = $this->site_model->get_site_data()->num_rows();
		$data_user = $this->user_model->get_user_data()->num_rows();
		if ($data_web == 0) {
			$text = "Mohon atur website terlebih dahulu.!";
			$this->session->set_flashdata('swalInfo', $text);
			$url = base_url('admin/konfigurasi-website');
			redirect($url);
		}elseif ($data_user == 0) {			
			$text = "Mohon buat user terlebih dahulu.!";
			$this->session->set_flashdata('swalInfo', $text);
			$url = base_url('admin/konfigurasi-user');
			redirect($url);
		}else {
			$site 						= $this->site_model->get_site_data()->row_array();
			$data['csrf_token'] 		= $this->security->get_csrf_hash();
			$data['url'] 				= site_url('admin/login');
			$data['canonical'] 			= site_url('admin/login');
			$data['site_title'] 		= $site['site_title'];
			$data['site_name'] 			= $site['site_name'];
			$data['site_keywords'] 		= $site['site_keywords'];
			$data['site_author'] 		= $site['site_author'];
			$data['site_logo'] 			= $site['site_logo'];
			$data['site_description'] 	= $site['site_description'];
			$data['site_favicon'] 		= $site['site_favicon'];
			$data['tahun_buat'] 		= $site['tahun_buat'];

			$data['title']				= "Login";
			$data['judul']				= "Login";

			$data['form_act_login'] 	= site_url('admin/login/auth');
			$data['form_act_forget'] 	= site_url('admin/send-reset-code');
			// $data['swalInfo'] 			= $this->session->flashdata('swalInfo');

			$this->load->view('admin/login_v', $data);
			
		}
	}

}

/* End of file Login.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Login.php */

?>
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/User_model', 'user_model');
	}

	public function index($kode_aktivasi)
	{
		$query = $this->user_model->get_data_aktivasi($kode_aktivasi);
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$this->user_model->aktivasi($data->email);
			$this->user_model->hapus_kode_aktivasi($kode_aktivasi);

			$text = "Aktivasi akun sukses. Silahkan login.";
			$this->session->set_flashdata('swalSukses', $text);
			$url = site_url('admin');
			redirect($url,'refresh');
		}else{
			$text = "Kode aktivasi tidak ditemukan.";
			$this->session->set_flashdata('swalSukses', $text);
			$url = site_url('admin');
			redirect($url,'refresh');
		}
	}

}

/* End of file Aktivasi.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Aktivasi.php */

 ?>
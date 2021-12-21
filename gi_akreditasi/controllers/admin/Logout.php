<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		$id_user = $this->session->userdata('id_login');
		$pesan = 'Berhasil Logout.!';
		$this->session->set_flashdata('swalSukses', $pesan);
		$this->session->sess_destroy();
		$url = base_url('admin');
		redirect($url);
	}

}

/* End of file Logout.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Logout.php */

?>
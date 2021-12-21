<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model {

	public function simpan($nama, $email, $subjek, $pesan)
	{
		$object = array(
			'nama_pengirim' 	=> $nama,
			'email_pengirim' 	=> $email,
			'subjek_pesan' 		=> $subjek,
			'isi_pesan' 		=> $pesan,
		);
		$this->db->insert('tb_pesan', $object);
	}	

}

/* End of file Pesan_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Pesan_model.php */

?>
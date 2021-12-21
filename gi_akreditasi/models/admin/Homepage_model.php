<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage_model extends CI_Model {	

	public function ubah_status($id_hp, $nama, $status)
	{
		$object = array($nama => $status);
		$this->db->where('id_hp', $id_hp);
		$this->db->update('tb_homepage', $object);
	}

	public function simpan($hp_sambutan, $hp_konten, $hp_video, $hp_slide)
	{
		$object = array(
			'hp_sambutan' 	=> $hp_sambutan,
			'hp_konten' 	=> $hp_konten,
			'hp_video' 		=> $hp_video,
			'hp_slide' 		=> $hp_slide,
		);
		$this->db->insert('tb_homepage', $object);
	}

	public function get_data_by_id($id_hp)
	{
		$this->db->select('*');
		$this->db->from('tb_homepage');
		$this->db->where('id_hp', $id_hp);
		$query = $this->db->get();
		return $query;
	}

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from('tb_homepage');
		$query = $this->db->get();
		return $query;
	}

}

/* End of file Homepage_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Homepage_model.php */

?>
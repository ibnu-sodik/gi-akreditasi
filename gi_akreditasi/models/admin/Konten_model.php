<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Konten_model extends CI_Model {

	public function update_konten($id_konten, $isi_konten)
	{		
		$object = array(
			'isi_konten' => $isi_konten, 
		);
		$this->db->where('id_konten', $id_konten);
		$this->db->update('tb_konten', $object);
	}

	public function get_konten_data_by_id($id_konten)
	{
		$this->db->select('*');
		$this->db->from('tb_konten');
		$this->db->where('id_konten', $id_konten);
		$result = $this->db->get();
		return $result;
	}

	public function simpan_konten($isi_konten)
	{
		$object = array(
			'isi_konten' => $isi_konten, 
		);
		$this->db->insert('tb_konten', $object);
	}

	public function get_konten_data()
	{
		$this->db->select('*');
		$this->db->from('tb_konten');
		$this->db->limit(1);
		$result = $this->db->get();
		return $result;
	}	

}

/* End of file Konten_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Konten_model.php */

?>
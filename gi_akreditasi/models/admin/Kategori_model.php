<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function _update_kategori($id, $kategori, $slug, $parent_id)
	{
		$object = array(
			'nama_kategori' => $kategori,
			'slug_kategori' => $slug,
			'parent_id' => $parent_id
		);
		$this->db->where('id_kategori', $id);
		$this->db->update('tb_kategori', $object);
	}

	public function _simpan_kategori($kategori, $slug, $parent_id)
	{
		$object = array(
			'nama_kategori' => $kategori,
			'slug_kategori' => $slug,
			'parent_id' => $parent_id
		);
		$this->db->insert('tb_kategori', $object);
	}
	
	function hapus_kategori($id_kategori)
	{
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('tb_kategori');
	}

	public function get_kategori_by_id($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('id_kategori', $id_kategori);
		$query = $this->db->get();
		return $query;
	}

	public function get_data($id_kategori=NULL)
	{
		if (empty($id_kategori)) {
			$this->db->select('*');
			$this->db->from('tb_kategori');
			$this->db->order_by('id_kategori', 'desc');
			$query = $this->db->get();
		}else{
			$this->db->select('*');
			$this->db->from('tb_kategori');
			$this->db->order_by('id_kategori', 'desc');
			$this->db->where('id_kategori', $id_kategori);
			$query = $this->db->get();
		}
		return $query;
	}	

}

/* End of file Kategori_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Kategori_model.php */

?>
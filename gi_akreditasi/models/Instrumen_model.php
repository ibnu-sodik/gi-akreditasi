<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Instrumen_model extends CI_Model {

	public function get_data_selanjutnya($id_instrumen)
	{
		$query = $this->db->query("SELECT * FROM tb_instrumen WHERE id_instrumen > '$id_instrumen' ORDER BY id_instrumen ASC limit 1 ");
		return $query;
	}

	public function get_data_sebelumnya($id_instrumen)
	{
		$query = $this->db->query("SELECT * FROM tb_instrumen WHERE id_instrumen < '$id_instrumen' ORDER BY id_instrumen DESC limit 1 ");
		return $query;
	}

	public function get_instrumen_by_kategori($kategori_instrumen, $id_instrumen)
	{
		$query = $this->db->query("
			SELECT tb_instrumen.*, tb_kategori.* FROM tb_instrumen
			LEFT JOIN tb_kategori ON kategori_instrumen = id_kategori
			WHERE id_instrumen NOT IN('$id_instrumen') AND kategori_instrumen IN('$kategori_instrumen')
			ORDER BY id_instrumen, nama_instrumen ASC
			");
		return $query;
	}	

	public function get_instrumen_baru_limit($limit)
	{
		$this->db->select('*');
		$this->db->from('tb_instrumen');
		$this->db->order_by('id_instrumen', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query;
	}

	public function get_data_perpage($offset, $limit)
	{		
		$this->db->select('tb_instrumen.*, tb_kategori.*');
		$this->db->from('tb_instrumen');
		$this->db->join('tb_kategori', 'kategori_instrumen = id_kategori', 'left');
		$this->db->group_by('id_instrumen');
		$this->db->order_by('id_instrumen', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	public function get_data_by_slug($slug)
	{
		$this->db->select('tb_instrumen.*, tb_kategori.*');
		$this->db->from('tb_instrumen');
		$this->db->join('tb_kategori', 'kategori_instrumen = id_kategori', 'left');
		$this->db->where('slug_instrumen', $slug);
		$query = $this->db->get();
		return $query;
	}

	public function get_instrumen()
	{
		$query = $this->db->get('tb_instrumen');
		return $query;
	}

}

/* End of file Instrumen_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/Instrumen_model.php */

?>
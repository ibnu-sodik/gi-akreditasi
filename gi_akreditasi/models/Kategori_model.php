<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function get_kategori_kecuali($kategori_instrumen)
	{
		$query = $this->db->query("
			SELECT tb_instrumen.*, tb_kategori.* FROM tb_kategori
			LEFT JOIN tb_instrumen ON kategori_instrumen = id_kategori
			WHERE id_kategori != '$kategori_instrumen'
			ORDER BY id_kategori, nama_kategori ASC;
			");
		return $query;
	}

	public function get_kategori()
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->order_by('nama_kategori', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function get_kategori_by_id($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('id_kategori', $id_kategori);
		$query = $this->db->get();
		return $query;
	}

	public function get_kategori_by_slug($slug_kategori)
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('slug_kategori', $slug_kategori);
		$query = $this->db->get();
		return $query;
	}

	public function get_instrumen_by_kategori($slug)
	{
		$this->db->select('tb_instrumen.*, tb_kategori.*');
		$this->db->from('tb_instrumen');
		$this->db->join('tb_kategori', 'kategori_instrumen = id_kategori', 'left');
		$this->db->where('slug_kategori', $slug);
		$query = $this->db->get();
		return $query;
	}

	public function get_kategori_instrumen_perpage($offset, $limit, $id_kategori)
	{
		$this->db->select('tb_instrumen.*, tb_kategori.*');
		$this->db->from('tb_instrumen');
		$this->db->join('tb_kategori', 'kategori_instrumen = id_kategori', 'left');
		$this->db->where(array('id_kategori' => $id_kategori));
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}
	

}

/* End of file Kategori_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/Kategori_model.php */

?>
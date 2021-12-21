<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Video_model extends CI_Model {

	public function get_video_kecuali($id_video, $limit)
	{
		$query = $this->db->query("SELECT * FROM tb_video WHERE id_video NOT IN($id_video) ORDER BY id_video DESC LIMIT $limit");
		return $query;
	}

	public function get_data_by_slug($slug)
	{
		$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->where('slug_video', $slug);
		$query = $this->db->get();
		return $query;
	}

	public function get_data_perpage($offset, $limit)
	{		
		$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->order_by('id_video', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	

}

/* End of file Video_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/Video_model.php */

 ?>
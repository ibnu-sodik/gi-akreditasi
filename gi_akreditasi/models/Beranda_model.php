<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {

	public function get_populer_video()
	{
		$query = $this->db->query("SELECT * FROM tb_video ORDER BY views_video DESC LIMIT 1");
		return $query;
	}

	public function get_new_video()
	{
		$query = $this->db->query("SELECT * FROM tb_video ORDER BY id_video DESC");
		return $query;
	}

	public function get_video()
	{
		$query = $this->db->query("SELECT * FROM tb_video ORDER BY id_video DESC");
		return $query;
	}

	public function get_konten()
	{
		$query = $this->db->query("SELECT * FROM tb_konten");
		return $query;
	}

	public function get_sambutan()
	{
		$query = $this->db->query("SELECT * FROM tb_sambutan");
		return $query;
	}

	public function get_slide()
	{
		$query = $this->db->query("SELECT * FROM tb_slide ORDER BY status_aktif DESC ");
		return $query;
	}

	

}

/* End of file Beranda_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/Beranda_model.php */

 ?>
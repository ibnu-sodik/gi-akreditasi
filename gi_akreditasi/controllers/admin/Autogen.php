<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Autogen extends CI_Controller {

	public function index()
	{
		$query = $this->db->query("SELECT * FROM tb_kategori");
		foreach ($query->result() as $row) {
			echo $row->nama_kategori."<br>";
			$kategori = strip_tags(htmlspecialchars($row->nama_kategori,ENT_QUOTES));
			$string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $kategori);
			$trim     = trim($string);
			$slug     = strtolower(str_replace(" ", "-", $trim));
			echo $slug."<br>";
			echo "<hr>";
			$object = array('slug_kategori' => $slug);
			$this->db->where('id_kategori', $row->id_kategori);
			$this->db->update('tb_kategori', $object);
		}
	}

}

/* End of file Autogen.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Autogen.php */

?>
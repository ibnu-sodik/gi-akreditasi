<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Result_model extends CI_Model {	
	
	function hitung_jumlah_cari($query)
	{
		$query = $this->db->query("SELECT tb_instrumen.*, tb_kategori.* FROM tb_instrumen
			LEFT JOIN tb_kategori ON tb_instrumen.kategori_instrumen = tb_kategori.id_kategori
			WHERE nama_instrumen LIKE '%$query%' OR nama_kategori LIKE '%$query%'");
		return $query;
	}

	function get_pencarian_perpage($limit, $offset, $query)
	{
		$query = $this->db->query("SELECT tb_instrumen.*, tb_kategori.* FROM tb_instrumen
			LEFT JOIN tb_kategori ON tb_instrumen.kategori_instrumen = tb_kategori.id_kategori
			WHERE nama_instrumen LIKE '%$query%' OR nama_kategori LIKE '%$query%' LIMIT $limit OFFSET $offset ");
		return $query;
	}

}

/* End of file Result_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/Result_model.php */

?>
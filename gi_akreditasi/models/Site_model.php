<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model {

	public function cek_kesediaan_email($email)
	{
		$query = $this->db->query("SELECT * FROM tb_user WHERE email = '$email'");
		return $query;
	}

	public function simpan_web_pertama($site_name, $site_title, $site_keywords, $site_description)
	{
		$object = array(
			'site_name' => $site_name, 
			'site_title' => $site_title, 
			'site_keywords' => $site_keywords, 
			'site_description' => $site_description,
			'tahun_buat'		=> date('Y')
		);
		$this->db->insert('site_settings', $object);
	}

	public function get_site_data()
	{
		$query = $this->db->get('site_settings');
		return $query;
	}

}

/* End of file Site_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/Site_model.php */

 ?>
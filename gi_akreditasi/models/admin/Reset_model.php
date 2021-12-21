<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_model extends CI_Model {

	public function get_data_personil_by_email($email)
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query;
	}

	public function update_password($password, $email)
	{
		$object = array(
			'password' => $password, 
		);
		$this->db->where('email', $email);
		$this->db->update('tb_user', $object);
	}

	public function _delete_token($token)
	{
		$this->db->where('reset_code', $token);
		$this->db->delete('tb_reset');
	}

	public function get_reset_code($code)
	{
		$query = $this->db->query("SELECT * FROM tb_reset WHERE reset_code = '$code'");
		return $query;
	}

	public function save_reset($email, $code)
	{
		$object = array(
			'reset_email' => $email, 
			'reset_code' => $code, 
		);
		$this->db->insert('tb_reset', $object);
	}	

}

/* End of file Reset_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Reset_model.php */

 ?>
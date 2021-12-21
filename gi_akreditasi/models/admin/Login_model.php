<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {	

	public function validasi($username)
	{
		$result = $this->db->query("SELECT * FROM tb_user WHERE (email = '$username' OR username='$username')");
		return $result;
	}

}

/* End of file Login_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Login_model.php */

?>
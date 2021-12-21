<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	}	

	function upload_image()
	{
		if (isset($_FILES['file']['name'])) {
			$config['upload_path'] = './uploads/images/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file')) {
				$this->upload->display_errors();
				return FALSE;
			}else{
				$data = $this->upload->data();
		            //Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./uploads/images/'.$data['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= TRUE;
				$config['quality']= '60%';
				$config['width']= 800;
				$config['height']= 800;
				$config['new_image']= './uploads/images/'.$data['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				echo base_url().'uploads/images/'.$data['file_name'];
			}
		}
	}

}

/* End of file Upload.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Upload.php */

?>
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Slide extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Slide_model', 'slide_model');
		$this->load->library('upload');
		$this->load->helper('text');
		if ($this->session->userdata('access')!=1) {
			$text = 'Terdapat batasan hak akses pada halaman ini.';
			$this->session->set_flashdata('swalError', $text);
			redirect('admin', 'refresh');
		}
	}

	public function hapus($id_slide)
	{
		$data_slide = $this->slide_model->get_slide_by_id($id_slide)->row_array();

		if ($data_slide['status_aktif'] == 1) {
			$text = "Slide yang tampil awal tidak bisa dihapus.";
			$this->session->set_flashdata('swalError', $text);
			redirect('admin/slide');
		}else{
			$data 				= $this->slide_model->get_slide_by_id($id_slide)->row();		
			$images 			= "./uploads/images/".$data->gambar_slide;
			$img_agenda 		= "./uploads/slide/".$data->gambar_slide;
			unlink($images);
			unlink($img_agenda);

			// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id_login');
			$judul_slide = $data_slide['judul_slide'];
			$this->log_model->save_log($id_author, 4, 'Menghapus Slide dengan judul '.$judul_slide);
			$this->slide_model->hapus($id_slide);

			$text = "Slide berhasil dihapus.";
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/slide');
		}
	}

	public function active($id_slide)
	{
		$this->slide_model->inactive_all_slide();
		$this->slide_model->active_slide($id_slide);
		$text = 'Slide Berhasil Diaktifkan.!';
		$this->session->set_flashdata('pnotifySukses', $text);
		redirect('admin/slide');
	}

	public function update()
	{
		error_reporting(0);
		$id_slide = $this->input->post('id_slide', TRUE);

		$config['upload_path'] = './uploads/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if (!empty($_FILES['filefoto']['name'])) {
			$data 		= $this->slide_model->get_slide_by_id($id_slide)->row();
			$images 	= "./uploads/images/".$data->gambar_slide;
			$img_slide = "./uploads/slide/".$data->gambar_slide;
			unlink($images);
			unlink($img_slide);

			if ($this->upload->do_upload('filefoto')) {
				$img = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/images/'.$img['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '100%';
				$config['width'] = 1500;
				$config['height'] = 844;
				$config['new_image'] = './uploads/images/'.$img['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$image 				= $img['file_name'];
				$judul_slide 		= strip_tags(htmlspecialchars($this->input->post('judul_slide2', true), ENT_QUOTES));
				$konten_slide 		= $this->input->post('konten_slide2');

				$this->slide_model->update_slide_image($id_slide, $image, $judul_slide, $konten_slide);
				$this->compress_tinify($image);
				$foto_lama = "./uploads/images/".$image;
				unlink($foto_lama);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 3, 'Update Slide dengan judul '.$judul_slide);

				$text = $judul_slide.' Berhasil Diupdate.!';
				$this->session->set_flashdata('pnotifySukses', $text);
				redirect('admin/slide');

			} else {
				redirect('admin/slide','refresh');
			}

		} else {
			$id_slide 			= $this->input->post('id_slide', TRUE);
			$judul_slide 		= strip_tags(htmlspecialchars($this->input->post('judul_slide2', true), ENT_QUOTES));
			$konten_slide 		= $this->input->post('konten_slide2');

			$this->slide_model->update_slide($id_slide, $judul_slide, $konten_slide);
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
			$id_author = $this->session->userdata('id_login');
			$this->log_model->save_log($id_author, 3, 'Update Slide dengan judul '.$judul_slide);

			$text = $judul_slide.' Berhasil Diupdate.!';
			$this->session->set_flashdata('pnotifySukses', $text);
			redirect('admin/slide');
		}
	}

	public function simpan()
	{
		$config['upload_path'] = './uploads/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$img = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/images/'.$img['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['quality'] = '100%';
				$config['width'] = 1500;
				$config['height'] = 844;
				$config['new_image'] = './uploads/images/'.$img['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$this->compress_tinify($img['file_name']);

				$image 				= $img['file_name'];
				$judul_slide 		= strip_tags(htmlspecialchars($this->input->post('judul_slide', true), ENT_QUOTES));
				$konten_slide 		= $this->input->post('konten_slide');

				$this->slide_model->simpan($image, $judul_slide, $konten_slide);

				$foto_lama = "./uploads/images/".$image;
				unlink($foto_lama);
				
				// 0=login, 1=logout, 2=create, 3=update, 4=delete, 5=resetPass, 6=reply
				$id_author = $this->session->userdata('id_login');
				$this->log_model->save_log($id_author, 2, 'Menambah Slide dengan judul '.$judul_slide);

				$text = $judul_slide.' Berhasil Dipublish.!';
				$this->session->set_flashdata('pnotifySukses', $text);
				redirect('admin/slide');

			} else {
				redirect('admin/slide','refresh');
			}

		} else {
			redirect('admin/slide','refresh');
		}
	}

	public function compress_tinify($gambar_asli)
	{
		$site = $this->site_model->get_site_data()->row_array();
		$this->load->library('tiny_png', array('api_key' => $site['api_tinify']));

		$sumber = './uploads/images/'.$gambar_asli;
		$menuju = './uploads/slide/'.$gambar_asli;

		$this->tiny_png->fileCompress($sumber, $menuju);
	}

	public function index()
	{
		$site = $this->site_model->get_site_data()->row_array();
		$data['csrf_token'] 		= $this->security->get_csrf_hash();
		$data['url'] 				= site_url('admin/slide');
		$data['canonical'] 			= site_url('admin/slide');
		$data['site_title'] 		= $site['site_title'];
		$data['site_name'] 			= $site['site_name'];
		$data['site_keywords'] 		= $site['site_keywords'];
		$data['site_author'] 		= $site['site_author'];
		$data['site_logo'] 			= $site['site_logo'];
		$data['site_description'] 	= $site['site_description'];
		$data['site_favicon'] 		= $site['site_favicon'];
		$data['tahun_buat'] 		= $site['tahun_buat'];
		$data['bc_menu'] 			= "Pengaturan";
		$data['bc_aktif'] 			= "Slide";
		$data['title'] 				= "Slide";

		$data['data_slide']		= $this->slide_model->get_all_data();

		$this->template->load('admin/template', 'admin/slide/data_v', $data);
		
	}

}

/* End of file Slide.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/controllers/admin/Slide.php */

?>
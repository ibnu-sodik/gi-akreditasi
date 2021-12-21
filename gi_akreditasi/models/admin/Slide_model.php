<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_model extends CI_Model {

	public function update_slide($id_slide, $judul_slide, $konten_slide)
	{
		$object = array(
			'judul_slide' => $judul_slide,
			'konten_slide' => $konten_slide
		);
		$this->db->where('id_slide', $id_slide);
		$this->db->update('tb_slide', $object);
	}

	public function update_slide_image($id_slide, $image, $judul_slide, $konten_slide)
	{
		$object = array(
			'judul_slide' => $judul_slide,
			'konten_slide' => $konten_slide,
			'gambar_slide' => $image
		);
		$this->db->where('id_slide', $id_slide);
		$this->db->update('tb_slide', $object);
	}

	public function hapus($id_slide)
	{
		$this->db->where('id_slide', $id_slide);
		$this->db->delete('tb_slide');
	}

	public function active_slide($id_slide)
	{
		$object = array('status_aktif' => 1);
		$this->db->where('id_slide', $id_slide);
		$this->db->update('tb_slide', $object);
	}

	public function inactive_all_slide()
	{
		$object = array('status_aktif' => 0);
		$this->db->update('tb_slide', $object);
	}

	public function simpan($image, $judul_slide, $konten_slide)
	{
		$object = array(
			'judul_slide' => $judul_slide,
			'konten_slide' => $konten_slide,
			'gambar_slide' => $image,
		);
		$this->db->insert('tb_slide', $object);
	}

	public function get_slide_by_id($id_slide)
	{
		$query = $this->db->query("SELECT * FROM tb_slide WHERE id_slide = '$id_slide' ");
		return $query;
	}

	public function get_all_data()
	{
		$query = $this->db->query("SELECT * FROM tb_slide ORDER BY status_aktif DESC ");
		return $query;
	}	

}

/* End of file Slide_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Slide_model.php */

 ?>
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Instrumen_model extends CI_Model {

	public function hapus($id_instrumen)
	{
		$this->db->where('id_instrumen', $id_instrumen);
		$this->db->delete('tb_instrumen');
	}

	public function update_instrumen($id_instrumen, $judul, $konten, $kategori, $slug, $deskripsi)
	{
		$object = array(
			'nama_instrumen' => $judul,
			'slug_instrumen' => $slug,
			'konten_instrumen' => $konten,
			'kategori_instrumen' => $kategori,
			'deskripsi_instrumen' => $deskripsi
		);
		$this->db->where('id_instrumen', $id_instrumen);
		$this->db->update('tb_instrumen', $object);
	}

	function get_instrumen_by_id($id_instrumen)
	{
		$result = $this->db->query("SELECT * FROM tb_instrumen WHERE id_instrumen = '$id_instrumen'");
		return $result;
	}

	public function simpan_instrumen($judul, $konten, $kategori, $slug, $deskripsi)
	{
		$object = array(
			'nama_instrumen' => $judul,
			'slug_instrumen' => $slug,
			'konten_instrumen' => $konten,
			'kategori_instrumen' => $kategori,
			'deskripsi_instrumen' => $deskripsi
		);
		$this->db->insert('tb_instrumen', $object);
	}

	public function gabungkan_data($kategori)
	{
		$query = $this->buat_query($kategori);
		// $query .= ' LIMIT '.$offset.', ' .$limit;
		$data = $this->db->query($query);

		$hasil = '';
		if ($data->num_rows() > 0) {
		$no=0;			
			foreach ($data->result() as $row) {
				$no++;
				$hasil .= '
				<tr>
					<td class="text-center">'.$no.'</td>
					<td>'.$row->nama_instrumen.'</td>
					<td class="text-center">
						<a data-id="'.$row->id_instrumen.'" href="#" id="detailInstrumen" class="btn btn-xs btn-success">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</a>

						<a href="'.site_url('admin/instrumen/edit/').$row->id_instrumen.'" class="btn btn-xs btn-info">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</a>

						<a href="javascript:void(0)" data-id="'.$row->id_instrumen.'" class="btn btn-xs btn-danger" id="tombolHapus">
							<i class="ace-icon fa fa-trash-o bigger-120"></i>
						</a>
					</td>
				</tr>
				';
			}
		}else{
			$hasil = '
			<tr>
				<td colspan="3">
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>

						<strong>
							<i class="ace-icon fa fa-times"></i>
							Oops...!
						</strong>
							Data tidak ditemukan.
						<br />
					</div>
				</td>
			</tr>
			';
		}
		return $hasil;
	}

	public function buat_query($kategori)
	{
		$query = "SELECT tb_instrumen.*, tb_kategori.* FROM tb_instrumen LEFT JOIN tb_kategori ON tb_instrumen.kategori_instrumen = tb_kategori.id_kategori";

		if (isset($kategori) && !empty($kategori)) {
			$kategori_filter = implode("','", $kategori);
			$query .= " WHERE kategori_instrumen IN('".$kategori_filter."') ";
		}

		return $query;
	}

	public function hitung_data($kategori)
	{
		$query = $this->buat_query($kategori);
		$data = $this->db->query($query);
		return $data->num_rows();
	}

	public function get_data($id_instrumen='')
	{
		if (empty($id_instrumen)) {
			$this->db->select('*');
			$this->db->from('tb_instrumen');
			$this->db->order_by('id_instrumen', 'desc');
			$query = $this->db->get();
		}else{
			$this->db->select('*');
			$this->db->from('tb_instrumen');
			$this->db->order_by('id_instrumen', 'desc');
			$this->db->where('id_instrumen', $id_instrumen);
			$query = $this->db->get();
		}
		return $query;
	}

}

/* End of file Instrumen_model.php */
/* Location: .//C/laragon/www/gi-akreditasi/gi_akreditasi/models/admin/Instrumen_model.php */

?>
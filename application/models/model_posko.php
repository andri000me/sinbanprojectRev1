<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Model_posko extends CI_Model
{
	public $nama_tabel = 'tbl_posko';

	public function __construct()
	{
		parent::__construct();
	}

	public function data_aturan_tambah()
	{
		$aturan_form = array(
				array(
						'field'		=>	'id_daerah',
						'label'		=>	'Nama Daerah',
						'rules'		=>	'required|max_length[5]'
					),
				array(
						'field'		=>	'nama_posko',
						'label'		=>	'Nama Posko',
						'rules'		=>	'required|min_length[3]|max_length[50]|is_unique['.$this->nama_tabel.'.nama_posko]'
					),
				array(
						'field'		=>	'alamat_posko',
						'label'		=>	'Alamat Posko',
						'rules'		=>	'required|min_length[3]|max_length[50]|is_unique['.$this->nama_tabel.'.alamat_posko]'
					),
			);
		return $aturan_form;
	}

	public function validasi_tambah()
	{
		$aturan_tambah = $this->data_aturan_tambah();
		$this->form_validation->set_rules($aturan_tambah);
		if ($this->form_validation->run()) 
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function tambah()
	{
		$posko = array(
					'id_daerah'			=> $this->input->post('id_daerah'),
					'nama_posko'		=> $this->input->post('nama_posko'),
					'alamat_posko'		=> $this->input->post('alamat_posko')
			);

		$this->db->insert($this->nama_tabel, $posko);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function posko_perpage($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->join('tbl_daerah', 'tbl_daerah.id_daerah = tbl_posko.id_daerah','left');
		$ambildataposko = $this->db->get('tbl_posko',$perPage,$uri);

		// Sama Saja Degan Perintah SQL = SELECT * FROM tbl_posko LEFT JOIN tbl_daerah ON tbl_daerah.id_daerah = tbl_posko.id_daerah

		if ($ambildataposko->num_rows() > 0) {
		  # code...
		  foreach ($ambildataposko->result() as $data) {
		    # code...
		    $hasildataposko[] = $data;
		  }
		  return $hasildataposko;
		}
	}

	public function ambildaerah()
	{
		$this->db->select('*');
		$this->db->from('tbl_daerah');
		$ambildatadaerah = $this->db->get();

		if ($ambildatadaerah->num_rows() > 0) {
		  # code...
		  foreach ($ambildatadaerah->result() as $data) {
		    # code...
		    $hasildatadaerah[] = $data;
		  }
		  return $hasildatadaerah;
		}
	}

	/* ================ BAGIAN EDIT ==================*/

	public function data_aturan_edit()
	{
		$aturan_form = array(
				array(
						'field'		=>	'id_daerah',
						'label'		=>	'Nama Daerah',
						'rules'		=>	'required|max_length[5]'
					),
				array(
						'field'		=>	'nama_posko',
						'label'		=>	'Nama Posko',
						'rules'		=>	'required|min_length[3]|max_length[50]'
					),
				array(
						'field'		=>	'alamat_posko',
						'label'		=>	'Alamat Posko',
						'rules'		=>	'required|min_length[3]|max_length[50]'
					),
			);
		return $aturan_form;
	}

	public function validasi_edit()
	{
		$aturan_edit = $this->data_aturan_edit();
		$this->form_validation->set_rules($aturan_edit);
		if ($this->form_validation->run()) 
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function updateposko($id_posko)
	{
	  $posko = array(
					'id_daerah'			=> $this->input->post('id_daerah'),
					'nama_posko'		=> $this->input->post('nama_posko'),
					'alamat_posko'		=> $this->input->post('alamat_posko')
			);
		
		$this->db->where('id_posko', $id_posko);
		$this->db->update($this->nama_tabel, $posko);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function pilihposko($id_posko)
	{
		return $this->db->get_where('tbl_posko', array('id_posko' => $id_posko))->row();
	}

	public function cariposko()
	{
		$data_cari = $this->input->post('cari');
		$this->db->select('*');
		$this->db->like('nama_posko', $data_cari);
		$this->db->join('tbl_daerah', 'tbl_daerah.id_daerah = tbl_posko.id_daerah','left');
		$query = $this->db->get('tbl_posko');
		return $query->result();
	}
}
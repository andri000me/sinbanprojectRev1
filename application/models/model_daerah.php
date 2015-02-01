<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Model_daerah extends CI_Model
{
	public $nama_tabel = 'tbl_daerah';

	public function __construct()
	{
		parent::__construct();
	}

	/* ======================= BAGIAN TAMBAH =======================*/

	public function data_aturan_tambah()
	{
		$aturan_form = array(
				array(
						'field'		=>	'nama_daerah',
						'label'		=>	'Nama Daerah',
						'rules'		=>	'required|min_length[3]|max_length[50]|is_unique['.$this->nama_tabel.'.nama_daerah]'
					),
				array(
						'field'		=>	'latitude',
						'label'		=>	'latitude',
						'rules'		=>	'required|min_length[3]|max_length[50]|is_unique['.$this->nama_tabel.'.latitude]'
					),
				array(
						'field'		=>	'longitude',
						'label'		=>	'longitude',
						'rules'		=>	'required|min_length[3]|max_length[50]|is_unique['.$this->nama_tabel.'.longitude]'
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
		$daerah = array(
					'nama_daerah'	=> $this->input->post('nama_daerah'),
					'latitude'		=> $this->input->post('latitude'),
					'longitude'		=> $this->input->post('longitude')
			);

		$this->db->insert($this->nama_tabel, $daerah);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function daerah_perpage($perPage,$uri)
	{
		$ambildatadaerah = $this->db->get('tbl_daerah',$perPage,$uri);
		
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
						'field'		=>	'nama_daerah',
						'label'		=>	'Nama Daerah',
						'rules'		=>	'required|min_length[3]|max_length[50]'
					),
				array(
						'field'		=>	'latitude',
						'label'		=>	'latitude',
						'rules'		=>	'required|min_length[3]|max_length[50]'
					),
				array(
						'field'		=>	'longitude',
						'label'		=>	'longitude',
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

	public function updatedaerah($id_daerah)
	{
	  $daerah = array(
					'nama_daerah'	=> $this->input->post('nama_daerah'),
					'latitude'		=> $this->input->post('latitude'),
					'longitude'		=> $this->input->post('longitude')
			);
		
		$this->db->where('id_daerah', $id_daerah);
		$this->db->update($this->nama_tabel, $daerah);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function pilihdaerah($id_daerah)
	{
		return $this->db->get_where('tbl_daerah', array('id_daerah' => $id_daerah))->row();
	}

	public function caridaerah()
	{
		$data_cari = $this->input->post('cari');
		$this->db->like('nama_daerah', $data_cari);
		$query = $this->db->get('tbl_daerah');
		return $query->result(); 
	}

}
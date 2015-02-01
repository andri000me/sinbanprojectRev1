<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Model_ketinggian extends CI_Model
{
	public $nama_tabel = 'tbl_ketinggian';

	public function __construct()
	{
		parent::__construct();
	}

	public function ketinggian_perpage($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->join('tbl_daerah', 'tbl_daerah.id_daerah = tbl_ketinggian.id_daerah','left');
		$ambildataketinggian = $this->db->get('tbl_ketinggian',$perPage,$uri);

		// Sama Saja Degan Perintah SQL = SELECT * FROM tbl_posko LEFT JOIN tbl_daerah ON tbl_daerah.id_daerah = tbl_posko.id_daerah

		if ($ambildataketinggian->num_rows() > 0) {
		  # code...
		  foreach ($ambildataketinggian->result() as $data) {
		    # code...
		    $hasildataketinggian[] = $data;
		  }
		  return $hasildataketinggian;
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

	/* Proses Tambah */

	public function data_aturan_tambah()
	{
		$aturan_form = array(
				array(
						'field'		=>	'id_daerah',
						'label'		=>	'Nama Daerah',
						'rules'		=>	'required|max_length[5]'
					),
				array(
						'field'		=>	'ketinggian_air',
						'label'		=>	'Ketinggian Air',
						'rules'		=>	'required|max_length[11]'
					),
				array(
						'field'		=>	'radius_daerah',
						'label'		=>	'Radius Daerah Genangan',
						'rules'		=>	'required|max_length[11]'
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
		date_default_timezone_set('asia/jakarta'); //Set Timezone Menurut Timezone Lokasi
		$tanggal_update = date('Y-m-d H:i:s');
		$ketinggian = array(
					'id_daerah'			=> $this->input->post('id_daerah'),
					'ketinggian_air'	=> $this->input->post('ketinggian_air'),
					'radius_daerah'		=> $this->input->post('radius_daerah'),
					'tanggal_update'	=> $tanggal_update
			);

		$this->db->insert($this->nama_tabel, $ketinggian);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	/* FUNGSI PENCARIAN */

	public function cariketinggian()
	{
		$data_cari = $this->input->post('cari');
		$this->db->select('*');
		$this->db->like('nama_daerah', $data_cari);
		$this->db->join('tbl_daerah', 'tbl_daerah.id_daerah = tbl_ketinggian.id_daerah','left');
		$query = $this->db->get('tbl_ketinggian');
		return $query->result();
	}

	/* FUNGSI UNTUK MENGEDIT */

	public function data_aturan_edit()
	{
		$aturan_form = array(
				array(
						'field'		=>	'id_daerah',
						'label'		=>	'Nama Daerah',
						'rules'		=>	'required|max_length[5]'
					),
				array(
						'field'		=>	'ketinggian_air',
						'label'		=>	'Ketinggian Air',
						'rules'		=>	'required|max_length[11]'
					),
				array(
						'field'		=>	'radius_daerah',
						'label'		=>	'Radius Daerah Genangan',
						'rules'		=>	'required|max_length[11]'
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

	public function updateketinggian($id_ketinggian)
	{
	  	date_default_timezone_set('asia/jakarta'); //Set Timezone Menurut Timezone Lokasi
		$tanggal_update = date('Y-m-d H:i:s'); //Menampilkan Tanggal dan Jam (Tahun-bulan-tanggal jam:menit:detik)
		$ketinggian = array(
					'id_daerah'			=> $this->input->post('id_daerah'),
					'ketinggian_air'	=> $this->input->post('ketinggian_air'),
					'radius_daerah'		=> $this->input->post('radius_daerah'),
					'tanggal_update'	=> $tanggal_update
			);
		
		$this->db->where('id_ketinggian', $id_ketinggian);
		$this->db->update($this->nama_tabel, $ketinggian);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function pilihketinggian($id_ketinggian)
	{
		return $this->db->get_where('tbl_ketinggian', array('id_ketinggian' => $id_ketinggian))->row();
	}
}
<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Ketinggian_air extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_ketinggian','ketinggian', TRUE);
	}

	public $data = array(
					'judul' 		=> 'Halaman Pengelola Ketinggian Air',
					'view_utama'	=> 'administrator/ketinggian/view_kelola_ketinggian',
					'pesan'			=> '',
					'breadcrumb'	=> 'Administrator > Kelola Ketinggian Air',
					'mode_peta'		=> FALSE
		);

	public function index()
	{
		$jum_record = $this->db->count_all('tbl_ketinggian'); //Mendapatkan jumlah recode yang ada pada tbl_daerah
		$config['base_url'] = site_url('administrator/ketinggian_air/index'); //halaman untuk menampilkan
		$config['total_rows'] = $jum_record; //total rows
		$config['per_page'] = '10'; //Jumlah Data Per-Page
		$config['uri_segment'] = 4; //Melihat Halaman dengan segmen ke-4 cek bab mengenai segment
		$config['first_link'] = '<i class="icon-first"></i>';
		$config['last_link'] = '<i class="icon-last"></i>';
		$config['next_link'] = '<i class="icon-next"></i>';
		$config['prev_link'] = '<i class="icon-previous"></i>';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination

		$this->data['hasildataketinggian'] = $this->ketinggian->ketinggian_perpage($config['per_page'],$this->uri->segment(4));
		$this->load->view('admin_template', $this->data);
	}

	public function tambah()
	{
		$this->data['view_utama'] = "administrator/ketinggian/view_tambah_ketinggian";
		$this->data['judul'] = "Ketinggian Air -> Tambah Ketinggian";
		$this->data['mode_peta'] = FALSE;

		/*===================== FUNGSI AKAN MENGINPUT JIKA SUBMIT DI TEKAN ==========================*/

		if ($this->input->post('submit')) 
		{
			// Menjalankan Fungsi Validasi
			if ($this->ketinggian->validasi_tambah()) 
			{
				if ($this->ketinggian->tambah()) 
				{
					$this->session->set_flashdata('pesan', 'Proses Tambah Berhasil');
					redirect(site_url('administrator/ketinggian_air'));
				}else{
					$this->data['pesan'] = "Proses Tambah Gagal";
					$this->load->view('admin_template', $this->data);
				}
			}else{
				// Mengambil Data Daerah
				$this->data['hasildaerah'] = $this->ketinggian->ambildaerah();
				$this->load->view('admin_template', $this->data);
			}
		}else{
			// Mengambil Data Daerah
			$this->data['hasildaerah'] = $this->ketinggian->ambildaerah();
			$this->load->view('admin_template', $this->data);
		}
	}

	public function cari() 
    {
		$this->data['hasildataketinggian']=$this->ketinggian->cariketinggian();
		
		if ($this->input->post('submit')) {
			if(empty($this->data['hasildataketinggian'])){
			// Jika Data Tidak Di Temukan maka akan menjalankan script pemberitahuan dan akan di kemablikan -1 dari link awal
				echo " <script>alert('Tidak Di Temukan: Cek kata atau Kalimat!');
				history.go(-1);</script>";

			}else{

				$this->load->view('admin_template', $this->data);
			}
		}else{
				redirect(site_url('administrator/ketinggian_air'));
		}
  	}

  	/* BAGIAN CONTROLLER FUNGSI EDIT*/
  	public function edit($id_ketinggian)
	{
		$this->data['view_utama'] = "administrator/ketinggian/view_edit_ketinggian";
		$this->data['judul'] = "Ketinggian -> Edit Data Ketinggian";
		$this->data['mode_peta'] = FALSE;

		// Jika Parameter id_ketinggian Tidak Kosong Maka akan di eksekusi
		if (! empty($id_ketinggian)) {
			if ($this->input->post('submit')) {
				if ($this->ketinggian->validasi_edit()) {
					// Jika Validasi Edit Berhasil di lakukan
					// Maka akan lakukan update
					$this->ketinggian->updateketinggian($id_ketinggian);
					$this->session->set_flashdata('pesan','Update Data Ketinggian Berhasil');
					redirect(site_url('administrator/ketinggian_air'));
				}else{
					// Jika Validasi Gagal
					$this->data['hasildaerah'] = $this->ketinggian->ambildaerah(); //Untuk Menampilkan Daerah Pada DropDown
					$this->data['tampilketinggian'] = $this->ketinggian->pilihketinggian($id_ketinggian);
					$this->load->view('admin_template',$this->data);
				}
			}else{
				//jika tidak di tekan submit maka akan memunculkan data edit
				$this->data['hasildaerah'] = $this->ketinggian->ambildaerah();
				$this->data['tampilketinggian'] = $this->ketinggian->pilihketinggian($id_ketinggian);
				$this->load->view('admin_template', $this->data);
			}
		}else{
			// Jika Paremeter Kosong maka akan langsung di arahkan ke halaman kelola
			redirect(site_url('administrator/ketinggian_air'));
		}
	}

	/* Bagian Hapus Data */

	public function hapus($id_ketinggian)
	{
		$this->db->delete('tbl_ketinggian', array('id_ketinggian' => $id_ketinggian));
	    redirect(site_url('administrator/ketinggian_air'));
	}
}
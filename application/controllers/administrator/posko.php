<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Posko extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_posko','posko', TRUE);
		// Meload Model daerah dan mengganti nama dengan daerah
	}

	public $data = array(
					'judul' 		=> 'Halaman Pengelola Posko Banjir',
					'view_utama'	=> 'administrator/posko/view_kelola_posko',
					'pesan'			=> '',
					'breadcrumb'	=> 'Administrator > Kelola Posko',
					'mode_peta'		=> FALSE
		);

	public function index()
	{
		$jum_record = $this->db->count_all('tbl_posko'); //Mendapatkan jumlah recode yang ada pada tbl_daerah
		$config['base_url'] = site_url('administrator/posko/index'); //halaman untuk menampilkan
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

		$this->data['hasildataposko'] = $this->posko->posko_perpage($config['per_page'],$this->uri->segment(4));
		$this->load->view('admin_template', $this->data);
	}

	public function tambah()
	{
		$this->data['view_utama'] = "administrator/posko/view_tambah_posko";
		$this->data['judul'] = "Posko -> Tambah Posko";
		$this->data['mode_peta'] = FALSE;

		/*===================== FUNGSI AKAN MENGINPUT JIKA SUBMIT DI TEKAN ==========================*/

		if ($this->input->post('submit')) 
		{
			// Menjalankan Fungsi Validasi
			if ($this->posko->validasi_tambah()) 
			{
				if ($this->posko->tambah()) 
				{
					$this->session->set_flashdata('pesan', 'Proses Tambah Berhasil');
					redirect(site_url('administrator/posko'));
				}else{
					$this->data['pesan'] = "Proses Tambah Posko Gagal";
					$this->load->view('admin_template', $this->data);
				}
			}else{
				// Mengambil Data Daerah
				$this->data['hasildaerah'] = $this->posko->ambildaerah();
				$this->load->view('admin_template', $this->data);
			}
		}else{
			// Mengambil Data Daerah
			$this->data['hasildaerah'] = $this->posko->ambildaerah();
			$this->load->view('admin_template', $this->data);
		}
	}

	public function cari() 
    {
		$this->data['hasildataposko']=$this->posko->cariposko();
		
		if ($this->input->post('submit')) {
			if(empty($this->data['hasildataposko'])){
			// Jika Data Tidak Di Temukan maka akan menjalankan script pemberitahuan dan akan di kemablikan -1 dari link awal
				echo " <script>alert('Tidak Di Temukan: Cek kata atau Kalimat!');
				history.go(-1);</script>";

			}else{

				$this->load->view('admin_template', $this->data);
			}
		}else{
				redirect(site_url('administrator/posko'));
		}
  	}

  	public function hapus($id_posko)
	{
		$this->db->delete('tbl_posko', array('id_posko' => $id_posko));
	    redirect(site_url('administrator/posko'));
	}

	/* ============= Bagian Fungsi Edit ====================*/

	public function edit($id_posko)
	{
		$this->data['view_utama'] = "administrator/posko/view_edit_posko";
		$this->data['judul'] = "Posko -> Edit Data Posko";
		$this->data['mode_peta'] = FALSE;

		// Jika Parameter Id_Posko Tidak Kosong Maka akan di eksekusi
		if (! empty($id_posko)) {
			if ($this->input->post('submit')) {
				if ($this->posko->validasi_edit()) {
					// Jika Validasi Edit Berhasil di lakukan
					// Maka akan lakukan update
					$this->posko->updateposko($id_posko);
					$this->session->set_flashdata('pesan','Update Data Posko Berhasil');
					redirect(site_url('administrator/posko'));
				}else{
					// Jika Validasi Gagal
					$this->data['hasildaerah'] = $this->posko->ambildaerah(); //Untuk Menampilkan Daerah Pada DropDown
					$this->data['tampilposko'] = $this->posko->pilihposko($id_posko);
					$this->load->view('admin_template',$this->data);
				}
			}else{
				//jika tidak di tekan submit maka akan memunculkan data edit
				$this->data['hasildaerah'] = $this->posko->ambildaerah();
				$this->data['tampilposko'] = $this->posko->pilihposko($id_posko);
				$this->load->view('admin_template', $this->data);
			}
		}else{
			// Jika Paremeter Kosong maka akan langsung di arahkan ke halaman kelola
			redirect(site_url('administrator/posko'));
		}
	}
}
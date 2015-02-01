<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Daerah extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_daerah','daerah', TRUE);
		// Meload Model daerah dan mengganti nama dengan daerah
	}

	public $data = array(
					'judul' 		=> 'Halaman Pengelola Daerah Banjir',
					'view_utama'	=> 'administrator/daerah/view_kelola_daerah',
					'pesan'			=> '',
					'breadcrumb'	=> 'Administrator > Kelola Daerah',
					'mode_peta'		=> FALSE
		);

	public function index()
	{
		$jum_record = $this->db->count_all('tbl_daerah'); //Mendapatkan jumlah recode yang ada pada tbl_daerah
		$config['base_url'] = site_url('administrator/daerah/index'); //halaman untuk menampilkan
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

		$this->data['hasildatadaerah'] = $this->daerah->daerah_perpage($config['per_page'],$this->uri->segment(4));
		$this->load->view('admin_template', $this->data);
	}

	public function tambah()
	{
		$this->data['view_utama'] = "administrator/daerah/view_tambah_daerah";
		$this->data['judul'] = "Daerah -> Tambah Daerah";
		$this->data['mode_peta'] = TRUE;

		$config['center'] = '-6.2297465,106.829518'; //Kordinat Kota Jakarta
		$config['zoom'] = '11';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '-6.2297465,106.829518'; //Kordinat Kota Jakarta
		$marker['draggable'] = true;
		$marker['ondragend'] = 	'var lat = event.latLng.lat()
								var long = event.latLng.lng()
								$("#latitude").val(lat);
								$("#longitude").val(long);
								';
		// Perintah Javascript Untuk Memindahkan nilai latitude dan longitude ke Input Text :)

		$this->googlemaps->add_marker($marker);
		$this->data['map'] = $this->googlemaps->create_map();

		/*===================== FUNGSI AKAN MENGINPUT JIKA SUBMIT DI TEKAN ==========================*/

		if ($this->input->post('submit')) 
		{
			// Menjalankan Fungsi Validasi
			if ($this->daerah->validasi_tambah()) 
			{
				if ($this->daerah->tambah()) 
				{
					$this->session->set_flashdata('pesan', 'Proses Tambah Berhasil');
					redirect(site_url('administrator/daerah'));
				}else{
					$this->data['pesan'] = "Proses Tambah Daerah Gagal";
					$this->load->view('admin_template', $this->data);
				}
			}else{
				$this->load->view('admin_template', $this->data);
			}
		}else{
			$this->load->view('admin_template', $this->data);
		}
	}

	public function edit($id_daerah)
	{
		$this->data['view_utama'] = "administrator/daerah/view_edit_daerah";
		$this->data['judul'] = "Daerah -> Edit Data Daerah";
		$this->data['mode_peta'] = TRUE;

		$this->lat = $this->daerah->pilihdaerah($id_daerah)->latitude;
		$this->long = $this->daerah->pilihdaerah($id_daerah)->longitude;

		$config['center'] = $this->lat.','.$this->long; //Kordinat Sebelum di Edit
		$config['zoom'] = '17';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $this->lat.','.$this->long; //Kordinat Sebelum di Edit
		$marker['draggable'] = true;
		$marker['ondragend'] = 	'var lat = event.latLng.lat()
								var long = event.latLng.lng()
								$("#latitude").val(lat);
								$("#longitude").val(long);
								';
		// Perintah Javascript Untuk Memindahkan nilai latitude dan longitude ke Input Text dengan cara DRAG & DROP :)

		$this->googlemaps->add_marker($marker);
		$this->data['map'] = $this->googlemaps->create_map();

		if (! empty($id_daerah)) {
			if ($this->input->post('submit')) {
				if ($this->daerah->validasi_edit()) {
					// Jika Validasi Edit Berhasil di lakukan
					// Maka akan lakukan update
					$this->daerah->updatedaerah($id_daerah);
					$this->session->set_flashdata('pesan','Update Data Daerah Berhasil');
					redirect(site_url('administrator/daerah'));
				}else{
					// Jika Validasi Gagal
					$this->data['tampildaerah'] = $this->daerah->pilihdaerah($id_daerah);
					$this->load->view('admin_template',$this->data);
				}
			}else{
				//jika tidak di tekan submit maka akan memunculkan data edit
				$this->data['tampildaerah'] = $this->daerah->pilihdaerah($id_daerah);
				$this->load->view('admin_template', $this->data);
			}
		}else{
			redirect(site_url('administrator/daerah'));
		}
	}


	public function hapus($id_daerah)
	{
		$this->db->delete('tbl_daerah', array('id_daerah' => $id_daerah));
	    redirect(site_url('administrator/daerah'));
	}

	public function cari() 
    {
		$this->data['hasildatadaerah']=$this->daerah->caridaerah();
		
		if ($this->input->post('submit')) {
			if(empty($this->data['hasildatadaerah'])){
			// Jika Data Tidak Di Temukan maka akan menjalankan script pemberitahuan dan akan di kemablikan -1 dari link awal
				echo " <script>alert('Tidak Di Temukan: Cek kata atau Kalimat!');
				history.go(-1);</script>";

			}else{

				$this->load->view('admin_template', $this->data);
			}
		}else{
				redirect(site_url('administrator/daerah'));
		}
  	}
}
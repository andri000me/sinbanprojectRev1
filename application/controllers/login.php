<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Login extends CI_Controller
{
	public $data = array('pesan' => '');

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model', 'login', TRUE);
		// Me-load model login_model dan di ubah namanya menjadi login
	}

	public function index()
	{
		if($this->session->userdata('login') == TRUE)
		{
			// jika status user sedang login maka akan otomatis ter-redirect ke halaman pengelola
			redirect(site_url().'administrator/beranda');

		}else{
				if ($this->input->post())
				{
					if($this->login->validasi())
					{
						// Memnaggil fungsi Validasi dan cek status user pada login_model
						if($this->login->cek_status_user())
						{
							redirect(site_url().'administrator/beranda');
						}else{
							$this->data['pesan'] = 'Username Atau Password Salah';
							$this->load->view('login_view', $this->data);
						}
					}else{
						$this->load->view('login_view', $this->data);
					}
				}else{
					// store the captcha word in a session
					$this->load->view('login_view', $this->data);
				}				
		}
	}

	public function logout()
	{
		$this->login->logout();
		redirect(site_url().'login');
	}
}
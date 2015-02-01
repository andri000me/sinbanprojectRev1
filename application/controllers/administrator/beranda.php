<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Beranda extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public $data = array(
					'judul' 		=> 'Halaman Utama Administrator',
					'view_utama'	=> 'administrator/admin_view',
					'mode_peta'		=> FALSE
		);

	public function index()
	{
		$this->load->view('admin_template', $this->data);
	}
}
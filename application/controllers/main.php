<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		#Code Here
		$this->load->view('main_view');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
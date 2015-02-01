<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		
		if ($this->session->userdata('login') == FALSE) 
		{
			redirect(site_url('login'));
		}

	}
}
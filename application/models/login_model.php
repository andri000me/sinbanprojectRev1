<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Login_model extends CI_Model
{
	public $nama_tabel = 'tbl_admin';

	public function data_aturan_form()
	{
		$data_rules = array(

							array(
									'field' => 'username',
									'label' => 'Username',
									'rules' => 'trim|required|min_length[5]|max_length[12]|xss_clean'
								),

							array(
									'field' => 'password',
									'label' => 'Password',
									'rules' => 'trim|required|min_length[5]|max_length[12]|xss_clean'
								)
							);
							return $data_rules;		
	}

	public function validasi()
	{
		// Memanggil fungsi data aturan untuk form login
		$form =$this->data_aturan_form();

		// Membuat dan menentukan rules atau aturan dengan data $form
		$this->form_validation->set_rules($form);


		if($this->form_validation->run())
		{
			return TRUE;
		}
			else
			{
				return FALSE;
			}
	}

	public function cek_status_user()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$status = $this->input->post('status');


		$query = $this->db->where('username', $username)
						  ->where('password', $password)
						  ->where('status', $status)
						  ->limit(1)
						  ->get($this->nama_tabel);

		// Jika query berhasil di jalankan dan bernilai TRUE maka akan membuat session login
		if($query->num_rows() == 1)
		{
			$data_session = array(
									'username' => $username,
			 						'status' => $status,
			 						'login' => TRUE
			 					);

			$this->session->set_userdata($data_session);

			return TRUE;
		}
			else
			{
				return FALSE;
			}
	}

	public function logout()
	{
		$data_session = array(
								'username' => '',
			 					'status' => '',
			 					'login' => FALSE
			 				);

		$this->session->unset_userdata($data_session);

		$this->session->sess_destroy();
	}
}
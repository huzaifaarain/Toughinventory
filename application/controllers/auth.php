<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

* 

*/

class Auth extends CI_Controller

{

	public function __construct()
	{
		parent::__construct();
	}


	public function index()

	{
		$logedin = $this->session->userdata('logedin');
		if ($logedin) 
		{
			redirect(site_url('dashboard'),'refresh');
		}

		if ($_POST) 

		{

			$data = (array)$_POST;

			$check = $this->dbo->validCred($data['username'],$data['password']);

			if ($check) 

			{

				$msg = " Welcome ".$this->session->userdata('fname');

				$this->session->set_flashdata('msg', $msg);

				redirect(site_url('dashboard'),'refresh');

			}

			else

			{

				$this->session->set_flashdata('msg', "Invalid Details");

				redirect(site_url(),'refresh');

			}

		}

		else

		{

			$this->load->view('login/header');

			$this->load->view('login/login');	

		}

		

	}



	public function logout()

	{

		$this->session->sess_destroy();

		redirect(site_url(),'refresh');

	}

}



/* End of file auth.php */

/* Location: ./application/controllers/auth.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Register extends CI_Controller
{
	public function index()
	{
			$this->load->view('header',array('title'=>"Register"));

			$this->load->view('register/view_register');

			$this->load->view('footer');	
	}
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Error extends CI_Controller
{
	public function index()
	{
		$this->load->view('404');
	}
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */
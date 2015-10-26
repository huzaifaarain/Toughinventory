<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Dlib
{
	
	function __construct()
	{
      	$this->ci =& get_instance();
	}

	public function checkLogin()
	{
		$logedin = $this->ci->session->userdata('logedin');
		if (!$logedin) 
		{
			redirect(site_url(),'refresh');
		}
	}
}
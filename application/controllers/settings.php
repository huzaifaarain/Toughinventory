<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

* 

*/

class Settings extends CI_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->dlib->checkLogin();

	}



	public function viewCDetails()

	{

		if ($_POST) 

		{

			$check = $this->dbo->saveCompanyDetails($_POST);
			$config['upload_path'] = './clogo/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite']	= true;
			$config['file_name']  = 'clogo';
			$this->load->library('upload', $config);
 			$this->upload->do_upload('logo');
			if ($check) 

			{

					$this->session->set_flashdata('msg', "Company Details Updated !");

				redirect(current_url(),'refresh');

			}

			else

			{

					$this->session->set_flashdata('msg', "Error Occured !");

				redirect(current_url(),'refresh');

			}

		}

		else

		{

			$data['details'] = $this->dbo->viewCDetails();

			$this->load->view('header',array('title'=>"Company Details"));

			$this->load->view('setting/view_cdetails',$data);

			$this->load->view('footer');

		}

	}



	public function viewCPassword()

	{

		if ($_POST) 

		{

			$data = (array)$_POST;

			$oldP = $data['old_password'];

			$newP = $data['new_password'];

			$confirmP = $data['confirm_password'];

			if ($newP == $confirmP) 

			{

				$tDetails['password'] = $newP;

				$tDetails['id'] = $this->session->userdata('id');

				$check = $this->dbo->changeP($tDetails,$oldP);

				if ($check) 

				{

						$this->session->set_flashdata('msg', "Password Changed !");

						redirect(current_url(),'refresh');

				}

				else

				{

					$this->session->set_flashdata('msg', "Error Occured !");

					redirect(current_url(),'refresh');

				}

			}

			else

			{

					$this->session->set_flashdata('msg', "New & Confirm Password must be matched !");

					redirect(current_url(),'refresh');

			}



		}

		else

		{

			$this->load->view('header',array('title'=>"Change Password"));

			$this->load->view('setting/view_cpassword');

			$this->load->view('footer');

		}

	}



	public function profile()

	{

		if ($_POST) 

		{

			$this->db->update('users', $_POST);

			if ($this->db->affected_rows() > 0) 

			{

				$this->session->set_flashdata('msg', "Updated ");

					redirect(site_url('auth/logout'),'refresh');

			}

			else

			{

				$this->session->set_flashdata('msg', "Error Occured !");

					redirect(current_url(),'refresh');

			}

		}

		else

		{

			$data['userDetails'] = $this->dbo->viewUsers(array('id'=>$this->session->userdata('id')));

			$this->load->view('header',array('title'=>"Profile Setting"));

			$this->load->view('setting/profile',$data);

			$this->load->view('footer');

		}

	}



	public function viewBackups()

	{

		$this->load->view('header',array('title'=>"Backups"));

		$this->load->view('setting/viewbackups');

		$this->load->view('footer');

	}



	public function delete_backup($file)

	{

		$path = "./DB_BACKUPS/".$file;

		if(unlink($path))

		{

			$this->session->set_flashdata('msg', "Deleted ".$file." !");

			redirect(site_url('settings/viewBackups'),'refresh');

		}

		else

		{

			$this->session->set_flashdata('msg', "Error Occured !");

			redirect(site_url('settings/viewBackups'),'refresh');

		}

	}



	public function backupDB()

	{

		$this->load->dbutil();

		

		$prefs = array(     

                'format'      => 'zip',             

                'filename'    => 'tl_db_backup.sql'

              );





		$backup =& $this->dbutil->backup($prefs); 

		$this->dbutil->optimize_database();

		

		$db_name = 'backup-on-'. date("d-M-Y-H-i") .'.zip';

		$save = 'DB_BACKUPS/'.$db_name;

		

		$this->load->helper('file');

		if(write_file($save, $backup))

		{

			redirect(site_url('settings/viewBackups'),'refresh');

		} 

		

		

		// $this->load->helper('download');

		// force_download($db_name, $backup);

	}



	public function reportSetting()

	{

		if ($_POST) 

		{

			$this->db->select('*')->from('rp_setting');

			if($this->db->get()->num_rows() > 0)

			{

				$this->db->update('rp_setting', $_POST);

				if ($this->db->affected_rows() > 0) 

				{

					$this->session->set_flashdata('msg', "Updated !");

					redirect(site_url('settings/reportSetting'),'refresh');

				}

				else

				{

					$this->session->set_flashdata('msg', "Error Occured !");

					redirect(site_url('settings/reportSetting'),'refresh');

				}

			}

			else

			{

				$this->db->insert('rp_setting', $_POST);

				if ($this->db->affected_rows() > 0) 

				{

					$this->session->set_flashdata('msg', "Updated !");

					redirect(site_url('settings/reportSetting'),'refresh');

				}

				else

				{

					$this->session->set_flashdata('msg', "Error Occured !");

					redirect(site_url('settings/reportSetting'),'refresh');

				}

			}

		}

		else

		{

			$this->load->view('header',array('title'=>"Report Setting"));

			$this->load->view('setting/view_reportsetting');

			$this->load->view('footer');

		}

	}

}



/* End of file settings.php */

/* Location: ./application/controllers/settings.php */
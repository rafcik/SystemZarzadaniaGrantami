<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
			$this->load->model('User_model','',TRUE);
    }
	
	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	public function login() 
	{
		//This method will have the credentials validation
		$this->load->library('form_validation');
 
		$this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
 
		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
			redirect('index.php?/auth', 'refresh');
		}
		else
		{
			//Go to private area
			redirect('/', 'refresh');
		}
	}
 
	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$email = $this->input->post('email');
 
		//query the database
		$result = $this->User_model->login($email, $password);
 
		if($result)
		{
			$sess_array = array();
			
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->id,
					'email' => $row->email,
					'imie' => $row->imie,
					'nazwisko' => $row->nazwisko
				);
			
				$this->session->set_userdata('logged_in', $sess_array);
			}
		
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}		
		
		
		/*
		if($this->input->post('email') == 'granty@lyrmet.pl' && $this->input->post('pass') == 'pass') {
			$this->session->set_userdata('logged_in', true);
			redirect('/', 'refresh');
		} else {
			redirect('index.php?/auth', 'refresh');
		}	
		
	}
	*/
	public function logout() 
	{
		$this->session->set_userdata('logged_in', false);
		redirect('/', 'refresh');
	}
}
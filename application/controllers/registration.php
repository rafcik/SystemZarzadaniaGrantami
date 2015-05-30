<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct() {
        parent::__construct();
		
		$this->load->model('User_model','',TRUE);
    }
	
	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('header');
		$this->load->view('registration');
		$this->load->view('footer');
	}
	
	public function register() 
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name','Imie','trim|required|max_length[32]');
        $this->form_validation->set_rules('surname','Nazwisko','trim|required|max_length[32]');
        $this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Haslo', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('con_password', 'Powtorz haslo', 'trim|required|matches[password]|callback_save_user');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('header');
			$this->load->view('registration');
			$this->load->view('footer');
		}
		else
		{
			$data = array(
						'email'=> $this->input->post('email_address'),
						'password'=> $this->input->post('password')
					);

			$this->session->set_flashdata('user_data', $data);
			
			redirect('auth/reg_login');
		}
	}
	
	function save_user($password)
	{
		$email = $this->input->post('email_address');
		
		$result = $this->User_model->getByEmail($email);
		if($result)
		{
			$this->form_validation->set_message('email_address', 'Użytkownik o tym adresie email już istnieje');
			return FALSE;
		}
		else
		{
			$this->User_model->add_user($this->input->post('name'), $this->input->post('surname'), $this->input->post('email_address'), $this->input->post('password'));
			return TRUE;
		}
	}
}
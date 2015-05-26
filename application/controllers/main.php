<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$data['logged_in'] = $this->session->userdata('logged_in');
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('main_content', $data);
		$this->load->view('footer');
	}
}
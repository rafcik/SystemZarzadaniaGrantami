<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('main_content');
		$this->load->view('footer');
	}
}
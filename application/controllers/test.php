<?php

class Test extends CI_Controller {
	
	public function index() {
		$data['test'] = 'test';
		$this->load->view('test', $data);
	}

    public function home() {
        echo 'test ok';
    }
	
}
?>
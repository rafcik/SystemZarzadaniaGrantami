<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grant extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Grant_model');
    }

    public function index()
    {
        $data['Grant_item'] = $this->Grant_model->get_granty();

        if (empty($data['Grant_item']))
        {
            show_404();
        }

        //$this->load->view('templates/header', $data);

            $data['title'] = "Granty";
            $this->load->view('Grant/index', $data);

        // $this->load->view('templates/footer');

    }

    public function show($id)
    {
        $data['Grant_item'] = $this->Grant_model->get_grant($id);

        if (empty($data['Grant_item']))
        {
            show_404();
        }

        //$this->load->view('templates/header', $data);

            $data['title'] = $data['Grant_item']->nazwa;

            $this->load->view('Grant/view', $data);

        // $this->load->view('templates/footer');
    }
}
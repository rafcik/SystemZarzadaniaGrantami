<?php
/**
 * Created by PhpStorm.
 * User: Elemele
 * Date: 2015-05-07
 * Time: 21:09
 */

class Zakladka extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Zakladka_model');
    }

    public function index()
    {
        $data['Zakladka'] = $this->Zakladka_model->get_Zakladka();
    }

    public function view($slug = NULL)
    {
        $data['Zakladka_item'] = $this->Zakladka_model->get_Zakladka($slug);

        if (empty($data['Zakladka_item']))
        {
            show_404();
        }

        $data['title'] = $data['Zakladka_item']['nazwa'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Elemele
 * Date: 2015-05-07
 * Time: 21:08
 */

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['User'] = $this->User_model->get_User();
    }

    public function view($slug = NULL)
    {
        $data['User_item'] = $this->Grant_model->get_User($slug);

        if (empty($data['User_item']))
        {
            show_404();
        }

        $data['title'] = $data['User_item']['imie'] + ' ' + $data['User_item']['nazwisko'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }
}

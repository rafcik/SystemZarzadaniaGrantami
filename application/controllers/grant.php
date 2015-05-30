<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grant extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Grant_model');
    }

    public function index()         // /grant  lista grantow dla zalogowanego uzytkownika
    {
        $data['logged_in'] = $this->session->userdata('logged_in');

        $data['Grant_item'] = $this->Grant_model->get_granty($data['logged_in']['id']);

        if (empty($data['Grant_item']))
        {
            show_404();
        }
        $data['title'] = "Granty";

        $this->load->view('header');
        $this->load->view('menu', $data);
        $this->load->view('Grant/index', $data);
        $this->load->view('footer');
    }

    public function get($id)      // grant/1
    {
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['Grant_item'] = $this->Grant_model->get_grant($id);

        if (empty($data['Grant_item']))
        {
            show_404();
        }

        $data['title'] = $data['Grant_item']->nazwa;
        $this->load->view('header');
        $this->load->view('menu', $data);
        $this->load->view('Grant/view', $data);
        $this->load->view('footer');
    }

    public function zakladka($idGrant, $idZakladki)       // grant/1/nazwa
    {
        echo "id grant: " . $idGrant . ' id zakladki: ' . $idZakladki;
        $data['logged_in'] = $this->session->userdata('logged_in');
        //$data['Grant_item'] = $this->Grant_model->get_grant($id);

        //$data['title'] = $nazwa;
        $this->load->view('header');
        $this->load->view('menu', $data);
        $this->load->view('Grant/tab', $data);
        $this->load->view('footer');
    }

    public function create()        // grant/create
    {
        $this->load->model('Kategoria_model');
        $data['kat'] = $this->Kategoria_model->get_kategoria();

        $data['logged_in'] = $this->session->userdata('logged_in');

        $this->load->view('header');
        $this->load->view('menu', $data);
        $this->load->view('Grant/create', $data);
        $this->load->view('footer');
    }

    public function insert()
    {
        echo 'ctr - insert()';

        $this->load->database();
        $this->load->model('Grant_model');
        $this->Grant_model->insert_entry();

        redirect('/');

    }
}
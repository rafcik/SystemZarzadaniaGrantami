<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grant extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Grant_model');
        $this->load->model('User_model');
        $this->load->model('Zakladka_model');
        $this->load->model('Podwykonawca_model');
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
		
		$this->session->set_userdata('grant_id', $id);

        $data['title'] = $data['Grant_item']->nazwa;
        $this->load->view('header');
        $this->load->view('menu', $data);
        $this->load->view('Grant/view', $data);
        $this->load->view('footer');
    }

    public function zakladka($idGrant, $idZakladki)       // grant/get/1/budget
    {
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['Grant_item'] = $this->Grant_model->get_grant($idGrant);
        $data['idZakladki'] = $idZakladki;

        if ($idZakladki == 'general')
        {
            $this->load->view('header');
            $this->load->view('menu', $data);
            $this->load->view('Grant/tab_general', $data);
            $this->load->view('footer');
        }
        else if ($idZakladki == 'budget')
        {
            $this->load->view('header');
            $this->load->view('menu', $data);
            $this->load->view('Grant/tab_budget', $data);
            $this->load->view('footer');
        }
        else if ($idZakladki == 'calendar')
        {
            $this->load->view('header');
            $this->load->view('menu', $data);
            $this->load->view('Grant/tab_calendar', $data);
            $this->load->view('footer');
        }
        else if ($idZakladki == 'files')
        {
            $this->load->view('header');
            $this->load->view('menu', $data);
            $this->load->view('Grant/tab_files', $data);
            $this->load->view('footer');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('menu', $data);
            $this->load->view('Grant/tab', $data);
            $this->load->view('footer');
        }
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
        $this->load->database();
        $this->load->model('Grant_model');
        $this->Grant_model->insert_entry();

        redirect('/');
    }

    public function newtab($idGrant)
    {
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['title'] = "Tworzenie nowej zakładki";
        $data['Users'] = $this->User_model->get_user();
        $data['idGrant'] = $idGrant;
        $data['Grant_item'] = $this->Grant_model->get_grant($idGrant);

        $this->load->view('header');
        $this->load->view('menu', $data);
        $this->load->view('Grant/newtab', $data);
        $this->load->view('footer');
    }

    public function insert_tab()
    {
        $this->load->database();

        $this->load->model('Zakladka_model');
        $idZakladki = $this->Zakladka_model->insert_entry();

        $this->load->model('Podwykonawca_model');
        $this->Podwykonawca_model->insert_entry($idZakladki);

        redirect('grant/get/' . $_POST['idGrant'] );
    }

    public function delete()
    {
        $this->load->database();
        $this->load->model('Grant_model');
        $this->Grant_model->delete_entry($_POST['idGrant']);

        redirect('/grant');
    }

    public function delete_tab()
    {
        $this->load->database();
        $this->load->model('Zakladka_model');
        $this->Zakladka_model->delete_entry($_POST['idZakladki']);

        redirect('/grant/get/' . $_POST['idGrant']);
    }
}
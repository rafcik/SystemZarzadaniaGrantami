<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grant extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Grant_model');
        $this->load->model('User_model');
        $this->load->model('Zakladka_model');
        $this->load->model('Podwykonawca_model');
		$this->load->model('Events_model');
    }

    public function index()         // /grant  lista grantow dla zalogowanego uzytkownika
    {
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['Grant_item'] = $this->Grant_model->get_granty($data['logged_in']['id']);

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

    public function zakladka($idGrant, $idZakladki, $year, $month)       // grant/get/1/budget
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
			
			$prefs['template'] = '
				{table_open}<table class="calendar">{/table_open}
				{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
				{cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
				{cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
				{cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
				{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
			';

			$prefs['show_next_prev'] = TRUE;
			$prefs['next_prev_url'] = base_url().'grant/get/'.$idGrant.'/calendar';
			
			$this->load->library('calendar', $prefs);

			if(!isset($year) || $year == '0') {
				$year = date('Y', time());
			}
			
			if(!isset($month) || $month == '0') {
				$month = date('n', time());
			}
			
			$events = $this->Grant_model->get_events($idGrant, $year, $month);
			
			$data2 = array();
			foreach($events as $event) {
				$data2[date('j', strtotime($event->date_time))] = $event->description;
			}

			$data['calendar'] = $this->calendar->generate($year, $month, $data2);
			
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
			$this->load->database();
			$this->load->model('Wpis_model');
			
			$wpisy = $this->Wpis_model->get_wpisy($idGrant, $idZakladki);
			$data['wpisy'] = array();
			
			$this->load->model('User_model');
		
			foreach($wpisy as $wpis) {
				$user = $this->User_model->get_user($wpis['user_id']);
				
				$wpis['user_name'] = $user->imie . ' ' . $user->nazwisko;
				
				array_push($data['wpisy'], $wpis);
			}
			
			
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
	
    public function add_event()
    {	 
		$this->load->database();
		$this->load->model('Events_model');
		$this->Events_model->insert_entry($_POST['eventDate'], $_POST['opis'], $_POST['idGrant']);
		
        redirect('/grant/get/' . $_POST['idGrant'] . '/calendar');
    }
	
	public function add_wpis()
    {
		$userData = $this->session->userdata('logged_in');
		
		$this->load->database();
		$this->load->model('Wpis_model');
		$this->Wpis_model->add_wpis($_POST['idGrant'], $_POST['idZakladki'], $_POST['wpis'], $userData['id']);
		
        redirect('/grant/get/' . $_POST['idGrant'] . '/' . $_POST['idZakladki']);
    }

	public function delete_wpis()
    {
		$userData = $this->session->userdata('logged_in');
		
		$this->load->database();
		$this->load->model('Wpis_model');
		$this->Wpis_model->delete_wpis($_POST['wpisId']);
		
        redirect('/grant/get/' . $_POST['idGrant'] . '/' . $_POST['idZakladki']);
    }
}

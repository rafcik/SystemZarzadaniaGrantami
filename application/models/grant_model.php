<?php

class Grant_model extends CI_Model
{
    public $id;
    public $nazwa;
    public $opis;
    public $kategoriaId;
    public $zalozycielId;
    public $budzet;
    public $czasRozpoczecia;
    public $deadline;
    public $czasRozliczenia;            // liczba tygodni

    public $podwykonawcy = array();             // tablica podwykonawcow (z tabeli podwykonawcy)
    public $podwykonawcyUserModel = array();    // podwykonawcy (user model)
    public $zakladki = array();           // tablica zakladek
	public $events = array();				//tablica eventów
	
    public $kategoria;
    public $zalozyciel;

    public function __construct()
    {
        $this->load->database();
        $this->load->model('Zakladka_model');
    }

    private function get_user($id)
    {
        $this->load->model('User_model');
        return $this->User_model->get_user($id);
    }

    private function get_kategoria($id)
    {
        $this->load->model('Kategoria_model');
        return $this->Kategoria_model->get_kategoria($id);
    }

    private function get_podwykonawcy($id)
    {
        //$this->db->select('userId');
        //$this->db->from('podwykonawca');
        //$this->db->where('grantId', $id);

        $query = $this->db->get_where('podwykonawca', array('grantId' => $id));
        //$this->db->get();
        $result =  $query->result_array();

        $podwykArr = array();

        foreach($result as $row) {
            $podwyk = new Podwykonawca();
            $podwyk->podwykId = $row['podwykId'];
            $podwyk->grantId = $row['grantId'];
            $podwyk->userId = $row['userId'];
            $podwyk->zakladkaId = $row['zakladkaId'];
            array_push($podwykArr, $podwyk );
        }

        return $podwykArr;
    }
	
	public function get_events($grant_id, $year, $month)
    {
		$this->load->model('Events_model');
		
		$time_from = $year.'-'.$month.'-01 00:00:00';
		$time_to = $year.'-'.($month+1).'-01 00:00:00';
		
		if($month == 12) {
			$time_from = $year.'-'.$month.'-01 00:00:00';
			$time_to = ($year+1).'-01-01 00:00:00';
		}
		
        $query = $this->db->get_where('events', array('grant_id' => $grant_id, 'date >=' => $time_from, 'date <' => $time_to));
		
        $result =  $query->result_array();

        $events = array();

        foreach($result as $row) {
            $event = new Events_model();
            $event->id = $row['id'];
            $event->date_time = $row['date'];
            $event->description = $row['description'];
            $event->grant_id = $row['grant_id'];
            array_push($events, $event);
        }

        return $events;
    }

    private function get_podwykonawcyUserModel($id)
    {
        $this->db->select('userId');
        $this->db->from('podwykonawca');
        $this->db->where('grantId', $id);
        $query = $this->db->get();
        $result =  $query->result_array();

        $podwykUMArr = array();

        foreach($result as $row) {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id', $row['userId']);
            $query2 = $this->db->get();

            $userRow = $query2->result_array();

            $user = new User_model();
            $user->imie = $userRow[0]['imie'];
            $user->nazwisko = $userRow[0]['nazwisko'];
            $user->email = $userRow[0]['email'];

            array_push($podwykUMArr, $user);
        }

        return $podwykUMArr;
    }

    private function get_zakladki($podwykonawcy)
    {
        $ret = array();

        $this->load->model('Zakladka_model');
        foreach($podwykonawcy as $podwyk) {
            array_push($ret, $this->Zakladka_model->get_zakladka($podwyk->zakladkaId));
        }
        return $ret;
    }

    public function get_granty($idUser)
    {
        $this->db->select('id');
        $this->db->from('grant');
        $this->db->where('zalozycielId', $idUser);
        $query = $this->db->get();
        $result =  $query->result_array();

        $ret = array();

        foreach($result as $row) {
            array_push($ret, $this->get_grant($row['id']));
        }
        return $ret;
    }

    public function get_grant($id)
    {
        $query = $this->db->get_where('grant', array('id' => $id));
        $ret = $query->row_array();

        $new = new Grant_model();

        $new->id = $ret['id'];
        $new->nazwa = $ret['nazwa'];
        $new->opis = $ret['opis'];
        $new->budzet = $ret['budzet'];
        $new->czasRozpoczecia = $ret['czasRozpoczecia'];
        $new->deadline = $ret['deadline'];
        $new->czasRozliczenia = $ret['czasRozliczenia'];

        $new->zalozyciel = $this->get_user($ret['zalozycielId']);
        $new->kategoria = $this->get_kategoria($ret['kategoriaId']);
        $new->podwykonawcy  = $this->get_podwykonawcy($id);
        $new->podwykonawcyUserModel  = $this->get_podwykonawcyUserModel($id);
        $new->zakladki = $this->get_zakladki($new->podwykonawcy );

        return $new;
    }

    function insert_entry()
    {
        echo '<pre>';
        //var_dump($_POST);
        echo '</pre>';

        $entry = array();

        $entry['nazwa'] = $_POST['nazwa'];
        $entry['opis'] = $_POST['opis'];
        $entry['kategoriaId'] = $_POST['kategoria_select'];
        $entry['zalozycielId'] = 1;
        $entry['budzet'] = $_POST['budzet'];
        $entry['czasRozpoczecia'] = $_POST['czasRozpoczecia'];
        $entry['deadline'] = $_POST['czasZakonczenia'];
        $entry['czasRozliczenia'] = $_POST['czasRozliczenia'];

        $user = $this->session->userdata('logged_in');
        $entry['zalozycielId'] = $user['id'];

        echo '<pre>';
           // var_dump($this);
        echo '</pre>';

        $this->db->insert('grant', $entry);
		
		$this->insert_events($user['id']);
    }
	
	function insert_events($user_id) {
        $this->db->select('id');
        $this->db->from('grant');
        $this->db->where('zalozycielId', $user_id);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		
        $query = $this->db->get();
		$ret =  $query->row_array();

		$grant_id = $ret['id'];
		
		$this->load->model('Events_model');
		$this->Events_model->insert_entry($_POST['czasRozpoczecia'], 'Rozpoczęcie grantu', $grant_id);
		$this->Events_model->insert_entry($_POST['czasZakonczenia'], 'Zakończenie grantu', $grant_id);
	}

    function delete_entry($id)
    {
        $this->db->delete('grant', array('id' => $id));
    }
}
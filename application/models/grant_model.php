<?php

class Grant_model extends CI_Model
{
    public $id;
    public $nazwa;
    public $opis;

    public $kategoria;
    public $zalozyciel;
    public $budzet;
    public $deadline;
    public $czasRozpoczecia;
    public $czasRozliczenia;            // liczba tygodni

    public $podwykonawcy = array();       // tablica podwykonawcow
    public $zakladki = array();           // tablica zakladek


    public function __construct()
    {
        $this->load->database();
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
        $this->db->select('userId');
        $this->db->from('podwykonawca');
        $this->db->where('grantId', $id);
        $query = $this->db->get();
        $result =  $query->result_array();

        $podwykArr = array();

        //var_dump($result);
        foreach($result as $row) {
            $podwyk = new Podwykonawca();
            array_push($podwykArr, $podwyk->get_user($row['userId']));
        }

        return $podwykArr;
    }

    private function get_zakladki($podwykonawcy)
    {
        $ret = array();

        $this->load->model('Zakladka_model');
        foreach($podwykonawcy as $podwyk) {
            array_push($ret, $this->Zakladka_model->get_zakladka($podwyk->id));
        }
        return $ret;
    }

    public function get_granty()
    {
        $ret = array();                         // tymczasowo
        array_push($ret, $this->get_grant(1));
        array_push($ret, $this->get_grant(2));

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
        $new->zakladki = $this->get_zakladki($new->podwykonawcy );

        return $new;
    }
}
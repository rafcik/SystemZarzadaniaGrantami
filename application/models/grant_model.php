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
    public $czasRozliczenia;            // liczba tygodni

    // public $podwykonawcy = array();       // tablica podwykonawcow
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
        $this->db->select('user.*');
        $this->db->from('user');
        $this->db->join('grant_podwykonawca', 'grant_podwykonawca.userId=user.id');
        $this->db->join('grant', 'grant_podwykonawca.grantId=grant.id');
        $this->db->where('grant.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    private function get_zakladki($id)
    {
        $this->load->model('Zakladka_model');
        return $this->Zakladka_model->get_zakladka($id);
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
        $new->deadline = $ret['deadline'];
        $new->czasRozliczenia = $ret['czasRozliczenia'];

        $new->zalozyciel = $this->get_user($ret['zalozycielId']);
        $new->kategoria = $this->get_kategoria($ret['kategoriaId']);
        //$this->podwykonawcy = $ret['podwykonawcy'] = $this->get_podwykonawcy($id);
        $new->zakladki = $this->get_zakladki($id);

        return $new;
    }
}
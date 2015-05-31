<?php

class Zakladka_model extends CI_Model {
    public $id;
    public $nazwa;
    public $opis;

    public function __construct()
    {
        $this->load->database();
    }

    public function get_zakladka($id)
    {
        $query = $this->db->get_where('zakladka', array('id' => $id));
        $ret = $query->row_array();

        $new = new Zakladka_model();
        $new->id = $ret['id'];
        $new->nazwa = $ret['nazwa'];
        $new->opis = $ret['opis'];

        return $ret;
    }

    function insert_entry()
    {
        $entry = array();

        $entry['nazwa'] = $_POST['nazwa'];
        $entry['opis'] = $_POST['opis'];

        $this->db->insert('zakladka', $entry);

        return $this->db->insert_id();
    }
}
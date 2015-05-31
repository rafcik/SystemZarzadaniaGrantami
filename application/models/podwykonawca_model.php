<?php

class Podwykonawca_model extends CI_Model
{
    public $podwykId;
    public $grantId;
    public $userId;
    public $zakladkaId;

    public function __construct()
    {
        $this->load->database();
    }

    function insert_entry($idZakladki)
    {
        $entry['grantId'] = $_POST['idGrant'];
        $entry['userId'] = $_POST['owner_select'];
        $entry['zakladkaId'] = $idZakladki;

        $this->db->insert('podwykonawca', $entry);
    }
}
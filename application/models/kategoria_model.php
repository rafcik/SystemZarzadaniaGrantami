<?php
/**
 * Created by PhpStorm.
 * User: Elemele
 * Date: 2015-05-07
 * Time: 20:55
 */

class Kategoria_model extends CI_Model {
    public $id;
    public $nazwa;

    public function __construct()
    {
        $this->load->database();
    }

    public function get_kategoria($id = false) {
        if ($id != null) {
            $query = $this->db->get_where('kategoria', array('id' => $id));
            $ret = $query->row_array();

            $new = new Kategoria_model();

            $new->id = $ret['id'];
            $new->nazwa = $ret['nazwa'];

            return $new;
        }
        else {
            $query = $this->db->get('kategoria');
            return $query->result();
        }
    }
}
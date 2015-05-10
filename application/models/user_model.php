<?php
/**
 * Created by PhpStorm.
 * User: Elemele
 * Date: 2015-05-07
 * Time: 20:57
 */

class User_model extends CI_Model {
    public $id;
    public $imie;
    public $nazwisko;
    public $email;

    public function __construct()
    {
        $this->load->database();
    }

    public function get_user($id = false) {
        if ($id != null) {
            $query = $this->db->get_where('user', array('id' => $id));
            $ret =  $query->row_array();

            $new = new User_model();

            $new->id = $ret['id'];
            $new->imie = $ret['imie'];
            $new->nazwisko = $ret['nazwisko'];
            $new->email = $ret['email'];

            return $new;
        }
        else {
            $query = $this->db->get('user');
            return $query->result();
        }
    }
}

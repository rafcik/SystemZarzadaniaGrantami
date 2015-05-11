<?php
/**
 * Created by PhpStorm.
 * User: Elemele
 * Date: 2015-05-07
 * Time: 20:56
 */

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

        var_dump($ret);

        $new = new Zakladka_model();
        $new->id = $ret['id'];
        $new->nazwa = $ret['nazwa'];
        $new->opis = $ret['opis'];

        return $ret;
        /*
        if ($idGrant != null) {
            $this->db->select('zakladka.*');
            $this->db->from('zakladka');
            $this->db->join('grant', 'zakladka.grantId=grant.id');
            $this->db->where('grant.id', $idGrant);
            $query = $this->db->get();

            $ret = array();

            foreach($query->result() as $row) {
                $new = new Zakladka_model();

                $new->id = $row->id;
                $new->nazwa = $row->nazwa;
                $new->opis = $row->opis;

                $new->load->model('User_model');
                $new->podwykonawca =  $new->User_model->get_user($row->podwykId);

                array_push($ret, $new);
            }
            return  $ret;
        }
        */
    }
}
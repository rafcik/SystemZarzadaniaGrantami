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
    
    public function add_user($name, $surname, $email, $password)
    {
        $data = array(
            'imie'=> $name,
            'nazwisko'=> $surname,
            'email'=> $email,
            'password'=> md5($password),
			'hash'=> md5($password)
        );
        
		$this->db->insert('user', $data);
    }
	
	function login($email, $password)
	{
		$this->db->select('id, imie, nazwisko, email, password');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);
	 
		$query = $this->db->get();
	 
		if($query->num_rows() == 1)
		{
			return $query->result();
		} 
		else
		{
			return false;
		}
	}
	
	function getByEmail($email)
	{
		$this->db->select('id, imie, nazwisko, email, password');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->limit(1);
	 
		$query = $this->db->get();
	 
		if($query->num_rows() == 1)
		{
			return $query->result();
		} 
		else
		{
			return false;
		}
	}
}

class Podwykonawca extends User_model {
    public $zakladka;
}

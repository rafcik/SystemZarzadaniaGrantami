<?php

class Wpis_model extends CI_Model {
    public $wpis_id;
    public $grantId;
    public $zakladkaId;
    public $wpis;
	public $userId;
	public $dataWpisu;
	
    public function __construct()
    {
        $this->load->database();
    }

    public function get_wpisy($grantId, $zakladkaId) {
        $this->db->select('*');
        $this->db->from('wpisy');
        $this->db->where('grant_id', $grantId);
		$this->db->where('zakladka_id', $zakladkaId);
        $query = $this->db->get();
        $result =  $query->result_array();

        return $result;
    }
	
	public function add_wpis($grantId, $zakladkaId, $wpis, $userId) {
        $entry = array();

        $entry['grant_id'] = $grantId;
        $entry['zakladka_id'] = $zakladkaId;
        $entry['wpis'] = $wpis;
		$entry['user_id'] = $userId;

        $this->db->insert('wpisy', $entry);
    }
	
	public function delete_wpis($id)
    {
        $this->db->delete('wpisy', array('wpis_id' => $id));
    }
}

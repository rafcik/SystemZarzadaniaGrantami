<?php

class Events_model extends CI_Model
{
    public $id;
    public $date_time;
    public $description;
    public $grant_id;
   
    public function __construct()
    {
        $this->load->database();
    }
	
	private function get_event($id) 
	{
        $query = $this->db->get_where('events', array('id' => $id));
        $ret = $query->row_array();

        $new = new Events_model();

        $new->id = $ret['id'];
        $new->date_time = $ret['date'];
        $new->description = $ret['description'];
        $new->grant_id = $ret['grant_id'];

        return $new;
	}

    function insert_entry($date, $description, $grant_id)
    {
        $entry = array();

        $entry['date'] = $date;
        $entry['description'] = $description;
        $entry['grant_id'] = $grant_id;

        $this->db->insert('events', $entry);
    }

    function delete_entry($id)
    {
        $this->db->delete('events', array('id' => $id));
    }
}
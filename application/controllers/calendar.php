<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/Google/autoload.php';

class Calendar extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		if($this->session->userdata('token')) {
			require_once 'application/libraries/calendar_init.php';
			
			$client->setAccessToken($this->session->userdata('token'));
	
			$service = new Google_Service_Calendar($client);    
	
			$calendarList = $service->calendarList->listCalendarList();;
			/*
			while(true) {
				foreach ($calendarList->getItems() as $calendarListEntry) {

					echo $calendarListEntry->getSummary()."<br>\n";


					// get events 
					$events = $service->events->listEvents($calendarListEntry->id);


				//	foreach ($events->getItems() as $event) {
				//		echo "-----".$event->getSummary()."<br>";
				//	}
				}
				$pageToken = $calendarList->getNextPageToken();
				if ($pageToken) {
					$optParams = array('pageToken' => $pageToken);
					$calendarList = $service->calendarList->listCalendarList($optParams);
				} else {
					break;
				}
			}
			*/
			
			$data['calendarList'] = $calendarList;
			$data['logged_in'] = $this->session->userdata('logged_in');
		
			$this->load->view('header');
			$this->load->view('menu', $data);
			$this->load->view('calendar', $data);
			$this->load->view('footer');
		} else {
			redirect('auth/calendar');
		}
	}
}
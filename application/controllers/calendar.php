<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/libraries/Google/autoload.php';

class Calendar extends CI_Controller {
	public $service;
	public $client;
	
	public function __construct() {
        parent::__construct();
		$this->load->model('Grant_model');
    }
	
	public function index()
	{
		/*
		if($this->session->userdata('token')) {
			//echo $this->session->userdata('token');
			
			require_once 'application/libraries/calendar_init.php';
			
			$this->client = $client;
			$this->client->setAccessToken($this->session->userdata('token'));
	
			$this->service = new Google_Service_Calendar($client);    
	
			$calendarList = $this->service->calendarList->listCalendarList();
		*/
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
			/*
			$grant_id = $this->session->userdata('grant_id');
			$grant = $this->Grant_model->get_grant($grant_id);
			
			$calendarName = "grant_".str_replace(" ", "", $grant->nazwa).'_'.$grant_id;
			
			$calendar_id = $this->getCalendarIdBySummary($calendarName);
			
			if($calendar_id == null) {
				$calendar_id = $this->createNewCalendar($calendarName);
			}
			
			//$calendar = $this->service->calendars->get($calendar_id);
			
			//$events = $this->service->events->listEvents($calendar_id);
			//foreach ($events->getItems() as $event) {
			//			echo "-----".$event->getSummary()."<br>";
			//		}
			$this->synchronizeEvents($calendar_id);
			
			$data['calendarList'] = $calendarList;
			$data['logged_in'] = $this->session->userdata('logged_in');
			$data['grant_id'] = $grant_id;
			
			
			
			$this->load->view('header');
			$this->load->view('menu', $data);
			$this->load->view('calendar', $data);
			$this->load->view('footer');
			
		} else {
			redirect('auth/calendar');
		}
		
			*/
		
		$data['logged_in'] = $this->session->userdata('logged_in');
			
		$this->load->view('header');
		$this->load->view('menu', $data);


$prefs['template'] = '
    {table_open}<table class="calendar">{/table_open}
    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
    {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
';

$this->load->library('calendar', $prefs);

$data2 = array(
               3  => 'asdsad',
               7  => 'asdsad',
               13 => 'asdsad',
               26 => 'asdsad'
             );

		$data['calendar'] = $this->calendar->generate(2015, 6, $data2);
		$this->load->view('calendar', $data);
		$this->load->view('footer');
	}
	
	private function getCalendarIdBySummary($title) {
		$calendarList = $this->service->calendarList->listCalendarList();
		
		while(true) {
			foreach ($calendarList->getItems() as $calendarListEntry) {
				if($calendarListEntry->getSummary() == $title) {
					return $calendarListEntry->getId();
				}
			}
			
			$pageToken = $calendarList->getNextPageToken();
			
			if ($pageToken) {
				$optParams = array('pageToken' => $pageToken);
				$calendarList = $service->calendarList->listCalendarList($optParams);
			} else {
				break;
			}
		}
		
		return null;
	}
	
	private function createNewCalendar($name) {
		$calendar = new Google_Service_Calendar_Calendar();
		$calendar->setSummary($name);
		
		$createdCalendar = $this->service->calendars->insert($calendar);

		return $createdCalendar->getId();
	}
	
	private function synchronizeEvents($calendar_id) {
		$this->addEvent($calendar_id, 'event', '2015-06-03T10:00:00.000-07:00', '2015-06-03T10:25:00.000-07:00');
	}
	
	private function addEvent($calendar_id, $summary, $start, $end) {
		/*
		$event = new Google_Service_Calendar_Event();
		$event->setSummary($summary);
		$start = new Google_Service_Calendar_EventDateTime();
		$start->setDateTime($start);
		$event->setStart($start);
		$end = new Google_Service_Calendar_EventDateTime();
		$end->setDateTime($end);
		$event->setEnd($end);

		$this->service->events->insert($calendar_id, $event);
*/

		//$createdEvent = $this->service->events->quickAdd(
		//	$calendar_id,
		//	$summary);

		//$start = new Google_Service_Calendar_EventDateTime();
		//$start->setDateTime($start);
		//$createdEvent->setStart($start);
		//$end = new Google_Service_Calendar_EventDateTime();
		//$end->setDateTime($end);
		//$createdEvent->setEnd($end);
		
		//$updatedEvent = $this->service->events->update($calendar_id, $createdEvent->getId(), $createdEvent);
//echo $createdEvent->getId();
	//	return $createdEvent->getId();
	}
}
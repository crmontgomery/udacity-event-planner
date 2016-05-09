<?php

class Events_Model extends Model {

    function __construct()
    {
    parent::__construct();
    }

    // Create
     function createEvent()
    {
        try {
            $table = 'event';
            $data = array(
                    'name' => $_POST['name'],
                    'host' => $_POST['host'],
                    'startDateTime' => $_POST['startDate'],
                    'endDateTime' => $_POST['endDate'],
                    'location' => $_POST['location'],
                    'message' => $_POST['message'],
                    'eventType' => $_POST['type'],
                    'guests' => $_POST['guests'],
                    'user_id' => Session::get('userId')
                    );

            $this->db->insert($table, $data);
            $eventId = $this->db->lastInsertId();

            echo $eventId;
        } catch(Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('There was a problem creating your event.' => 'ERROR', 'code' => 0117)));
        }
    }

    // Read
    function getEventsList()
    {
        $sql = 'SELECT * FROM event';

        return $this->db->select($sql);
    }
  



    // Update


    // Delete
  
 
}

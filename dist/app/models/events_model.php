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
            $typeId = null;
            $eventTypeArray = $this->eventTypeExists(strtolower($_POST['type']));
            
            if($eventTypeArray['id'] == null){
                $table = 'eventType';
                $data = array(
                        'name' => $_POST['type']
                        );

                $this->db->insert($table, $data);
                $typeId = $this->db->lastInsertId();
            } else {
                $typeId = $eventTypeArray['id'];
            }
            
            $table = 'event';
            $data = array(
                    'name'          => $_POST['name'],
                    'host'          => $_POST['host'],
                    'startDateTime' => $_POST['startDate'],
                    'endDateTime'   => $_POST['endDate'],
                    'location'      => $_POST['location'],
                    'message'       => $_POST['message'],
                    'eventType_id'  => $typeId,
                    'guests'        => $_POST['guests'],
                    'user_id'       => Session::get('userId')
                    );

            $this->db->insert($table, $data);
            $eventId = $this->db->lastInsertId();

            echo $eventId;
        } catch(Exception $e) {
            header('HTTP/1.1 500 Internal Server Error: Event');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('There was a problem creating your event.' => 'ERROR', 'code' => 0117)));
        }
    }

    // Read
    function getEventsList()
    {
        $sql = 'SELECT a.*, b.name as eventType_name 
                FROM event a 
                INNER JOIN eventType b 
                WHERE a.eventType_id = b.id';

        return $this->db->select($sql);
    }
    
    function getEventTypeList()
    {
        $sql = 'SELECT * FROM eventType';

        return $this->db->select($sql);
    }
  
    // Update
    // Delete
    
    // Misc
    private function eventTypeExists($type)
    {
        $types = $this->getEventTypeList();
        $return = array(
                        'status' => false, 
                        'id'     => null
                        );

        foreach($types as $item){
            if($_POST['type'] == $item['name']){
                $return['status'] = true;
                $return['id'] = $item['id']; 
            }
        }
        
        return $return;
    }
}

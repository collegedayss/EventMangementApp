<?php
//Event Class, Arrays used due to easier manipulation.
class Event
{
    private $id;
    private $name;
    private $address;
    private $date;
    private $duration;
    private $orgEmail;


    function construct($id, $name, $host, $address, $date, $duration, $orgEmail)
    {
        $this->id = $id;
        $this->host = $host;
        $this->name = $name;
        $this->address = $address;
        $this->date = $date;
        $this->duration = $duration;
        $this->orgEmail = $orgEmail;
    }
    function __get($prop)
    {
        if (property_exists($this, $prop))
            return $this->$prop;
    }
    function __set($prop, $val)
    {
        if (property_exists($this, $prop))
            $this->$prop = $val;
    }
    function toString()
    {
        return $this->id . ":" . $this->name . ":" . $this->location . ":" . $this->address . ":" . $this->date . ":" . $this->duration . ":" . $this->orgEmail;
    }

    function getBSRow()
    {
    }
}

function createEventFromDB($id)
{
    include("includes/connect.php");

    $sql = "SELECT * FROM events,eventstaff WHERE PersonID=$id AND events.EventID = eventstaff.EventID";
    $result = $smeConn->query($sql);
    $events = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $address  = $row["Address"] . " ," . $row["State"] . " ," . $row["Zipcode"];
            $current_event =  new Event(
                $row['EventID'],
                $row['Name'],
                $row["HostName"],
                $address,
                $row['DateofEvent'],
                $row['LengthOfEvent'],
                $row['HostEmail']
            );
            array_push($events, $current_event);
        }
        return $events;
    } else
        return null;
}

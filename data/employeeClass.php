
<?php

//Class for creating Employee
class Employee
{
	private $id;
	private $first;
	private $last;
	private $usertype;
	private $phone;
	private $payrate;

	function __construct($id, $first, $last, $usertype, $phone, $payrate)
	{
		$this->first = $first;
		$this->last = $last;
		$this->usertype = $usertype;
		$this->first = $first;
		$this->payrate = $payrate;
		$this->phone = $phone;
		$this->id = $id;
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
	function __toString()
	{
		$ret = $this->last . ", " . $this->first . "<br/>";
		$ret .= $this->phone . "<br/>";

		return $ret;
	}


	//Create Array of Events for Employee
	function getEmployeeEvents()
	{
		include("includes/connect.php");
		$current_id = $this->id;
		$sql = "SELECT * FROM events,eventstaff WHERE PersonID=$current_id AND events.EventID = eventstaff.EventID";
		$result = $smeConn->query($sql);
		$events = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$current_event = array();
				$address  = $row["Address"] . " ," . $row["State"] . " ," . $row["Zipcode"];
				array_push($current_event, $row["Name"]);
				array_push($current_event, $row["EventID"]);
				array_push($current_event, $row["DateofEvent"]);
				array_push($current_event, $address);
				array_push($current_event, $row["Phone"]);
				array_push($current_event, $row["HostName"]);
				array_push($current_event, $row["HostEmail"]);
				array_push($current_event, $row["LengthOfEvent"]);
				array_push($events, $current_event);
			}
			return $events;
		} else
			return null;
	}



	//Create remaining Table left off in includes/table.php using the employee object created

	function getBSRow(
		$allevents,
		$allEventDates,
		$eventIDs
	) {
		include("includes/connect.php");


		// Names, Phone Numbers and and Employee Type of Current User.
		$current_id = $this->id;
		$events = $this->getEmployeeEvents();
		$ret = "<tr>";
		$ret .= "<td obj='Users' person = '$current_id'>" . $this->first . " " . $this->last . "</td>";
		$ret .= "<td>" . $this->phone . "</td>";
		$ret .= "<td>" . $this->usertype[0] . "</td>";


		//Creating an all Vacations for Current Employee.
		$sql = "SELECT * FROM vacations WHERE PersonID=$current_id";
		$result = $smeConn->query($sql);
		$vacations = array();

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($vacations, $row["Dates"]);
			}
		} else {
			array_push($vacations, "Preventing this array from being NULL");
		}
		//pointer to keep track of events.
		$counter = 0;

		for ($x = 0; $x < count($allevents); $x++) {

			$current_event_name = $allevents[$x];

			//String Matching Event Names.
			if ($events[$counter][0] == $allevents[$x]) {
				//Checking for Vacation Day conflicts.
				if (in_array($allEventDates[$x], $vacations)) {
					$ret .= "<td class='bg-danger' event='$current_event_name' status='vacation'>Vacation</td>";
				} else {
					$ret .= "<td  eventID='" . $eventIDs[$x] . "' userType='" . $this->usertype[0] . "'person='$current_id' clickablebox='true' class=' bg-success' event='$current_event_name' wage='$this->payrate' status='active'>1</td>";
				}
				if ($counter < count($events) - 1) {
					$counter++;
				}
			} else {
				//Checking for Vacation Day conflicts.
				if (in_array($allEventDates[$x], $vacations)) {
					$ret .= "<td class='bg-danger' event='$current_event_name' status='vacation'>Vacation</td>";
				} else {
					$ret .= "<td eventID='" . $eventIDs[$x] . "' person='$current_id' userType='" . $this->usertype[0] . "' class='' clickablebox='true' event='$current_event_name' wage='$this->payrate' status='inactive' ></td>";
				}
			}
		}
		// Creating Column for events perworker.
		$ret .= "<td obj='totaleventsforworker' person='$current_id' ></td>";
		$ret .= "</tr>";

		return $ret;
	}
}


//Class to create employee just using id.
function createEmployeeFromDB($tempid)
{
	include("includes/connect.php");
	$sql = "select * from users where PersonID=$tempid";
	$result = $smeConn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return new Employee($row['PersonID'], $row['FirstName'], $row['LastName'], $row['Usertype'], $row['Phone'], $row['PayRate']);
	} else
		return null;
}
//Update class to Create Rows for Employees/Cost as used Ajax, jquery to Calculate costs.
function EmployeesPerEvent($rowName, $totalWorkersPerEvent)
{

	if ($rowName == 'Cost') {
		$ret = "<tr class=' bg-info' ><td >TOTAL $rowName</td><td></td><td></td>";
		foreach ($totalWorkersPerEvent as $value) {
			$ret .= "<td obj='totalcostofevent' event='$value'> </td>";
		}
	} else {
		$ret = "<tr class=' bg-warning' ><td  >TOTAL $rowName</td><td></td><td></td>";
		foreach ($totalWorkersPerEvent as $value) {
			$ret .= "<td obj='$rowName' event='$value'> </td>";
		}
	}
	$ret .= "</tr>";
	return $ret;
}
?>
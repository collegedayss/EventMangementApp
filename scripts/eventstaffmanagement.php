<?php
include("../includes/connect.php");


if (isset($_POST['eventID'])) {
    $eventID = $_POST['eventID'];
    $PersonID = $_POST['PersonID'];
    $status = $_POST['status'];

    if ($status == "active") { //remove user from event
        $sql = "DELETE FROM `eventstaff` WHERE eventstaff.EventID = $eventID AND eventstaff.PersonID = $PersonID";
        if ($smeConn->query($sql) === TRUE) {
            echo "Deleted user from DB";
        } else {
            echo "Error: " . $sql . "<br>" . $smeConn->error;
        }
        $smeConn->close();
    } else { //add user to event
        echo "We're adding this user to the event";
        $sql = "INSERT INTO eventstaff
        VALUES (NULL, $eventID,$PersonID)";
        if ($smeConn->query($sql) === TRUE) {
            echo "Added user to Event";
        } else {
            echo "Error: " . $sql . "<br>" . $smeConn->error;
        }
        $smeConn->close();
    }
}

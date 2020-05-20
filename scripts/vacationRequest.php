<?php session_start(); ?>
<?php include("../includes/connect.php"); ?>
<?php
//Creating New Vacation from Post Request and Inserting into database.

$id = $_SESSION['id'];
$vacation_date = $_POST['vacation_date'];


$sql = "INSERT INTO vacations VALUES (NULL,'$vacation_date', '$id')";

if ($smeConn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $smeConn->error;
}
$smeConn->close();

?>
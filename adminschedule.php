<?php session_start(); ?>
<?php
//handle error codes
//err=rights -> user rights issue
//secure the page to only Admins and Organizers
if (!isset($_SESSION['userType']) || ($_SESSION['userType'] != "admin")) {
	echo "<script>location.href='index.php?err=rights';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v3.8.6">

	<title>Magma Events</title>


	<?php include("includes/head.php"); ?>

	<style>
		/* Page styles used for sections and internal anchors */
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}

		.anchor {
			display: block;
			height: 60px;
			/*same height as header*/
			margin-top: -60px;
			/*same height as header*/
			visibility: hidden;
		}

		ol {
			display: none;
		}

		h5 {
			display: none;
		}

		.added-box {
			padding: 8px;
			margin: 8px;
			border: 1px dotted white;
		}
	</style>
</head>

<body>
	<header>
		<?php include("includes/head.php"); ?>

		<?php include("includes/nav.php"); ?>
	</header>

	<main role="main" class="container">

		<h3>AllEvents Schedule</h3>
		<?php include("includes/connect.php");
		if (isset($_SESSION['id'])) {
			$userid = $_SESSION['id'];
			//get all events
			$sql = "select events.EventID,events.LengthOfEvent,events.State,events.Zipcode, events.Name, events.DateofEvent, events.Address from events order by events.DateofEvent";
			$result = $smeConn->query($sql);
			while ($row = $result->fetch_assoc()) {
				$eventName  = $row['Name'];
				echo "<div >";
				echo "<span  class='added-box'> $eventName</span  >";
				echo "<span  class='added-box' >Event(hours) :" . $row['LengthOfEvent'] . "</span  >";
				echo "<span  class='added-box'>" . date("m/d/Y", strtotime($row['DateofEvent'])) . "</span  >";
				echo "<span  class='added-box' >" . "<a class='text-success' target='_blank' href='http://maps.google.com/?q=" . $row['Address'] . ", " . $row['State'] . "," . $row['Zipcode'] . "'>" . $row['Address'] . ", " . $row['State'] . "," . $row['Zipcode'] . "</a></span  >";
				echo "<button  class = 'btn btn-primary'id='togglebutton'> more Info</button>";
				$eventsID = $row['EventID'];

				//Get all the Staff for the Event
				$sql2 = "SELECT * FROM `eventstaff`,users WHERE eventstaff.EventID = $eventsID AND eventstaff.PersonID = users.PersonID ORDER BY users.Usertype,users.LastName";


				//Get all vacations for current user.(better impletmentation would just use a function)
				$sql3 = "SELECT * FROM vacations WHERE PersonID=$userid";
				$result3 = $smeConn->query($sql3);
				$vacations = array();

				if ($result3->num_rows > 0) {
					while ($row3 = $result3->fetch_assoc()) {
						array_push($vacations, $row3["Dates"]);
					}
				} else {
					array_push($vacations, "Preventing this array from being NULL");
				}


				echo "<h5>Staff for $eventName</h5>";
				echo "<ol>";
				//Display Users
				$result2 = $smeConn->query($sql2);
				while ($row2 = $result2->fetch_assoc()) {
					//Check if user has vacation on day of event
					if (in_array($row['DateofEvent'], $vacations)) {
					} else {
						echo "<li>" . $row2['FirstName'] . " " . $row2['LastName'] . "</li>";
					}
				}

				$sql3 = "SELECT * FROM `eventstaff`,users,events WHERE eventstaff.EventID = $eventsID AND eventstaff.PersonID = users.PersonID AND eventstaff.EventID = events.EventID";
				$total = 0;

				//Get total cost for the current Event.
				$result3 = $smeConn->query($sql3);
				while ($row3 = $result3->fetch_assoc()) {
					$total += $row3['PayRate'] * $row3['LengthOfEvent'];
				}
				echo "</ol>";
				echo "<h5> Total amount   $" . $total . "</h5>";

				echo "</div>";
				echo "<br>";
			}
		} //end get if

		?>


	</main><!-- /.container -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			console.log("page loaded/");
			var clicked = document.getElementsByClassName('btn btn-primary');
			for (var i = 0; i < clicked.length; i++) {
				clicked[i].addEventListener('click', function() {
					console.log('Clicked');
					$(this).parent().find('ol').slideToggle();
					$(this).parent().find('h5').slideToggle();
				});
			}


		});
	</script>

	<?php include("includes/footer.php"); ?>


</html>
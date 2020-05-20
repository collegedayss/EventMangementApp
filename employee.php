<?php session_start(); ?>
<?php
if (!isset($_SESSION['userType'])) {
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
	</style>
</head>

<body>
	<header>
		<?php include("includes/nav.php"); ?>
	</header>
	<main role="main" class="container">

		<h3>Your Upcoming Schedule</h3>
		<?php include("includes/connect.php");
		if (isset($_SESSION['id'])) {

			//Get all events for user.
			$userid = $_SESSION['id'];
			$sql = "select events.EventID,events.LengthOfEvent,events.State,events.Zipcode, events.Name, events.DateofEvent, events.Address, eventstaff.EventID from eventstaff, events where eventstaff.PersonID=$userid AND eventstaff.EventID=events.EventID order by events.DateofEvent";
			$result = $smeConn->query($sql);
			echo "<Table class='table table-bordered table-dark'>";
			echo "<tr><th>Event</th><th>Length(hours)</th><th>Date</th><th>Location</th></tr>";


			//Get all vacations for current user.
			$sql2 = "SELECT * FROM vacations WHERE PersonID=$userid";
			$result2 = $smeConn->query($sql2);
			$vacations = array();

			if ($result2->num_rows > 0) {
				while ($row2 = $result2->fetch_assoc()) {
					array_push($vacations, $row2["Dates"]);
				}
			} else {
				array_push($vacations, "Preventing this array from being NULL");
			}


			while ($row = $result->fetch_assoc()) {
				//Don't display row if employee is on vacation
				if (in_array($row['DateofEvent'], $vacations)) {
				} else {
					echo "<tr>";
					echo "<td>" . $row['Name'] . "</td>";
					echo "<td >" . $row['LengthOfEvent'] . "</td>";
					echo "<td c>" . date("m/d/Y", strtotime($row['DateofEvent'])) . "</td>";
					echo "<td >" . "<a class='text-success' target='_blank' href='http://maps.google.com/?q=" . $row['Address'] . ", " . $row['State'] . "," . $row['Zipcode'] . "'>" . $row['Address'] . ", " . $row['State'] . "," . $row['Zipcode'] . "</a></td>";
					echo "</tr>";
				}
			}
			echo "</Table>";
		} //end get if

		?>
		<!-- Feild for requesting Vacation -->
		<aside>
			<div class="form-group">
				<label for="vacation_date"> Request vacation Date</label>
				<input type="date" class="form-control" id="vacation_date" aria-describedby="vacation_date" placeholder="">
			</div>
			<button id='request_vacation' type="submit" class="btn btn-primary">Submit</button>
			<div id='formError' class='text-danger' style='font-style:italic; font-size:.7em'></div>

		</aside>
		<br>
	</main>


	<?php include("includes/footer.php"); ?>
	<script>
		//ajax to send post request for vacation
		$(document).ready(function() {
			$("#request_vacation").click(function() {
				$.ajax({
					type: "POST",
					url: "scripts/vacationRequest.php",
					data: {
						vacation_date: $("#vacation_date").val(),
					},
					success: function(response) {


						if (response != 0) {
							// writes the response to the page.		
							console.log(response);
							alert('Vacation Request Added');

						} else
							$("#formError").text("Form Error.  Please Enter All required Feilds");
					},
					error: function() {
						$("#formError").text("Connection Error.  Please contact your system administrator.");

					}
				}); //end ajax
			});

		}); //end ready
	</script>

</html>
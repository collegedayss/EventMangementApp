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

</head>

<body>
    <header>
        <div class='container'>
            <?php include("includes/nav.php"); ?>
            <?php include("includes/table.php"); ?>
        </div>
        </main><!-- /.container -->
        <?php include("includes/footer.php"); ?>
        <script>
            function updatingElements() {

                //Getting Hours for each event
                var getAllHours = document.querySelectorAll("td[obj='hoursperevent']");
                var hours = [];
                for (let i = 0; i < getAllHours.length; i++) {
                    hours.push(parseFloat(getAllHours[i].getAttribute('eventlength')));
                }

                //Getting the Names of All events
                var getAllEvents = document.querySelectorAll("th[obj='EventNames']");
                var events = [];
                for (let i = 0; i < getAllEvents.length; i++) {
                    events.push(getAllEvents[i].textContent);
                }

                // Loop over all events.
                for (let k = 0; k < events.length; k++) {

                    //Get the wages for active events.
                    var tempstring = "td[ event='" + events[k] + "'][ status='active']";
                    var currentwages = document.querySelectorAll(tempstring);
                    var wages = []
                    for (let i = 0; i < currentwages.length; i++) {
                        wages.push(parseFloat(currentwages[i].getAttribute('wage')));
                    }
                    let temphours = hours[k];

                    // Multiply wages with housrs, add them and then Display them.
                    let total = 0;
                    wages.forEach(element => total += temphours * element);
                    tempstring = "td[ event='" + events[k] + "'][ obj='totalcostofevent']";
                    var costofEvent = document.querySelectorAll(tempstring);
                    costofEvent[0].textContent = "$" + total.toFixed(2);


                    //Getting amount of Activer servers.
                    tempstring = "td[ event='" + events[k] + "'][ status='active'][usertype='s']";
                    var countOfServers = document.querySelectorAll(tempstring).length;
                    tempstring = "td[ event='" + events[k] + "'][ obj='servers']";
                    var totalServers = document.querySelectorAll(tempstring);
                    totalServers[0].textContent = countOfServers;


                    //Getting amount of Activer Preparers.
                    tempstring = "td[ event='" + events[k] + "'][ status='active'][usertype='p']";
                    var countOfPreparers = document.querySelectorAll(tempstring).length;
                    tempstring = "td[ event='" + events[k] + "'][ obj='preparers']";
                    var totalPreparers = document.querySelectorAll(tempstring);
                    totalPreparers[0].textContent = countOfPreparers;

                    //Getting Total Staff
                    tempstring = "td[ event='" + events[k] + "'][ obj='Staff']";
                    var totalPreparers = document.querySelectorAll(tempstring);
                    totalPreparers[0].textContent = countOfPreparers + countOfServers;
                }
                //Get all User ids
                tempstring = "td[ obj='Users']";
                var totalUsers = document.querySelectorAll(tempstring);
                users = [];
                for (let i = 0; i < totalUsers.length; i++) {
                    users.push(totalUsers[i].getAttribute('person'));
                }

                //Display Number of Events for each user.
                for (let k = 0; k < users.length; k++) {
                    tempstring = "td[ person='" + users[k] + "'][ status='active']";
                    var eventsforworker = document.querySelectorAll(tempstring).length;
                    tempstring = "td[ person='" + users[k] + "'][ obj='totaleventsforworker']";
                    document.querySelectorAll(tempstring)[0].textContent = eventsforworker;
                }
            }
            $(document).ready(function() {
                updatingElements();
                $(document).on("click", "td[clickablebox='true']", function() {
                    var clicked = this;
                    $.ajax({
                        type: 'POST',
                        url: 'scripts/eventstaffmanagement.php',
                        data: {
                            eventID: clicked.getAttribute("eventid"),
                            PersonID: clicked.getAttribute("person"),
                            status: clicked.getAttribute("status")
                        },
                        success: function(response) {

                            //change color depending on previous color.
                            if (clicked.getAttribute("class") == "") {
                                clicked.setAttribute("class", " bg-success");
                                clicked.setAttribute("status", "active");
                                clicked.textContent = "1";
                                updatingElements();
                            } else {
                                clicked.setAttribute("class", "");
                                clicked.textContent = "";
                                clicked.setAttribute("status", "inactive");
                                updatingElements();
                            }
                        },
                        error: function() {
                            alert("Database is Currently Not Avalible");
                        }
                    });
                });
            });
        </script>

</html>
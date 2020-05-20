
            <?php

            //Creating Table.
            include("includes/connect.php");
            include("data/employeeClass.php");
            //Create Array of Values for events to be used by functions.
            if (isset($_SESSION['id'])) {
                $sql = "SELECT * FROM events";
                $result = $smeConn->query($sql);
                $EventNames = array();
                $EventDates = array();
                $EventIDs = array();
                $EventLength = array();

                if ($result->num_rows > 0) {
                    // output data of each row

                    while ($row = $result->fetch_assoc()) {
                        array_push($EventNames, $row["Name"]);
                        array_push($EventIDs, $row["EventID"]);
                        array_push($EventDates, $row["DateofEvent"]);
                        array_push($EventLength, $row["LengthOfEvent"]);
                    }
                    //Creating Table Column Names with the above arrays.
                    echo "<Table class='table table-bordered table-dark table-responsive'>";
                    echo "<tr><th></th><th></th><th></th>";
                    foreach ($EventNames as &$value) {
                        echo "<th obj='EventNames'>" . $value . "</th>";
                    }
                    unset($value);
                    echo "<th> TOTAL EVENTS</th>";
                    echo "</tr>";
                    echo "</tr><td></td><td></td><td></td>";
                    foreach ($EventLength as $index => &$value) {
                        echo "<td obj='hoursperevent' eventlength = '$value' eventName='" . $EventNames[$index] . "'>" . $value . " hours</td>";
                    }
                    unset($value);
                    echo "</tr><td></td><td></td><td></td>";
                    foreach ($EventDates as &$value) {
                        echo "<td>" . $value . "</td>";
                    }
                    unset($value);
                    echo "</tr>";
                    echo "<tr>";
                } else {
                    echo "0 results";
                }

                //Getting All user information for Servers.
                $sql = "SELECT * FROM users WHERE Usertype = 'server'";
                $result = $smeConn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        //Create Employee Object
                        $current_person = createEmployeeFromDB($row['PersonID']);

                        $current_values =  $current_person->getBSRow(
                            $EventNames,
                            $EventDates,
                            $EventIDs
                        );
                        echo $current_values;
                    }
                    //Total Employees per event Feild for Servers
                    echo EmployeesPerEvent('servers', $EventNames);
                }


                $sql = "SELECT * FROM users WHERE Usertype = 'preparer'";
                $result = $smeConn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $current_person = createEmployeeFromDB($row['PersonID']);
                        // $current_person->getEmployeeVacations();
                        // echo $current_person;
                        //echo $current_person->getEmployeeEvents()[0];
                        $current_values =  $current_person->getBSRow(
                            $EventNames,
                            $EventDates,
                            $EventIDs
                        );
                        echo $current_values;
                    }
                    //Get total Number of Preparers.

                }
                //Total Employees per event Feild for preparers
                echo EmployeesPerEvent('preparers', $EventNames);
                //Total Employees per event
                echo EmployeesPerEvent('Staff', $EventNames);
                //Total cost per event
                echo EmployeesPerEvent('Cost', $EventNames);
                echo "</Table>";

                //End table
            }




            ?>
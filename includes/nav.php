
 
 <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="index.php"><span>Magma Events</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav ml-auto">

	  
	  <?php
			//ADMIN CONDITIONAL NAV
			//by checking for $_SESSION['userType'] to be set first, we can utilize short circuiting
			//to avoid checking the second item and possibly creating an error or warning
			if(isset($_SESSION['userType']) && $_SESSION['userType']=="admin"){
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="adminschedule.php">Schedule</a>
      </li>	  
	  <?php
			}//end admin if
	  ?>
	  
	  <?php
			//ORGANIZER CONDITIONAL NAV
			if(isset($_SESSION['userType']) && $_SESSION['userType']=="admin"){
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="admin.php">Event Management Console</a>
      </li>
	  <?php
			}//end organizer if
	  ?>
	  
	  	  <?php
			//PARTICIPANT CONDITIONAL NAV
			if(isset($_SESSION['userType']) && ($_SESSION['userType']=="server" || $_SESSION['userType']=="preparer")){
	  ?>
	  <li class="nav-item">
        <a class="nav-link" href="employee.php">My Schedule</a>
      </li>
	  <?php
			}//end participant if
	  ?>
	  
	  
	  
	  
	  <!-- LOGIN ITEM -->
	  <li class="nav-item login">
		<?php
			if(isset($_SESSION['userType'])){
				echo "<li class='nav-link'>Welcome, ".$_SESSION['first']."</li>";
			    echo "<a class='nav-link' id='logout' href='#'>Sign Out</a>";
			}
			else{
		?>
				<a class="nav-link" href="#"  data-toggle="modal" data-target="#modalLoginForm"><i class='fa fa-user'></i>Sign In</a>
		<?php
			} //end else
		?>
	

      </li>

    </ul>

  </div>
</nav>
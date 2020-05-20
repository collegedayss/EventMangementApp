<?php session_start();?>
<?php include("../includes/connect.php"); ?>
<?php
	$username=$_POST['user'];
	$pass=$_POST['pass'];

	$sql="select * from users where UserName=\"$username\" and Password=\"$pass\" limit 1";
	$result=$smeConn->query($sql);
	
	//found user
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
		
		//set session variables
		$_SESSION['first']=$row['FirstName'];
		$_SESSION['id']=$row['PersonID'];
		$_SESSION['userType']=$row['Usertype'];

		echo $row['Usertype'];
	}
	//user not found
	else{
		echo 0;
	}
?>
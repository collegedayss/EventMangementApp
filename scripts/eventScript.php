<?php include("../includes/connect.php"); ?>
<?php include("../data/eventClass.php");  ?>
<?php
	if(isset($_POST['filter'])){
		$filter=$_POST['filter'];
	}
	//$filter="Prev";
	$today=date("Y-m-d");
	
	$sql="select * from events ";
	if($filter=="Prev"){
		$sql.=" where date<\"$today\"";
	}
	if($filter=="Up"){
		$sql.=" where date>=\"$today\"";
	}
	$sql.=" order by date, time";
	
	$result=$smeConn->query($sql);
	
	$output="";
	while($row=$result->fetch_assoc()){
		//$id=$row['id'];
		$event=createEventFromDB($row['id']);
		$output.=$event->getBSRow().":::";
	}
	echo $output;
?>
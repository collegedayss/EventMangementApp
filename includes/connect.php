<?php
	$smeConn=new mysqli("localhost", "root", "", "magma");
if(mysqli_connect_errno())
    echo "Connection failed: ".mysqli_connect_error();

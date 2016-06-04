<?php

	if(isset($_GET['text'])){

		include('include/connect.php');

		$messege = $_GET['text'];

		$query = "INSERT INTO raw_sms(";
		$query.= "text";
		$query.= ")VALUES(";
		$query.= $messege;
		$query.= ")";

		mysqli_query($connection, $query);
	}
?>

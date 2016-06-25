<?php
	include('include/connect.php');

	session_start();
	if(isset($_POST['save']) && 
		$_POST['mo_number']!="" && 
		$_POST['station_type']!="" && 
		$_POST['station_name']!="" && 
		$_POST['station_location'] != "")
	{

		$number = '+88'.$_POST['mo_number'];
		$st_name = $_POST['station_name'];
		$st_type = $_POST['station_type'];
		$st_loc = $_POST['station_location'];

		if($_POST['station_type']=='Rainfall'){

			$query = "INSERT INTO rain_station_detail (";
			$query.= "mobile_no, station_name,station_location";
			$query.= ")VALUES(";
			$query.= "'{$number}', '{$st_name}', '{$st_loc}'";
			$query.= ")";
			mysqli_query($connection, $query);
			$_SESSION['save_stat']='ok';
			header('Location: new_station.php');
		}

		else if($_POST['station_type']=='Water-Level'){
			$query = "INSERT INTO wl_station_detail (";
			$query.= "mobile_no, station_name, station_location";
			$query.= ")VALUES(";
			$query.= "'{$number}', '{$st_name}', {$st_loc}";
			$query.= ")";
			mysqli_query($connection, $query);
			$_SESSION['save_stat']='ok';
			header('Location: new_station.php');
		}	
	}
	else {
		$_SESSION['save_stat']='not-ok';
			header('Location: new_station.php');
	}
?>

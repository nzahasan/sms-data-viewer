<?php
	include('include/connect.php');

	if(isset($_POST['save'])){
		session_start();
		$number = '+88';
		$number.= $_POST['mo_number'];
		$st_name = $_POST['station_name'];
		$st_type = $_POST['station_type'];

		if($_POST['station_type']=='Rainfall'){

			$query = "INSERT INTO rain_station_detail (";
			$query.= "mobile_no, station_name";
			$query.= ")VALUES(";
			$query.= "'{$number}', '{$st_name}'";
			$query.= ")";
			mysqli_query($connection, $query);
			$_SESSION['save_stat']='ok';
			header('Location: new_station.php');
		}

		if($_POST['station_type']=='Water-Level'){
			$query = "INSERT INTO wl_station_detail (";
			$query.= "mobile_no, station_name";
			$query.= ")VALUES(";
			$query.= "'{$number}', '{$st_name}'";
			$query.= ")";
			mysqli_query($connection, $query);
			$_SESSION['save_stat']='ok';
			header('Location: new_station.php');
		}
		else {
			echo "station type error!";
		}

	}
?>

<?php


if(isset($_POST['rain_station']) && isset($_POST['start_date']) && isset($_POST['end_date']) ){

	$startD=$_POST['start_date']." 00:00:00";

	$endD = strtotime($_POST['end_date']." 00:00:00")+24*60*60;

	$endD = date('Y-m-d H:i:s',$endD);

	$file_name = 'filename=rain_'.$_POST['rain_station'].'_'.$_POST['start_date'].'_to_'.$_POST['end_date'].'.csv';

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment;'.$file_name);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('station_name', 'rainfall', 'time'));

	// fetch the data -> station specific daata
	include('include/connect.php');

	$query = "SELECT `station_name`, `rainfall`, `time` FROM `rain_data` WHERE station_name='{$_POST['rain_station']}' AND `time`>= '{$startD}'AND `time`<='{$endD}'";
	$result_rain = mysqli_query($connection,$query);

	// loop over the rows, outputting them
	while ($row = mysqli_fetch_assoc($result_rain)) {
		fputcsv($output, $row);
	}
}
?>

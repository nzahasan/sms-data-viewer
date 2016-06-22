<?php
//SENDER NO MUST EXIST IN DATABASE//
//$_POST['sender'] = Sender Phone no.
//$_POST['text'] = Massege Text

if(isset($_POST['sender'])&& isset($_POST['text'])){

	$mobile_no = $_POST['sender'];
	$massege = $_POST['text'];

	include('include/connect.php');

	//detect if rainfall//

	//format -> 'ST001 14.1'

	$rainCheck = mysqli_fetch_assoc(mysqli_query(
				$connection,
				"SELECT station_name FROM rain_station_detail WHERE mobile_no='{$mobile_no}'"
				));
	$wlCheck = mysqli_fetch_assoc(mysqli_query(
				$connection,
				"SELECT station_name FROM wl_station_detail WHERE mobile_no='{$mobile_no}'"
				));

	if(isset($rainCheck)){

		if(sizeof(explode(' ',$massege))==2){

			$rain_fall = explode(' ',$massege)[1];

			$query = "INSERT INTO rain_data(";
			$query.= "station_name, rainfall";
			$query.= ")VALUES(";
			$query.= "'{$rainCheck['station_name']}', '{$rain_fall}'";
			$query.= ")";

			echo $query;

			mysqli_query($connection, $query);
			
		}

	}

	else if(isset($wlCheck)){
		// 'ST003 17082015,09 1228,12 1229,15 1230,18 1231,06 1235'
		$wl =  explode(',',$massege);
		
		if(sizeof($wl)==6){
			
			$date = explode(' ', $wl[0]);
			$station = $wlCheck['station_name'];

			$DD = $date[1][0].$date[1][1];
			$MM = $date[1][2].$date[1][3];
			$YYYY= $date[1][4].$date[1][5].$date[1][6].$date[1][7];

			// timestamp format -> YYYY-MM-DD HH:MM:SS
			$d1=$YYYY."-".$MM."-".($DD-1)." "."09:00:00";
			$d2=$YYYY."-".$MM."-".($DD-1)." "."12:00:00";
			$d3=$YYYY."-".$MM."-".($DD-1)." "."15:00:00";
			$d4=$YYYY."-".$MM."-".($DD-1)." "."18:00:00";
			$d5=$YYYY."-".$MM."-".$DD." "."06:00:00";
			// echo $d1;
			$wl1 = (explode(' ', $wl[1])[1])/100;
			$wl2 = (explode(' ', $wl[2])[1])/100;
			$wl3 = (explode(' ', $wl[3])[1])/100;
			$wl4 = (explode(' ', $wl[4])[1])/100;
			$wl5 = (explode(' ', $wl[5])[1])/100;

			$query =  "INSERT INTO water_level (`station_name`, `water_level`, `time`) VALUES";
			$query.= "('{$station}', '{$wl1}', '{$d1}'),";
			$query.= "('{$station}', '{$wl2}', '{$d2}'),";
			$query.= "('{$station}', '{$wl3}', '{$d3}'),";
			$query.= "('{$station}', '{$wl4}', '{$d4}'),";
			$query.= "('{$station}', '{$wl5}', '{$d5}')";

			$result = mysqli_query($connection,$query);
			echo $query;
			
			

		}
		if(isset($result) && $result==true){
			$save_status = "Saved";
		}
		else{
			$save_status = "Not Saved";
		}

		$query_raw_sms = "INSERT INTO raw_sms (`sender`,`text`,`save_status`) VALUES('{$mobile_no}','{$massege}','{$save_status}')";
		mysqli_query($connection,$query_raw_sms);
		echo $query_raw_sms;
	}
	
}
?>

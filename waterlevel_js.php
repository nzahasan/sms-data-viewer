<script>

$(document).ready(function(){

	$('body').show();
	$('#wrapper,#show_down').slideDown(500);

	var chart = new CanvasJS.Chart("graph",
	{
		title:{ 
			text: "WL Data",
			fontSize: 25,
			fontFamily: "Courier",
			fontWeight: "Normal"
		},
		
		animationEnabled: true,
		
		axisY: { 
			title: "Water Level",
			labelFontFamily: "Courier",
			labelFontSize: 17
		},
		
		axisX: { 
			labelAngle: -60, 
			labelFontFamily: "Courier",
			labelFontSize: 17 
		},
		
		theme: "theme1",
		data: [
	
		<?php
		include ('include/connect.php');

			// if station is set plot single station
			if(isset($_POST['wl_station'])){
				$st_name = $_POST['wl_station'];

				echo "{ type: \"splineArea\",dataPoints: [\r\n";

				$query = "SELECT * FROM water_level WHERE station_name='{$st_name}'";
				
				if( $_POST['start_date']!="" && $_POST['end_date']!="" ){
					// formating date(mm/dd/yyyy) to UNIX time
					$startD=strtotime($_POST['start_date']);
					$endD = strtotime($_POST['end_date']) + 24*60*60;
					
					// converting back to YYYY-MM-DD 12:12:34 format
					$startD = date('Y-m-d H:i:s',$startD); 
					$endD = date('Y-m-d H:i:s',$endD);

					$query.= " AND `time`>='{$startD}' AND `time`<='{$endD}'";
				}

				$query.= "ORDER BY time ASC LIMIT 200";

				$result = mysqli_query($connection, $query);

				while($row=mysqli_fetch_assoc($result)){
					$date = explode(" ", $row['time']);

					$print = '{y: ';
					$print.= $row['water_level'];
					$print.= ',  label: "';
					$print.= $row['station_name'];
					$print.= '|';
					$print.= $date[0];
					$print.= '" },';

					echo $print."\r\n";
				}
				echo "]},\r\n"; //closing dataset

			}
			 
			else{
				// else plot multiple station
				// requires initialization for each dataset
				// { type: "splineArea", dataPoints: [ //
			
				$station_query = "SELECT station_name FROM wl_station_detail";
				$result_st = mysqli_query($connection,$station_query);
				
				while ($st = mysqli_fetch_assoc($result_st)) {
					
					echo "{ type: \"splineArea\",dataPoints: [\r\n";

					$query = "SELECT * FROM water_level WHERE station_name='{$st['station_name']}' ORDER BY time ASC LIMIT 200";
					$result = mysqli_query($connection,$query);
					
					while($row=mysqli_fetch_assoc($result)){
						$date = explode(" ", $row['time']);

						$print = '{y: ';
						$print.= $row['water_level'];
						$print.= ',  label: "';
						$print.= $row['station_name'];
						$print.= '|';
						$print.= $date[0];
						$print.= "\" },\r\n";

						echo $print;
					}
					echo "]},\r\n"; // closing dataset
				}

			}
		?> // end of data generation
	]});

	chart.render();

	// link style
	var wl_lnk = document.getElementById("wl_lnk").style;
	wl_lnk.fontWeight="bold"; wl_lnk.color="#FFE300";

	document.getElementById("show").onclick = function(){
		document.getElementById('menu_form').action="waterlevel.php";
		document.getElementById('menu_form').submit();
	}

	document.getElementById("down").onclick = function(){
		var start_date = document.getElementById("start_date").value;
		var end_date = document.getElementById("end_date").value;
		
		if(start_date=="" || start_date==undefined || start_date==null){
			alert("Start date is empty!"); return;
		}
		else if(end_date=="" || end_date==undefined || end_date==null){
			alert("End date is empty!"); return;
		}
		
		document.getElementById('menu_form').action="download_wl.php";
		document.getElementById('menu_form').submit();
	}

});

</script>
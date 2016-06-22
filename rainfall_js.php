<script>
$(document).ready(function() { 

  	//menubar slideing animation//
  	$('body').show();
	$('#wrapper,#show_down').slideDown(500);

	//rendering chart//
	var chart = new CanvasJS.Chart("graph",
	{
		title:{ 
			text: "Rainfall Data", 
			fontSize: 25, 
			fontFamily: "Courier",
			fontWeight: "Normal"
		}, 
		
		animationEnabled: true,
		
		axisY: { 
			title: "Rainfall",
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

		{
		type: "column",

		dataPoints:
		[
		//generating data points from mysql//
		<?php
			include 'include/connect.php';

			// check fist if rain_station is submitted
			if ( isset($_POST['rain_station']) ){
				$st_name = $_POST['rain_station'];
				$query = "SELECT * FROM rain_data WHERE station_name='{$st_name}'";

				// check if empty
				if( $_POST['start_date']!="" && $_POST['end_date']!="" ){
					
					// added 1 day because of 12-jan to 20-jan means
					// start of 12-jan and [end of 20-jan = start of 21-jan]
					// 12-jan @ 00:00 and 21-jan @ 00:00 
					
					// formating date to timestamp
					$startD=strtotime($_POST['start_date']);
					$endD = strtotime($_POST['end_date']) + 24*60*60;
					
					// converting back to YYYY-MM-DD 12:12:34 format
					$startD = date('Y-m-d H:i:s',$startD); 
					$endD = date('Y-m-d H:i:s',$endD);
					

					$query.= "AND `time`>='{$startD}' AND `time`<='{$endD}'";
					// echo $query;

				}
			}
			// if no post select all data from all station
			else{
				$query = "SELECT `station_name`,`rainfall`,`time` FROM `rain_data` ORDER BY `time` ASC LIMIT 50";
			}
			$result = mysqli_query($connection, $query);

			// {y: value, label: data_label}, 
			while($row=mysqli_fetch_assoc($result)){

				$date = explode(" ", $row['time']);

				$print = '{y: ';
				$print.= $row['rainfall'];
				$print.= ',  label: "';
				$print.= $row['station_name'];
				$print.= "|";
				$print.= $date[0];
				$print.= '" },';

				echo $print;
			}
		?> //end php
		]}]});

	
	chart.render(); //end chart
	//style change when page loaded//
	var rainLnk = document.getElementById("rain_lnk").style;
	rainLnk.fontWeight="bold";
	rainLnk.color="#FFE300";

	//onclick fire//
	document.getElementById("show").onclick = function(){
		document.getElementById('menu_form').action="rainfall.php";
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

		document.getElementById('menu_form').action="download_rain.php";
		document.getElementById('menu_form').submit();
	}

});//end of life

</script>
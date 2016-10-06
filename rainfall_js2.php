<?php
	
?>


<script>
$(document).ready(function() { 

  	// dont show body untill fully loaded && menubar slideing animation//
  	$('body').show();
	$('#wrapper,#show_down').slideDown(500);

	color_theme = [
		"rgba(162, 209, 207,0.8)",
		"rgba(200, 182, 49,0.8)",
		"rgba(109, 188, 235,0.8)",
		"rgba(82, 81, 78,0.8)",
		"rgba(79, 129, 188,0.8)",
		"rgba(160, 100, 161,0.8)",
		"rgba(247, 150, 71,0.8)",
		"rgba(54, 158, 173,0.8)",
		"rgba(194, 70, 66,0.8)",
		"rgba(127, 96, 132,0.8)",
		"rgba(134, 180, 2,0.8)"

	];

	color_theme_b = [
		"rgba(162, 209, 207,1)",
		"rgba(200, 182, 49,1)",
		"rgba(109, 188, 235,1)",
		"rgba(82, 81, 78,1)",
		"rgba(79, 129, 188,1)",
		"rgba(160, 100, 161,1)",
		"rgba(247, 150, 71,1)",
		"rgba(54, 158, 173,1)",
		"rgba(194, 70, 66,1)",
		"rgba(127, 96, 132,1)",
		"rgba(134, 180, 2,1)"

	];

	function getColors(n){
		var colors = [];
		while(n--){
			colors.push(color_theme[n%color_theme.length]);
		}
		return colors;
		
	}

	labels_x = [<?php ?>];
	values_y = [<?php ?>];
	chart_lbl = "<?php echo 'ST001' ?>";

	var data = {
        labels: labels_x,
        datasets: [
	        {
	            label: chart_lbl,
	            data: values_y,
	            backgroundColor: getColors(100),
	            borderWidth: 0
	        }
        ],
        option:{
        	responsive: true,
        }
    }; 
	
	Chart.defaults.global.defaultFontFamily = "Consolas";
	
	const drawArea = document.getElementById("graph");
	
	var rainChart = new Chart(drawArea,{
		type: 'bar',
		data: data,
	});


	//end chart

	// set dates @page load

	document.getElementById("start_date").value = firstDayOfThisMonth();
	document.getElementById("end_date").value = date2day();
	
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
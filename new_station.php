<?php
	include('include/header.php');
	session_start();
	if(isset($_SESSION['save_stat'])){
		if($_SESSION['save_stat']=='ok'){
			echo "<div id=\"alert\"><p>SAVED SUCCESSFULLY!</p></div>";
			unset($_SESSION['save_stat']);
		}
		else if($_SESSION['save_stat']=='not-ok'){
			echo "<div id=\"alert\"><p>ERROR!</p></div>";
			unset($_SESSION['save_stat']);
		}
	}
?>


<div id= "new_station_div">
	<form action = "station_save.php" method="post">
		
		<p>Mobile No(eg: 01711556677): </p>
		<input type="number" name = "mo_number" />
		<p>Station Name/ID: </p>
		<input type="text" name = "station_name" />
		<p>Station Location: </p>
		<input type="text" name = "station_location" />
		<p>Station Type(Rain/WL): </p>
		<select id="station_type" name = "station_type">
			<option value="Rainfall">Rainfall</option>
	  		<option value="Water-Level">Water Level</option>
		</select>
		<input id="save" type="submit" value="SAVE" name="save" />
	</form>
</div>

<script>
$(document).ready(function(){
	$('body').show();
	$('#menus').hide(0,function(){
		$(this).slideDown(500)
	});
	// bitching with link
	document.getElementById("new_station_lnk").style.color="#FFE300";
	document.getElementById("new_station_lnk").style.fontWeight="bold";
});
</script>

<?php include('include/footer.php'); ?>

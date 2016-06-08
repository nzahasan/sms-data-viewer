<?php include('include/header.php'); ?>

<table id="sms_log" cellspacing="0">

	<tr><th>ID</th><th>SMS</th><th>STATUS</th></tr>
	<?php
		include('include/connect.php');

		$query = "SELECT * FROM raw_sms";
		$result = mysqli_query($connection, $query);

		$print = "";
		while($row = mysqli_fetch_assoc($result)){
			if($row['save_status']==true){
				$print .= "<tr><td>".$row['id']."</td><td>".$row['text']."</td><td style=\"color:green\">Saved</td></tr>";
			}
			else if($row['save_status']==false){
				$print .= "<tr><td>".$row['id']."</td><td>".$row['text']."</td><td style=\"color:red\">Not Saved</td></tr>";
			}
		}

		echo $print;

	?>
	<tr><td>12</td><td>ST003 17082015,09 1228,12 1254,15 1230,18 1231,06 1235</td><td style="color:red">Not Saved</td></tr>
	<tr><td>12</td><td>ST003 18082015,09 1248,12 1254,15 1230,18 1231,06 1235</td><td style="color:green">Saved</td></tr>
	<tr><td>12</td><td>ST003 19082015,09 1226,12 1254,15 1230,18 1231,06 1235</td><td style="color:red">Not Saved</td></tr>
	<tr><td>12</td><td>ST003 20082015,09 1234,12 1254,15 1230,18 1231,06 1235</td><td style="color:green">Saved</td></tr>
</table>


<script>

$(document).ready(function(){
	$('body').show();
	$('#menus').hide(0,function(){
		$(this).slideDown(500)
	});

});

document.getElementById("log_lnk").style.color="#FFE300";
document.getElementById("log_lnk").style.fontWeight="bold";

</script>

<?php include('include/footer.php'); ?>
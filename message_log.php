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
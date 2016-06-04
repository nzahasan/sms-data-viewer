<?php
include('include/header.php');

session_start();

if(isset($_SESSION['manual_save'])){
    
    if($_SESSION['manual_save']=='ok'){
        echo "<div id=\"alert\"><p>SAVED SUCCESSFULLY!</p></div>";
        unset($_SESSION['manual_save']);
    }

}

?>

<div id="manual_entry">
    
    <form id="rainfall_form" action="manual_rain_save.php" method="post">
    	<table cellspacing="0">
    	<tr><td><p>RAINFALL</p></td></tr>
    	<tr>
        	<td><input id="rain" type="text" name="rainfall_text" value=""></td>
        	<td><input id="rain_save" type="button" name="rain_save" value="SAVE"></td>
    	</tr>
    	</table>
    </form>

    
    <form id="wl_form" action="manual_wl_save.php" method="post">
    	<table cellspacing="0"><tr>
    	<tr><td><p>WATERLEVEL</p></td></tr>
        <td> <input id="wl" type="text" name="wl_text" value=""> </td>
        <td> <input id="wl_save" type="button" name="wl_save" value="SAVE"> </td>
        </tr></table>
    </form>
</div>

<div id="format_txt">
    <p>[EXAPMPLES]</p>
    <p>[RAINFALL: ST001 11.2]</p>
    <p>[WATER LEVEL: ST001 01012000,09 1228,12 1229,15 1230,18 1231,06 1235]</p>
</div>

<script>
$(document).ready(function(){
	// animations
	$('body').show();
	$('#menus').hide(0,function(){
		$(this).slideDown(500)
	});

	// bitching links
	document.getElementById("manual_lnk").style.color="#FFE300";
	document.getElementById("manual_lnk").style.fontWeight="bold";

	// submitting if not empty
	document.getElementById("rain_save").onclick = function(){
		var data = document.getElementById("rain").value;
		if(data !=""){
 			document.getElementById("rainfall_form").submit();
		}
		else{
			alert('Empty Field!')
		}
	}

    document.getElementById("wl_save").onclick = function(){
		var data = document.getElementById("wl").value;
		if(data !=""){
			document.getElementById("wl_form").submit();
		}
		else{
			alert('Empty Field!')
		}
	}
});

</script>

<?php include('include/footer.php'); ?>

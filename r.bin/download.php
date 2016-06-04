<?php include('include/header.php'); ?>

<div id="download_div">
<form id="download_form" method="post">
    <p id="rain">Rainfall</p>
    <input id="rain_st" list="rain_stations" name="rain_station" />
    <p id="wl">Water Level</p>
    <input id="wl_st" list="wl_stations" name="wl_station" />

    <input id="dwn" type="button" value="Download" />
</form>
</div>

<datalist id="rain_stations">
    <?php
        include('include/connect.php');

        $res = mysqli_query($connection, "SELECT * FROM rain_station_detail");

        while($row=mysqli_fetch_assoc($res)){
            $print = '<option value="';
            $print.= $row['station_name'];
            $print.= '">';
            echo $print;
        }

    ?>
</datalist>

<datalist id="wl_stations">
    <?php
        include('include/connect.php');

        $res = mysqli_query($connection, "SELECT * FROM wl_station_detail");

        while($row=mysqli_fetch_assoc($res)){
            $print = '<option value="';
            $print.= $row['station_name'];
            $print.= '">';
            echo $print;
        }

    ?>
</datalist>

<script>

    window.onload = function(){
        $("#rain_st, #wl_st").hide();


    var rainBtn = document.getElementById('rain');
    var wlBtn = document.getElementById('wl');
    var form = document.getElementById('download_form');
    var dwn = document.getElementById('dwn');

    rainBtn.onclick = function(){
        $("#rain_st, #wl_st").hide();
        $("#rain_st").slideDown(400);
        form.action = "download_rain.php";
    }

    wlBtn.onclick = function(){
        $("#rain_st, #wl_st").hide();
        $("#wl_st").slideDown(400);
        form.action = "download_wl.php";
    }

    dwn.onclick = function(){
        form.submit();
    }

    }

</script

<?php include('include/footer.php'); ?>

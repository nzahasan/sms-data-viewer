<form id="menu_form" method="post">

        <table id="index_table" cellspacing="0">
            <tr>
                <td>Parameter</td>
                <td>Stations</td>
                <td><p>Start Date</td>
                <td>End Dtae</td>

            </tr>

            <tr>

                <td><input id="para" list="parameters" name="parameter" /></td>

                <td>
                    <input id="rain_st" list="rain_stations" name="rain_station" />
                    <input id="wl_st" list="wl_stations" name="wl_station" />
                </td>

                <td><input id="start_date" type="date"  /></td>

                <td><input id="end_date" type="date"  /></td>
            </tr>
        </table>

        <div id="show_down">
            <p id="show">Show</p><p id="down">Download</p>
        </div>



</form>

<div id="rain_graph">

</div>

<datalist id="parameters">
    <option value="Rainfall" />
    <option Value="Water Level" />
</datalist>

<datalist id="rain_stations">
    <?php
        include('include/connect.php');

        $resource = mysqli_query($connection, "SELECT * FROM rain_station_detail");

        while($row = mysqli_fetch_assoc($resource)){

            $print = '<option value="';
            $print.= $row['station_name'];
            $print.= '"/>';

            echo $print;
        }

    ?>
</datalist>

<datalist id="wl_stations">
    <?php
        include('include/connect.php');

        $resource = mysqli_query($connection, "SELECT station_name FROM water_level GROUP BY station_name");

        while($row = mysqli_fetch_assoc($resource)){

            $print = '<option value="';
            $print.= $row['station_name'];
            $print.= '"/>';

            echo $print;
        }

    ?>
</datalist>

<script>


    $("#para").on("change", function(){
        if($(this).val()=="Rainfall"){
            $("#rain_st, #wl_st").hide();
            $("#rain_st").show(300);

        }

        else if($(this).val()=="Water Level"){
            $("#rain_st, #wl_st").hide();
            $("#wl_st").show(300);
        }
    });


    $("#show").on("click", function(){

        var dataType=$("#para").val();
        var rain_st =$("#rain_st").val();
        var wl_st =$("#wl_st").val();

        var form = document.getElementById('menu_form');

        var start_date = $("#start_date").val();
        var start_date = $("#end_date").val();

        if(dataType=="Rainfall"){
            form.action = "rainfall.php";
            form.submit();

        }

        else if(dataType=="Water Level"){
            form.action = "waterlevel.php";
            form.submit();
        }

    });



</script>

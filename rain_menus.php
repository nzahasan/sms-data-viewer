<form id="menu_form" method="post">
        <div id="wrapper">
        <table id="index_table" cellspacing="0">

            <tr>
                <td>STATIONS: <select id="rain_st" name="rain_station">
                    <?php
                        include('include/connect.php');

                        $resource = mysqli_query($connection, "SELECT * FROM rain_station_detail");

                        while($row = mysqli_fetch_assoc($resource)){

                            $print = '<option value="';
                            $print.= $row['station_name'];
                            $print.= '">';
                            $print.= $row['station_name'];
                            $print.= '</option>';

                            echo $print;
                        }
                    ?>
                </select></td>
                <td>START DATE: <input id="start_date" class="auto-kal" autocomplete="off" type="text" name="start_date"></td>
                <td>END DATE: <input id="end_date" class="auto-kal" autocomplete="off" type="text" name="end_date"></td>

            </tr>

        </table>
        </div>

        <div id="show_down">
            <a id="show" href="javascript: void(0)">SHOW</a><a id="down" href="javascript: void(0)">DOWNLOAD</a>
        </div>

</form>

<!-- GRAPH div -->
<div id="graph"> </div>





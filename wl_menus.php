<form id="menu_form" method="post">

        <div id="wrapper">
        <table id="index_table" cellspacing="0">

            <tr>
                <td>
                    STATIONS: <select id="wl_st" name="wl_station">
                        <?php
                            include('include/connect.php');

                            $resource = mysqli_query($connection, "SELECT * FROM wl_station_detail");

                            while($row = mysqli_fetch_assoc($resource)){

                                $print = '<option value="';
                                $print.= $row['station_name'];
                                $print.= '">';
                                $print.= $row['station_location'].'('.$row['station_name'].')';;
                                $print.= '</option>';

                                echo $print;
                            }

                        ?>
                    </select>
                </td>

                <td>START DATE: <input id="start_date" class="auto-kal" autocomplete="off" type="text" name="start_date" readonly></td>

                <td>END DATE: <input id="end_date" class="auto-kal" autocomplete="off" type="text" name="end_date" readonly></td>
            </tr>
        </table>
        </div>

        <div id="show_down">
            <a id="show" href="#">SHOW</a><a id="down" href="#">DOWNLOAD</a>
        </div>



</form>

<div id="graph"> </div>
<?php
include('include/connect.php');
session_start();
//ST001 01012016,09 1228,12 1229,15 1230,18 1231,06 1235
if (isset($_POST['wl_text'])) {
    $massege = $_POST['wl_text'];
    $exp = explode(",",$massege);
    if(sizeof($exp)==6){
        $wl =  explode(',',$massege);
        $head = explode(' ', $wl[0]);
        $station = $head[0];

        $DD = $head[1][0].$head[1][1];
        $MM = $head[1][2].$head[1][3];
        $YYYY= $head[1][4].$head[1][5].$head[1][6].$head[1][7];

        $d1=$YYYY."-".$MM."-".($DD-1)." "."09:00:00";
        $d2=$YYYY."-".$MM."-".($DD-1)." "."12:00:00";
        $d3=$YYYY."-".$MM."-".($DD-1)." "."15:00:00";
        $d4=$YYYY."-".$MM."-".($DD-1)." "."18:00:00";
        $d5=$YYYY."-".$MM."-".$DD." "."06:00:00";
        // echo $d1;
        $wl1 = (explode(' ', $wl[1])[1])/100;
        $wl2 = (explode(' ', $wl[2])[1])/100;
        $wl3 = (explode(' ', $wl[3])[1])/100;
        $wl4 = (explode(' ', $wl[4])[1])/100;
        $wl5 = (explode(' ', $wl[5])[1])/100;

        $query =  "INSERT INTO water_level (`station_name`, `water_level`, `time`) VALUES";
        $query.= "('{$station}', '{$wl1}', '{$d1}'),";
        $query.= "('{$station}', '{$wl2}', '{$d2}'),";
        $query.= "('{$station}', '{$wl3}', '{$d3}'),";
        $query.= "('{$station}', '{$wl4}', '{$d4}'),";
        $query.= "('{$station}', '{$wl5}', '{$d5}')";

        mysqli_query($connection,$query);
        $_SESSION['manual_save']='ok';
        // echo $query;
    }

}

header('Location: manual_entry.php');

?>

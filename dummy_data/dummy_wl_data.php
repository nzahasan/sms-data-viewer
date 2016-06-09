<?php
    include('../include/connect.php');
    $query = "INSERT INTO `water_level` (station_name,water_level) VALUES ('ST002','0')";

    for($i=2; $i<=200; $i+=0.5){
        $x=sin($i);
        $query.= ", ('ST002','{$x}')";
    }

    $query .= ";";

    // echo $query;
    mysqli_query($connection,$query);
    echo "DONE!";
?>

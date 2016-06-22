<?php
    include('../include/connect.php');
    $query = "INSERT INTO `water_level` (station_name,water_level) VALUES ('ST001','0')";

    for($i=4; $i<=200; $i+=1){
        $x=$i;
        $query.= ", ('ST001','{$x}')";
    }

    $query .= ";";

    // echo $query;
    mysqli_query($connection,$query);
    echo "DONE!";
?>

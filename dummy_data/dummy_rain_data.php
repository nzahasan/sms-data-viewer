<?php
    include('../include/connect.php');
    $query = "INSERT INTO `rain_data` (station_name,rainfall) VALUES ('ST-001','0')";

    for($i=2; $i<=200; $i++){
        $query.= ", ('ST-1','{$i}')";
    }

    $query .= ";";

    mysqli_query($connection,$query);

?>

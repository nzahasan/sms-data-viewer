<?php
include('include/connect.php');
session_start();

if (isset($_POST['rainfall_text'])) {
    $massege = $_POST['rainfall_text'];
    $exp = explode(" ",$massege);
    if(sizeof($exp)==2){

        $query = "INSERT INTO rain_data(station_name, rainfall)VALUES('{$exp[0]}','{$exp[1]}')";
        mysqli_query($connection,$query);
        $_SESSION['manual_save']='ok';
    }

}

header('Location: manual_entry.php');

?>

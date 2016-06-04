<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sms_dbase";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$connection){
	header('Location: ../error/')
}

//setting charecterset to utf8 unicode for supporting BANGLA AND OTHER//
mysqli_query($connection,'SET CHARACTER SET utf8');

mysqli_query($connection,"SET SESSION collation_connection ='utf8_general_ci'");

?>

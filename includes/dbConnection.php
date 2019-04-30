<?php

$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "escort";

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if(!$conn){
    echo 'Failed to connect';
} else {
    //by un-commenting this would see some jinx (changes of component placements) in the pages
//    echo 'Success';
}


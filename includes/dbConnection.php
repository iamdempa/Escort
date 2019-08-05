<?php

$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "escort";

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if(!$conn){
    echo 'Failed to connect';
} else {
//    echo 'Success';
}


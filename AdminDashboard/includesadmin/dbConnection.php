<?php

$dbServerName = "localhost";
$dbUserName = "escortpe_localhost";
$dbPassword = "Escort@1995";
$dbName = "escortpe_escort";

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if(!$conn){
    echo 'Failed to connect';
} else {
//==    echo 'Success';
}


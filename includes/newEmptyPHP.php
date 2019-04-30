<?php
include_once './dbConnection.php';

$imageNO = $_POST['imgno'];

$sql = "UPDATE user SET userFName='$imageNO' WHERE  userid=1;";
mysqli_query($conn, $sql);

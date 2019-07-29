<?php

include_once './dbConnection.php';
$adId = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "adId"));
$selectedUserID = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "selectedUserID"));
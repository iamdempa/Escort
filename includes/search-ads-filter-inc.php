<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

require './dbConnection.php';

$service = mysqli_real_escape_string($conn, $_POST['service']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$keyword = mysqli_real_escape_string($conn, $_POST['keyword']);

if (isset($_POST['submit'])) {

    header("Location: ../search-ads.php?keyword=$keyword&service=$service&country=$country");
    exit();
} else {
    echo 'error';
}

<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['username'])) {
    
} else {
    header("Location: ../index.php");
}

require './dbConnection.php';

$keyword = mysqli_real_escape_string($conn, $_POST['keyword']);

header("Location: ../search-ads.php?keyword=$keyword");

ob_end_flush();






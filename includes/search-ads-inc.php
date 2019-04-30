<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require './dbConnection.php';

if (isset($_POST['submit'])) {
    
}else{
    header("Location: ../index.php");
    exit();
}




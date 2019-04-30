<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: ../user-profile.php");
}else{
    header("Location: ../index.php");
}
?>

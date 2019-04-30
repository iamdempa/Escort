<?php

session_start();
//session_destroy();


$helper = array_keys($_SESSION);
foreach ($helper as $key) {
    unset($_SESSION[$key]);
}

header("Location: ../index.php");


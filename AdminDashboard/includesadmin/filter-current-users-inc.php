<?php

include './dbConnection.php';

$status = mysqli_real_escape_string($conn, $_POST['status']);
echo $status;

if ($status == "no") {
    header("Location: ../users.php?isUserBanned=no");
    exit();
} else if($status == "yes"){
    header("Location: ../users.php?isUserBanned=yes");
    exit();
}else if($status == "all"){ //all
    header("Location: ../users.php?allCurrentUsers=yes");
    exit();
}else{
    echo 'error in  filter-current-users-inc.php';
}



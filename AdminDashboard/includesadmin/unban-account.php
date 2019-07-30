<?php

include_once './dbConnection.php';

$selectedUserID = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "selectedUserID"));

$sql = "UPDATE user SET isBanned='no' WHERE userid=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo 'Error preparing';
} else {
    mysqli_stmt_bind_param($stmt, "i", $selectedUserID);
    mysqli_stmt_execute($stmt);

//    echo 'Updated User';

    $sql = "UPDATE login SET isBanned='no' WHERE userid=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        
    } else {
        mysqli_stmt_bind_param($stmt, "i", $selectedUserID);
        mysqli_stmt_execute($stmt);

//        echo 'Updated Login';

        $sql = "UPDATE ad SET adstatus='success' WHERE userid=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            
        } else {
            mysqli_stmt_bind_param($stmt, "i", $selectedUserID);
            mysqli_stmt_execute($stmt);

//            echo 'Updated ad';
        }
    }
}
<?php

include_once './dbConnection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userId = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "userId"));
$adId = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "adId"));
$imgeName = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "imgeName"));



if (isset($userId) && isset($adId) && isset($imgeName)) {


    $sql = "SELECT * FROM adimage WHERE adimageno=? AND adid=? AND userid=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error!";
    } else {
        mysqli_stmt_bind_param($stmt, "sii", $imgeName, $adId, $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $ImageId = $row['adimageid'];
        }


        $fileName = "../uploads/ad/adImage-" . $ImageId . "-" . $adId . "-" . $userId . "*";
        $fileInfo = glob($fileName);

        $fileExt = explode(".", $fileInfo[0]);
        $fileActualExt = $fileExt[1];

        $file = "../uploads/ad/adImage-" . $ImageId . "-" . $adId . "-" . $userId . "." . $fileActualExt;

        array_map('unlink', glob($fileName));

//        if (!unlink($file)) {
//            echo 'not deleted';
//        } else {
//            echo 'deleted';
//        }

        $sql = "UPDATE adimage SET adimagestatus=1 WHERE adimageid='$ImageId';";
        mysqli_query($conn, $sql);
        echo 'deleted';
        exit();
    }
}



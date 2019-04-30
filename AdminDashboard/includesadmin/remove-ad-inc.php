<?php

include_once './dbConnection.php';
$adId = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "adId"));
$userId = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "userId"));




$sql = "DELETE FROM ad WHERE adid=?";

$stmt = mysqli_stmt_init($conn);



if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo 'error';
} else {
//    echo 'ok';
    mysqli_stmt_bind_param($stmt, "i", $adId);
    mysqli_stmt_execute($stmt);


    $sql = "SELECT * FROM adimage WHERE adid='$adId' AND userid='$userId';"; //deleting images
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
//        echo 'ela';
        while ($row = mysqli_fetch_assoc($result)) {
            
            $ImageId = $row['adimageid'];
            $fileName = "../../uploads/ad/adImage-" . $ImageId . "-" . $adId . "-" . $userId . "*";
            $fileInfo = glob($fileName);

            $fileExt = explode(".", $fileInfo[0]);
            $fileActualExt = $fileExt[1];

            $file = "../uploads/ad/adImage-" . $ImageId . "-" . $adId . "-" . $userId . "." . $fileActualExt;

            array_map('unlink', glob($fileName));
//            echo 'deleted photos';
        }
    } else {
        echo 'fault';
    }

    $sql = "DELETE FROM adimage WHERE adid='$adId'";
    mysqli_query($conn, $sql);
//    echo 'done';
}

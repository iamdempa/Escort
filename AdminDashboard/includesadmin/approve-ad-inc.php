<?php

include './dbConnection.php';

$adId = filter_input(INPUT_POST, 'adId');
$userId = filter_input(INPUT_POST, 'userId');

echo $adId . "-" . $userId;

$sql = "UPDATE ad SET adstatus='success' WHERE adid=? AND userid=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo '$stmt prepare error';
} else {
    mysqli_stmt_bind_param($stmt, "ii", $adId, $userId);
    mysqli_stmt_execute($stmt);
    echo 'updated';
}


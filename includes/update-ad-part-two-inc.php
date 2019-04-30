<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

include_once './dbConnection.php';

if (isset($_POST['submit'])) {


    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $office = mysqli_real_escape_string($conn, $_POST['office']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);

    if ($_SESSION['editAdId']) {
        $adId = $_SESSION['editAdId'];
    } else {
        $adId = $_SESSION['adid'];
    }

    $userId = $_SESSION['userid'];


    if (!empty($_SESSION['decline']) || isset($_SESSION['decline'])) {
        $AdStatus = "declined";
        echo 'decline';
    } else {
        $AdStatus = "pending";
    }

    $adCompletion = 2;
    $arr = array($country, $mobile, $office, $email, $street, $city, $state, $adCompletion, $AdStatus);
    $arrColumns = array("countryid", "adcontactmobile", "adcontactoffice", "adcontactemail", "adstreet", "adcity", "adstate", "adcompletion", "adstatus");

    if (!empty($email) || !empty($mobile) || !empty($office)) {
        //check if what fields are empty
        for ($index1 = 0; $index1 < count($arr); $index1++) {

            if (!empty($arr[$index1])) {   //if not empty   
                echo 'UPDATED-';
                $sql = "UPDATE ad SET " . $arrColumns[$index1] . "=? WHERE adid=?;";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'error';
                } else {
//                    echo 'hi';
                    $sql = "SHOW FIELDS FROM ad;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $dataType = substr($row['Type'], 0, 7);
                            if ($dataType == "int(20)") {
                                mysqli_stmt_bind_param($stmt, "ii", $arr[$index1], $adId);
                                mysqli_stmt_execute($stmt);
                            } else {
                                mysqli_stmt_bind_param($stmt, "si", $arr[$index1], $adId);
                                mysqli_stmt_execute($stmt);
                            }
                        }
                        if ((isset($_SESSION['admin']) && !isset($_SESSION['decline'])) || !empty($_SESSION['admin']) && empty($_SESSION['decline'])) {
                            header("Location: ../AdminDashboard/new-ads.php?addUpdateSuccess=newAds");
                        } else if (isset($_SESSION['admin']) && !empty($_SESSION['admin']) && isset($_SESSION['decline'])) {
                            header("Location: ../AdminDashboard/declined-ads.php?addUpdateSuccess=declinedAds");
                        } else {
                            header("Location: ../user-profile.php?addSuccess");
                        }
                    } else {
                        echo 'no data in ad - FIELDS';
                    }
                }
            } else {
                echo 'FAILED-';
            }
        }

        //upload photos
    } else {
        header("Location: ../post-ad-2.php?emoerror");
        exit();
    }
} else {
    header("Location: ../post-ad-2.php");
    exit();
}
?>

<?php



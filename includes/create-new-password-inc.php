<?php

if (isset($_POST['submit'])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $newPassword = $_POST["newPassword"];
    $confirmNewPassword = $_POST["confirmNewPassword"];

    if (empty($newPassword) || empty($confirmNewPassword)) {
        header("Location: ../create-new-password.php?newpw=empty");
        exit();
    } else if ($newPassword != $confirmNewPassword) {
        header("Location: ../create-new-password.php?newpw=pwnotsame");
        exit();
    }

    $currentDate = date("U");
    require './dbConnection.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'error 1';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo 'error 2';
            exit();
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo 'error 3';
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM login WHERE useremail=?;";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'error 4';
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo 'error 5';
                        exit();
                    } else {
                        $sql = "UPDATE login SET userpassword=? WHERE useremail=?";

                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo 'error 5';
                            exit();
                        } else {

                            $newPwdHash = password_hash($newPassword, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            header("Location: ../sign-in.php?reset=success");
                            exit();
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../sign-in.php");
    exit();
}
    
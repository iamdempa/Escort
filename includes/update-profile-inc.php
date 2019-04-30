<?php

session_start();
$userId = $_SESSION['userid'];
echo 'User id ' . $userId;

if (isset($_POST['submit'])) {

    $_SESSION['submitClicked'] = "submitClicked";
    include_once './dbConnection.php';

    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
//    $firstName = "Jananath";
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $street = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
//    $city = "Kurunegala";
    $state = mysqli_real_escape_string($conn, $_POST['state']);
//    $state = "Florida";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    //error handling
    if (!empty($email) || !empty($username) || !empty($password) || !empty($confirmPassword)) { //if not empty
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) { //if invalid
            header("Location: ../user-profile.php?invalid=email");
            exit();
        } else { //if valid
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { //invalid username
                header("Location: ../user-profile.php?invalid=username");
                exit();
            } else {

                if ($password != $confirmPassword) {
                    header("Location: ../user-profile.php?invalid=passwordMisMatch");
                    exit();
                } else {
                    $sql = "SELECT * FROM login WHERE useremail='$email'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['userid'] != $userId) {
                                header("Location: ../user-profile.php?invalid=emailExists");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }


    if (!empty($password)) { //if not empty
        //hashing the password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $arr = array($email, $username, $hashPassword);
    } else {
        $arr = array($email, $username, $password);
    }

    $arrayColumnNames = array("useremail", "username", "userpassword");
    $arrayColumnNamesTwo = array("userEmail", "userUsername", "userPassword");

    $arrayColumnNamesTwoOthers = array("userFName", "userLName", "userCompany", "userWebsite", "userStreet", "userCity", "userState");
    $arrayColumnNamesTwoOthersValues = array($firstName, $lastName, $company, $website, $street, $city, $state);

    //check if username, email or password is empty
    for ($index = 0; $index < count($arr); $index++) {

        if (!empty($arr[$index])) {//if not empty
            echo '-A-';
            $sql = "UPDATE login SET " . $arrayColumnNames[$index] . "=? WHERE userid=?;";


            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
//                echo ' error 1';
            } else {
                mysqli_stmt_bind_param($stmt, "si", $arr[$index], $userId);
                mysqli_stmt_execute($stmt);

                //Start the session

                $_SESSION['edit'] = 'edit';
            }


            $sqlUser = "UPDATE user SET " . $arrayColumnNamesTwo[$index] . "=? WHERE userid=?;";

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlUser)) {
//                echo ' error 1';
            } else {
                mysqli_stmt_bind_param($stmt, "si", $arr[$index], $userId);
                mysqli_stmt_execute($stmt);

                //Start the session

                $_SESSION['edit'] = 'edit';
            }
        } else { //if they are empty
            for ($index1 = 0; $index1 < count($arrayColumnNamesTwoOthers); $index1++) {

                if (!empty($arrayColumnNamesTwoOthersValues[$index1])) { //if not empty
                    $sqlUser2 = "UPDATE user SET " . $arrayColumnNamesTwoOthers[$index1] . "=? WHERE userid=?;";

                    $stmt2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt2, $sqlUser2)) {
                        echo ' error 1';
                    } else {
                        echo 'updated';
                        mysqli_stmt_bind_param($stmt2, "si", $arrayColumnNamesTwoOthersValues[$index1], $userId);
                        mysqli_stmt_execute($stmt2);

                        //Start the session
                        $_SESSION['edit'] = 'edit';
                    }
                } else { //if empty
                    $sqlUser2 = "UPDATE user SET " . $arrayColumnNamesTwoOthers[$index1] . "=? WHERE userid=?;";

                    $stmt2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt2, $sqlUser2)) {
                        echo ' error 1';
                    } else {
                        echo 'updated';
                        mysqli_stmt_bind_param($stmt2, "si", $arrayColumnNamesTwoOthersValues[$index1], $userId);
                        mysqli_stmt_execute($stmt2);

                        //Start the session
                        $_SESSION['edit'] = 'edit';
                    }
                }
            }
        }
    }

    if (!empty($email) || !empty($username) || !empty($password)) { //if not empty
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } else {
            session_destroy();
        }

        header("Location: ../sign-in.php?update=SuccessLoginAgain");
        exit();
    } else { //if empty    
        //Start the session
        $_SESSION['edit'] = 'edit';

//        header("Location: ../user-profile.php?update=Success&banuka=jananath");
        //exit();
    }
} else {
    header("Location: ../user-profile.php?update=Error");
    exit();
}



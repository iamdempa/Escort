<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Users - Escort Admin Panel</title>

        <?php
//        include './includesadmin/javascript-sheets.php';
        include '../dbConnection.php';
        ?>

    </head>
    <body>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['selectedUserID']);
        
        include './includesadmin/header-admin.php';

        
        ?>


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="users.php"><i class="fa fa-chevron-left"> Users</i></a></li>
                <li class="breadcrumb-item active" aria-current="page">View Users</li>
            </ol>
        </nav>


        <?php
        $sql = "SELECT * FROM user WHERE userid=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "error";
        } else {
            $userid = $_GET['userid'];
            $_SESSION['selectedUserID'] = $userid;
            mysqli_stmt_bind_param($stmt, "i", $userid);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);



            if ($resultCheck < 1) {
                echo 'no results';
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <div class="container" style="width: 70%">
                        <?php
                        if (isset($_GET['isBanned']) || !empty($_GET['isBanned'])) {
                            if ($_GET['isBanned'] == "no") {
                                ?>
                                <h5 class='mb-3 text-center'><?php echo $row['userUsername'] ?> - User Details</h5>
                            <?php } else if ($_GET['isBanned'] == "yes") {
                                ?>
                                <h5 class='mb-3 text-center' style="color: #f54272"><?php echo $row['userUsername'] ?> - This user account is banned</h5>
                                <?php
                            }
                        }
                        ?>

                        <hr>
                        <form role='form' action='includesadmin/update-user-profile-inc.php' method='POST' enctype='multipart/form-data'>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>First name</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' value='<?php echo $row['userFName']; ?>' name='firstName'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Last name</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' value='<?php echo $row['userLName'] ?>' name='lastName'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Email</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='email' value='<?php echo $row['userEmail'] ?>' name='email'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Company</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' value='<?php echo $row['userCompany'] ?>' name='company'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Website</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' value='<?php echo $row['userWebsite'] ?>' name='website'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Address</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' value='<?php echo $row['userStreet'] ?>' name='address' placeholder='Street'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'></label>
                                <div class='col-lg-6'>
                                    <input class='form-control' type='text' value='<?php echo $row['userCity'] ?>' name='city' placeholder='City'>
                                </div>
                                <div class='col-lg-3'>
                                    <input class='form-control' type='text' value='<?php echo $row['userState'] ?>' name='state' placeholder='State'>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Username</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' value='<?php echo $row['userUsername'] ?>' name='username'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Password</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='password' name='password'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Confirm password</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='password' name='confirmPassword'>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET['isBanned']) || !empty($_GET['isBanned'])) {
                                if ($_GET['isBanned'] == "no") {
                                    ?>
                                    <div class='form-group row'>
                                        <label class='col-lg-3 col-form-label form-control-label'></label>
                                        <div class='col-lg-9'>
                                            <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                            <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>

                                            <button type='button' class='btn btn-warning' onclick="banAccount(this)" selecteduserid="<?php echo $_SESSION['selectedUserID']; ?>" value='Ban Account'><i class = 'fa fa-ban'></i> Ban Account</button>
                                            <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                                        </div>
                                    </div>
                                <?php } else if ($_GET['isBanned'] == "yes") {
                                    ?>
                                    <div class='form-group row'>
                                        <label class='col-lg-3 col-form-label form-control-label'></label>
                                        <div class='col-lg-9'>                                                                                        
                                            <button type='button' class='btn btn-success' onclick="unBanAccount(this)" selecteduserid="<?php echo $_SESSION['selectedUserID']; ?>" value='Ban Account'><i class = 'fa fa-unlock'></i> Unban Account</button>
                                            <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'></label>
                                    <div class='col-lg-9'>
                                        <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                        <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>

                                        <button type='button' class='btn btn-warning' onclick="banAccount(this)" selecteduserid="<?php echo $_SESSION['selectedUserID']; ?>" value='Ban Account'><i class = 'fa fa-ban'></i> Ban Account</button>
                                        <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>


                        </form>
                    </div>


                    <?php
                    echo '<script>document.title = "' . $row['userUsername'] . ' - Escort Personal Adz"</script>';
                }
            }
        }
        ?>
        
        <script type="text/javascript">
            function unBanAccount(selectedUserId) {
                $.confirm({
                    title: 'Unban Account!',
                    content: 'Confirm Unban Account?',
                    theme: 'material', // 'material', 'bootstrap'
                    buttons: {
                        Approve: function () {
                            $.alert('Unbanned!');
                            unBan(selectedUserId);
                            setTimeout(function () {
                                window.location.href = "users.php";
                            }, 2500);
                        },
                        cancel: function () {

                        }
                    }
                });
            }

            function unBan(selectedUserId) {
                var selectedUserID = $(selectedUserId).attr('selecteduserid');
                $.ajax({
                    url: 'includesadmin/unban-account.php',
                    dataType: 'text', // what to expect back from the PHP script, if anything                        
                    data: {
                        selectedUserID: selectedUserID
                    },
                    type: 'post',
                    success: function (php_script_response) {
//                        alert(php_script_response); // display response from the PHP script, if any
                    }
                });
            }
        </script>

        <script type="text/javascript">
            function banAccount(selectedUserId) {
                $.confirm({
                    title: 'Ban Account!',
                    content: 'Confirm Ban Account?',
                    theme: 'material', // 'material', 'bootstrap'
                    buttons: {
                        Approve: function () {
                            $.alert('Banned!');
                            ban(selectedUserId);
                            setTimeout(function () {
                                window.location.href = "users.php";
                            }, 2500);
                        },
                        cancel: function () {

                        }
                    }
                });
            }

            function ban(selectedUserId) {
                var selectedUserID = $(selectedUserId).attr('selecteduserid');
                $.ajax({
                    url: 'includesadmin/ban-account.php',
                    dataType: 'text', // what to expect back from the PHP script, if anything                        
                    data: {
                        selectedUserID: selectedUserID
                    },
                    type: 'post',
                    success: function (php_script_response) {
//                        alert(php_script_response); // display response from the PHP script, if any
                    }
                });
            }
        </script>





        <?php
        include './includesadmin/header-admin2.php';
        ?>

        <?php
        include './includesadmin/javascript-sheets.php';
        ?>
    </body>
</html>

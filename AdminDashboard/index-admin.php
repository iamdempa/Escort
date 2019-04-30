<?php
include_once './includesadmin/dbConnection.php';

$sql = "SELECT * FROM user;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$userCount = 0;
if ($resultCheck < 1) {
    echo 'No Users';
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $userCount++;
    }
}

$sqlAd = "SELECT * FROM ad WHERE adstatus='success';";
$resultAd = mysqli_query($conn, $sqlAd);
$resultCheckAd = mysqli_num_rows($resultAd);
$adCount = 0;
if ($resultCheckAd < 1) {
    echo 'No Ads';
} else {
    while ($row = mysqli_fetch_assoc($resultAd)) {
        $adCount++;
    }
}

$sqlService = "SELECT * FROM service;";
$resultService = mysqli_query($conn, $sqlService);
$resultCheckService = mysqli_num_rows($resultService);
$serviceCount = 0;
if ($resultCheckService < 1) {
    echo 'No Ads';
} else {
    while ($row = mysqli_fetch_assoc($resultService)) {
        $serviceCount++;
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Escort - Admin Panel</title>


        <meta name="viewport" content="width=device-width, initial-scale=1">


        <?php include './includesadmin/stylesheets.php'; ?>

    </head>
    <body>
        <?php
        include './includesadmin/header-admin.php';
        ?>                
        <!--HTML Content Here-->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3 text-center">

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">

                        </div>
                        <h3 class="mb-0">
                            <span class="count"><?php echo $userCount; ?></span>
                        </h3>
                        <p class="text-light">Total Registered Users</p>


                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">

                        </div>
                        <h3 class="mb-0">
                            <span class="count"><?php echo $adCount; ?></span>
                        </h3>
                        <p class="text-light">Total Posted Ads</p>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">

                        </div>
                        <h3 class="mb-0">
                            <span class="count"><?php echo $serviceCount; ?></span>
                        </h3>
                        <p class="text-light">Total Services</p>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">

                        </div>
                        <h3 class="mb-0">
                            <span class="count">50</span>
                        </h3>
                        <p class="text-light">Total income from the Ads</p>


                    </div>
                </div>
            </div>
            <!--/.col-->

        </div> <!-- .content -->


        <?php
        include './includesadmin/header-admin2.php';
        ?>

        <?php
        include './includesadmin/javascript-sheets.php';
        ?>


    </body>
</html>

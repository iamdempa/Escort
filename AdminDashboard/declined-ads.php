<?php
include './includesadmin/dbConnection.php';
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
        <title>New Ads - Escort Admin Panel</title>
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
                        <h1>Declined Ads</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"><strong>Declined ads</strong> by the admin shows here</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        





        <?php
        $sql = "SELECT * FROM ad WHERE adstatus = 'declined';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        echo "<div class='container-fluid'>
            <div class='row'>
                <div class='col-12 col-md-12 col-sm-12'>                                                                                  
                    <table class='table table-bordered text-center table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Ad ID</th>
                                <th>User Name</th>
                                <th>Title</th>                                                                       
                                <th>Description</th>
                                <th>Service</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>";

        if ($resultCheck < 1) {
//            echo 'no data';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>";
                echo $row['adid'];
                echo "</td>";

                $uid = $row['userid'];

                $sql2 = "SELECT * FROM user WHERE userid='$uid'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) < 1) {
                    echo "<td>";
                    echo "-";
                    echo "</td>";
                } else {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<td>";
                        echo $row2['userFName'];
                        echo "</td>";
                    }
                }

                echo "<td>";
                echo $row['adtitle'];
                echo "</td>";

                echo "<td>";
                echo $row['addescription'];
                echo "</td>";


                $serviceid = $row['serviceid'];


                $sql3 = "SELECT * FROM service WHERE serviceid='$serviceid'";
                $result3 = mysqli_query($conn, $sql3);
                if (mysqli_num_rows($result3) < 1) {
                    echo "<td>";
                    echo "-";
                    echo "</td>";
                } else {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo "<td>";
                        echo $row3['service'];
                        echo "</td>";
                    }
                }

                $countryid = $row['countryid'];

                $sql4 = "SELECT * FROM country WHERE countryid='$countryid'";
                $result4 = mysqli_query($conn, $sql4);
                if (mysqli_num_rows($result4) < 1) {
                    echo "<td>";
                    echo "-";
                    echo "</td>";
                } else {
                    while ($row4 = mysqli_fetch_assoc($result4)) {
                        echo "<td>";
                        echo $row4['country'];
                        echo "</td>";
                    }
                }

                echo "<td>";
                echo $row['adstatus'];
                echo "</td>";



                echo "<td>";
                echo "<div class='dropdown'>
                                                
                        <i class='fa fa-cog dropdown-toggle' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></i>
                        
                        <div id='banuka' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                          <a class='dropdown-item' href='view-ad.php?adid=" . $row['adid'] . "&userid=" . $row['userid'] . "&review=yes'><i class='fa fa-check'> Approve</i></a>                              
                          <a class='dropdown-item' href='../post-ad.php?editAdId=".$row['adid']."&userId=".$row['userid']."&updateByAdmin&declined=yes'><i class='fa fa-refresh'> Update</i></a>
                          <a class='dropdown-item' href='#'><i class='fa fa-remove'> Delete</i></a>                          
                        </div>
                        
                      </div>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>

        <?php
        echo "</tbody>
        </table>                                    
        </div>
        </div>
        </div>";
        ?>




        <?php
        include './includesadmin/header-admin2.php';
        ?>



        <?php
        include './includesadmin/javascript-sheets.php';
        ?>



    </body>
</html>

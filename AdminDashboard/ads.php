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
        <title>Ads - Escort Admin Panel</title>

        <?php
        include './includesadmin/stylesheets.php';
        ?>
        
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
                        <h1>Advertisements</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Advertisements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <?php
        $sql = "SELECT * FROM ad WHERE adstatus = 'success';";
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
                        ";
                ?>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="view-ad.php?adid=<?php echo $row['adid']; ?>&userid=<?php echo $row['userid']; ?>&view=yes"><i class="fa fa-trash"> Decline</i></a>                         
                    <a class="dropdown-item" href="#" onclick="showDeleteConfirm(this)" userid="<?php echo $row['userid']; ?>"  id=<?php echo $row['adid']; ?>><i class="fa fa-remove"> Delete</i></a>
                    <?php
                    echo "</div>
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

            <script type="text/javascript">
                function showDeleteConfirm(id) {
                    $.confirm({
                        title: 'Delete Ad!',
                        content: 'Are you sure?',
                        theme: 'material', // 'material', 'bootstrap'
                        buttons: {
                            Delete: function () {
                                $.alert('Deleted!');
                                deleteAd(id);
                                setTimeout(function () {
                                    window.location.href = "ads.php";
                                }, 2500);
                            },
                            cancel: function () {

                            }
                        }
                    });
                }
                function deleteAd(id) {
                    var adId = $(id).attr('id');
                    var userId = $(id).attr('userid');

                    $.ajax({
                        url: 'includesadmin/remove-ad-inc.php',
                        dataType: 'text', // what to expect back from the PHP script, if anything                        
                        data: {
                            adId: adId,
                            userId: userId
                        },
                        type: 'post',
                        success: function (php_script_response) {
                            alert(php_script_response); // display response from the PHP script, if any
                        }
                    });

                }
            </script>

            <script type="text/javascript">
                function showDeleteConfirm2(id) {
                    $.confirm({
                        title: 'Delete Ad!',
                        content: 'Are you sure?',
                        theme: 'material', // 'material', 'bootstrap'
                        buttons: {
                            Delete: function () {
                                $.alert('Declined!');
                                deleteAd(id);
                                setTimeout(function () {
                                    window.location.href = "ads.php";
                                }, 2500);
                            },
                            cancel: function () {

                            }
                        }
                    });
                }

                function deleteAd(id) {
                    var adId = $(id).attr('id');
                    $.ajax({
                        url: 'includesadmin/remove-ad-inc.php',
                        dataType: 'text', // what to expect back from the PHP script, if anything                        
                        data: {
                            adId: adId,
                            userId: <?php echo $userId ?>
                        },
                        type: 'post',
                        success: function (php_script_response) {
                            alert(php_script_response); // display response from the PHP script, if any
                        }
                    });
                }
            </script>




            <!--         Modal 
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Review Ad</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <br><br><br><br><br><br><br><br><br><br><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
                                </div>
                            </div>
                        </div>
                    </div>-->

            <?php
            include './includesadmin/header-admin2.php';
            ?>

            <?php
            include './includesadmin/javascript-sheets.php';
            ?>


    </body>
</html>

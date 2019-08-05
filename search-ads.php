<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        include './includes/dbConnection.php';

        if (empty($_GET['service'])) {
            $service = "all";
            $country = "all";
        } else {
            $service = $_GET['service'];
            $country = $_GET['country'];
        }

        $keyword = $_GET['keyword'];
        if (isset($_SESSION['userid'])) {
            $userId = $_SESSION['userid'];
        }
        if (!isset($keyword)) {
            header("Location: index.php");
            exit();
        } else {
            if (strlen($keyword) > 0) {
                echo "<title>$keyword - Escort Search Ads</title>";
            } else {
                echo "<title>Search - Escort Search Ads</title>";
            }
        }
        ?>


        <!-- Bootstrap core CSS -->
        <link href="css/main/bootstrap.css" rel="stylesheet"> 

        <!-- Custom styles for this template -->
        <link href="css/index/carousel.css" rel="stylesheet">

        <!--<link href="css/main/font-awesome.min.css" rel="stylesheet">-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="css/searchpage/custom.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="css/index/index-custom.css" rel="stylesheet">



    </head>
    <body style="background: #f0f0f0">
        <div class="thetop"></div>
        <?php
        include_once './includes/header.php';
        ?>
        <br>

        <div class="container" style="background: #ffffff; border-radius: 10px">
            <div class="row text-center">
                <div class="col-12 col-md-12">

                    <nav class="navbar navbar-expand-lg navbar-expand navbar-light  filterbar">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <form action="includes/search-ads-filter-inc.php" method="POST">
                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item px-5">                                    

                                        <div class="form-group row country">
                                            <label for="country" class="col-form-label"><i class='fa fa-globe'></i> Search by Country:</label>
                                            <div class="col-sm-10">
                                                <select id="country" name="country" class="form-control">

                                                    <option value="all">All</option>
                                                    <option value="1">Sri Lanka</option>
                                                    <option value="2">India</option>
                                                    <option value="3">Thailand</option>
                                                    <option value="4">Taiwan</option>
                                                    <option value="5">Indonesia</option>
                                                    <option value="6">Philippines</option>
                                                    <option value="7">Malaysia</option>
                                                    <option value="8">Japan</option>
                                                    <option value="9">Australia</option>
                                                    <option value="10">Vietnam</option>

                                                </select> 
                                            </div>
                                        </div>


                                    </li>


                                    <li class="nav-item px-6">                                    

                                        <div class="form-group row service">
                                            <label for="service" class="col-form-label"><i class='fa fa-tasks'></i> Search by Service:</label>
                                            <div class="col-sm-10">
                                                <select id="service" name="service" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="1">Hotel</option>
                                                    <option value="2">Restauant</option>
                                                    <option value="3">Annex</option>
                                                    <option value="4">Spa</option>
                                                    <option value="5">Guide</option>
                                                    <option value="6">Tour</option>
                                                    <option value="7">Beach Boy</option>
                                                    <option value="8">Escort</option>                                                    
                                                </select> 
                                            </div>
                                        </div>


                                    </li>

                                    <li class="nav-item px-6">                                    
                                        <label for="country" class="col-form-label"><i class='fa fa-flagy'></i>  </label>
                                        <div class="col-sm-12">
                                            <?php
                                            if ($keyword != "" || strlen($keyword) == 0) {
                                                echo '<input class="form-control mr-sm-2" name="keyword" type="text" placeholder="' . $keyword . '" value="' . $keyword . '" aria-label="Search">';
                                            } else {
                                                echo '<input class="form-control mr-sm-2" name="keyword" type="text" placeholder="Search Ads" aria-label="Search">';
                                            }
                                            ?>

                                        </div>

                                    </li>

                                    <li class="nav-item px-6">                                    
                                        <label for="country" class="col-form-label"><i class='fa fa-flagy'></i>  </label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search Ads</button>
                                        </div>

                                    </li>
                                </ul>
                            </form> 
                        </div>
                    </nav>

                </div>
            </div>
        </div>

        <br><br><br>

        <!--Showing ads-->
        <?php

        function pagination($numOfResults, $resultPerPage) {

            if (empty($_GET['service'])) {
                $service = "all";
                $country = "all";
            } else {
                $service = $_GET['service'];
                $country = $_GET['country'];
            }

            $keyword = $_GET['keyword'];
            if (isset($_SESSION['userid'])) {
                $userId = $_SESSION['userid'];
            }

            $numberOfPages = ceil($numOfResults / $resultPerPage);
//            echo "Number of Results: " . $numOfResults . "</br>";
//            echo "Results  per page: " . $resultPerPage . "</br>";
            echo "<div class='container'><div class='row'><div class='col-7'></div><div class='col-5'><nav aria-label='Page navigation example text-center'>"
            . "<ul class='pagination'>";
            if ($numberOfPages != 1) {
                for ($page = 1; $page <= $numberOfPages; $page++) {

                    echo "<li class='page-item'><a class='page-link' href='search-ads.php?keyword=$keyword&service=$service&country=$country&page=" . $page . "'>" . $page . "</a></li>";
                }
                echo "</ul></nav></div></div></div>";
            }
        }

        //to show ads by the user
        function showAdImages($conn) {

            //if user clicked search from the index page
            if (empty($_GET['service']) || empty($_GET['country'])) {
                $service = "all";
                $country = "all";
                $keyword = $_GET['keyword'];
            } else { //if user is in search page and clicked search
                $service = $_GET['service'];
                $country = $_GET['country'];
                $keyword = $_GET['keyword'];
            }

            $resultPerPage = 5;
            $adStatus = "success"; //CHANGE THIS TO success 
//            $sql2 = "SELECT * FROM ad WHERE userid=?";
            if ($service == "all" && $country == "all") {
                $sql2 = "SELECT * FROM ad WHERE adstatus='$adStatus' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )";
            }
            if ($service == "all" && $country != "all") {
                $sql2 = "SELECT * FROM ad WHERE adstatus='$adStatus' AND countryid='$country' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )";
            }

            if ($service != "all" && $country == "all") {
                $sql2 = "SELECT * FROM ad WHERE adstatus='$adStatus' AND serviceid='$service' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )";
            }

            if ($service != "all" && $country != "all") {
                $sql2 = "SELECT * FROM ad WHERE adstatus='$adStatus' AND serviceid='$service' AND countryid='$country' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )";
            }





            $success = "pending";
            $keywordd = "%{$_GET['keyword']}%";

            $stmt2 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt2, $sql2);
//            mysqli_stmt_bind_param($stmt2, "i", $userIdd);
            mysqli_stmt_bind_param($stmt2, "sss", $keywordd, $keywordd, $keywordd);
            mysqli_stmt_execute($stmt2);

            $result2 = mysqli_stmt_get_result($stmt2);
            $numOfResults2 = mysqli_num_rows($result2);
//            echo 'Results: ' . $numOfResults2;


            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $thisPageFirstResult = ($page - 1) * $resultPerPage;

            if ($service == "all" && $country == "all") {
                $sql = "SELECT * FROM ad WHERE adstatus='$adStatus' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )  LIMIT  " . $thisPageFirstResult . "," . $resultPerPage . ";";
            }

            if ($service == "all" && $country != "all") {
                $sql = "SELECT * FROM ad WHERE countryid='$country' AND adstatus='$adStatus' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )  LIMIT  " . $thisPageFirstResult . "," . $resultPerPage . ";";
            }

            if ($service != "all" && $country == "all") {
                $sql = "SELECT * FROM ad WHERE serviceid='$service' AND adstatus='$adStatus' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )  LIMIT  " . $thisPageFirstResult . "," . $resultPerPage . ";";
            }

            if ($service != "all" && $country != "all") {
                $sql = "SELECT * FROM ad WHERE serviceid='$service' AND countryid='$country' AND adstatus='$adStatus' AND ( adtitle LIKE ? OR addescription LIKE ? OR adcontactemail LIKE ? )  LIMIT  " . $thisPageFirstResult . "," . $resultPerPage . ";";
            }





            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'error';
            } else {
                $success = "pending";
                mysqli_stmt_bind_param($stmt, "sss", $keywordd, $keywordd, $keywordd);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);

                $numOfResults = mysqli_num_rows($result);
//                echo "Number of results Main: " . $numOfResults . "</br>";

                echo "<div class='container'>
                    <div class='row'>
                        <div class='col-4'>
                        
                        </div>";
                if ($numOfResults2 < 1) { //no result
                    echo "<div class='col-8' style='background: #f0f0f0; border-radius: 10px;margin-bottom:200px;'><h1>No ads found!</h1>";
                } else { //has a result
                    echo "<div class='col-8' style='background: #ffffff; border-radius: 10px;margin-bottom:200px;'>";
                }


                echo "<table class='table'>                    
                    <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $adId = $row['adid'];
//                    $sql2 = "SELECT * FROM adimage WHERE adid='$adId' AND userid='$userIdd' LIMIT 1;";
                    $sql2 = "SELECT * FROM adimage WHERE adid='$adId' LIMIT 1;";
//                    echo $adId;

                    $resultImage = mysqli_query($conn, $sql2);
                    while ($rowImage = mysqli_fetch_assoc($resultImage)) { //runs only one time
                        if ($rowImage['adimagestatus'] == 0) { //ad pic set
                            $fileName = "uploads/ad/adImage-" . $rowImage['adimageid'] . "-" . $rowImage['adid'] . "-" . $rowImage['userid'] . "*";
                            $fileInfo = glob($fileName);

                            $fileExt = explode(".", $fileInfo[0]);
                            $fileActualExt = $fileExt[1];

                            echo "<td class='text-right'>";
                            echo "<img src='uploads/ad/adImage-" . $rowImage['adimageid'] . "-" . $rowImage['adid'] . "-" . $rowImage['userid'] . "." . $fileActualExt . "?" . mt_rand() . "' style='width:150px;height:150px;' class='rounded float-right'>";
                            echo"</td>";

                            echo "<td class='text-left' style='width:100%;'>";

                            echo "<h3>";
                            echo "<a class='card-link' href='view-ad.php?editAdId=" . $rowImage['adid'] . "'>";
                            echo $row['adtitle'];
                            echo "</a>";
                            echo "</h3>";

                            echo "<h6 style='color:#9E9A9A;display:block;text-overflow:ellipsis; width:500px; overflow:hidden; white-space: nowrap;'>";
                            echo $row['addescription'];
                            echo "</h6>";

                            echo '<br>';

                            $country = $row['countryid'];
                            switch ($country) {
                                case 1:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Sri Lanka</p>";
                                    break;
                                case 2:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> India</p>";
                                    break;
                                case 3:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Thailand</p>";
                                    break;
                                case 4:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Taiwan</p>";
                                    break;
                                case 5:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Indonesia</p>";
                                    break;
                                case 6:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Philippines</p>";
                                    break;
                                case 7:
                                    echo "<p class='countryname'<i class='fa fa-flag'></i> >Malaysia</p>";
                                    break;
                                case 8:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Japan</p>";
                                    break;
                                case 9:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Australia</p>";
                                    break;
                                case 10:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Vietnam</p>";
                                    break;
                            }

                            $service = $row['serviceid'];
                            switch ($service) {
                                case 1:
                                    echo "<p class='servicename'><i class='fa fa-building'></i>Hotel</p>";
                                    break;
                                case 2:
                                    echo "<p class='servicename'><i class='fa fa-building'></i> Restaurant</p>";
                                    break;
                                case 3:
                                    echo "<p class='servicename'><i class='fa fa-building'></i> Annex</p>";
                                    break;
                                case 4:
                                    echo "<p class='servicename'<i class='fa fa-building'></i>> Spa</p>";
                                    break;
                                case 5:
                                    echo "<p class='servicename'><i class='fa fa-map'></i> Guide</p>";
                                    break;
                                case 6:
                                    echo "<p class='servicename'><i class='fa fa-plane'></i> Tour</p>";
                                    break;
                                case 7:
                                    echo "<p class='servicename'><i class='fa fa-umbrella'></i> Beach Boy</p>";
                                    break;
                                case 8:
                                    echo "<p class='servicename'><i class='fa fa-car'></i> Escort</p>";
                                    break;
                            }

                            echo"</td>";



                            echo "</tr>";
                        } else { //ad pic not set
                            echo "<td class='text-right'>";
                            echo "<img src='https://placehold.it/500' style='width:150px;height:150px;' class='rounded float-right'>";
                            echo"</td>";

                            echo "<td class='text-left' style='width:100%;'>";

                            echo "<h3>";
                            echo "<a class='card-link' href='view-ad.php?editAdId=" . $rowImage['adid'] . "'>";
                            echo $row['adtitle'];
                            echo "</a>";
                            echo "</h3>";

                            echo "<h6 style='color:#9E9A9A;display:block;text-overflow:ellipsis; width:500px; overflow:hidden; white-space: nowrap;'>";
                            echo $row['addescription'];
                            echo "</h6>";

                            echo '<br>';

                            $country = $row['countryid'];
                            switch ($country) {
                                case 1:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Sri Lanka</p>";
                                    break;
                                case 2:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> India</p>";
                                    break;
                                case 3:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Thailand</p>";
                                    break;
                                case 4:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Taiwan</p>";
                                    break;
                                case 5:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Indonesia</p>";
                                    break;
                                case 6:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Philippines</p>";
                                    break;
                                case 7:
                                    echo "<p class='countryname'<i class='fa fa-flag'></i> >Malaysia</p>";
                                    break;
                                case 8:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Japan</p>";
                                    break;
                                case 9:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Australia</p>";
                                    break;
                                case 10:
                                    echo "<p class='countryname'><i class='fa fa-flag'></i> Vietnam</p>";
                                    break;
                            }

                            $service = $row['serviceid'];
                            switch ($service) {
                                case 1:
                                    echo "<p class='servicename'><i class='fa fa-building'></i>Hotel</p>";
                                    break;
                                case 2:
                                    echo "<p class='servicename'><i class='fa fa-building'></i> Restaurant</p>";
                                    break;
                                case 3:
                                    echo "<p class='servicename'><i class='fa fa-building'></i> Annex</p>";
                                    break;
                                case 4:
                                    echo "<p class='servicename'<i class='fa fa-building'></i>> Spa</p>";
                                    break;
                                case 5:
                                    echo "<p class='servicename'><i class='fa fa-map'></i> Guide</p>";
                                    break;
                                case 6:
                                    echo "<p class='servicename'><i class='fa fa-plane'></i> Tour</p>";
                                    break;
                                case 7:
                                    echo "<p class='servicename'><i class='fa fa-umbrella'></i> Beach Boy</p>";
                                    break;
                                case 8:
                                    echo "<p class='servicename'><i class='fa fa-car'></i> Escort</p>";
                                    break;
                            }

                            echo"</td>";
                            echo "</tr>";
                        }
                    }
                }


                echo "</tbody>
                </table>
                </div>
                </div>";

                pagination($numOfResults2, $resultPerPage);
                echo "</div>";
            }
        }

        showAdImages($conn);
        ?>

        <!--End of Showing ads-->







        <script type="text/javascript">

            function checkSelectOption(country) {

                if (country !== "all") {
//                    alert(country);
                    $("div.country select").val(country);
                }
            }

            function checkSelectOptionService(service) {

                if (service !== "all") {
//                    alert(country);
                    $("div.service select").val(service);
                }
            }

        </script>

<?php
if ($country !== "all") {
    echo "<script type='text/javascript'>checkSelectOption({$country});</script>";
}
if ($service !== "all") {
    echo "<script type='text/javascript'>checkSelectOptionService({$service});</script>";
}
?>


        <?php
//        $sql = "SELECT * FROM ad WHERE adtitle LIKE '%$keyword%' OR addescription LIKE '%$keyword%' OR adcontactemail LIKE '%$keyword%' AND adstatus='success'";
        $sql = "SELECT * FROM ad WHERE adstatus='success' AND ( adtitle LIKE '%$keyword%' OR addescription LIKE '%$keyword%' OR adcontactemail LIKE '%$keyword%' );";

        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
//            echo 'Results found: ' . $queryResult;
        } else {
//            echo 'No results matching your search!';
        }
        ?>



        <hr class="style3">

<?php
include_once './includes/footer.php';
?>



        <div class="scrolltop">
            <div class="scroll icon"><i class="fa fa-4x fa-angle-up"></i></div>
        </div>




        <!-- Bootstrap core JavaScript
        ==================================================                                                                                                                         -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/main/jquery-slim.min.js"><\/script>')</script>
        <script src="js/main/popper.min.js"></script>
        <script src="js/main/bootstrap.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="js/main/holder.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <!--Back to top-->
        <script type="text/javascript">
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('.scrolltop:hidden').stop(true, true).fadeIn();
                } else {
                    $('.scrolltop').stop(true, true).fadeOut();
                }
            });
            $(function () {
                $(".scroll").click(function () {
                    $("html,body").animate({scrollTop: $(".thetop").offset().top}, "1000");
                    return false
                });
            });
            $(function () {
                $(".see-more-ads").click(function () {
                    $("html,body").animate({scrollTop: $(".see-more-ads-here").offset().top}, "1000");
                    return false
                });
            });
            $(function () {
                $(".post-an-add").click(function () {
                    $("html,body").animate({scrollTop: $(".thetop").offset().top}, "1000");
                    return false
                });
            });
        </script>

    </body>
</html>

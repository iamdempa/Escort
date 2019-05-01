<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Escort - Serach Adz</title>

        <!-- Bootstrap core CSS -->
        <link href="css/main/bootstrap.css" rel="stylesheet"> 

        <!-- Custom styles for this template -->
        <link href="css/index/carousel.css" rel="stylesheet">
        <link href="css/index/index-custom.css" rel="stylesheet">
        <!--<link href="css/main/font-awesome.min.css" rel="stylesheet">-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="css/searchpage/custom.css" rel="stylesheet">



    </head>
    <body>
        <div class="thetop"></div>
        <?php
        include_once './includes/header.php';
        include './includes/dbConnection.php';
        $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
        ?>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">

                    <nav class="navbar navbar-expand-lg navbar-expand navbar-light  filterbar">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <form>
                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item px-6">                                    

                                        <div class="form-group row">
                                            <label for="country" class="col-form-label"><i class='fa fa-globe'></i> Search by Country:</label>
                                            <div class="col-sm-10">
                                                <select id="country" name="country" class="form-control">
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

                                        <div class="form-group row">
                                            <label for="country" class="col-form-label"><i class='fa fa-tasks'></i> Search by Service:</label>
                                            <div class="col-sm-10">
                                                <select id="country" name="country" class="form-control">
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
                                        <label for="country" class="col-form-label"><i class='fa fa-flagy'></i>  </label>
                                        <div class="col-sm-12">
                                            <input class="form-control mr-sm-2" name="keyword" type="text" placeholder="Search Ads" aria-label="Search">                            
                                        </div>

                                    </li>

                                    <li class="nav-item px-6">                                    
                                        <label for="country" class="col-form-label"><i class='fa fa-flagy'></i>  </label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search Ads</button>
                                        </div>

                                    </li>
                                </ul>
                            </form>
                        </div>
                    </nav>

                </div>
            </div>
        </div>

        <?php
//        $sql = "SELECT * FROM ad WHERE adtitle LIKE '%$keyword%' OR addescription LIKE '%$keyword%' OR adcontactemail LIKE '%$keyword%' AND adstatus='success'";
        $sql = "SELECT * FROM ad WHERE adstatus='success' AND ( adtitle LIKE '%$keyword%' OR addescription LIKE '%$keyword%' OR adcontactemail LIKE '%$keyword%' );";

        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
            echo 'Results found: ' . $queryResult;
        } else {
            echo 'No results matching your serach!';
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
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/main/jquery-slim.min.js"><\/script>')</script>
        <script src="js/main/popper.min.js"></script>
        <script src="js/main/bootstrap.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="js/main/holder.min.js"></script>
        <script src="js/main/jquery.js"></script>

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

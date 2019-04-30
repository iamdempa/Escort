
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">






        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (isset($_SESSION['username'])) {
                //header("Location: ./user-profile.php");
                echo "<title>" . $_SESSION['username'] . " - Escort Personal Adz</title>";
            } else {
                header("Location: index.php");
            }
        }
        ?>

        <!-- Bootstrap core CSS -->
        <link href="css/main/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/index/carousel.css" rel="stylesheet">
        <link href="css/index/index-custom.css" rel="stylesheet">
        <link href="css/user-profile/user-profile-custom.css" rel="stylesheet">
        <!--<link href="css/main/font-awesome.min.css" rel="stylesheet">-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>




    </head>
    <body>
        <?php
        if (isset($_GET['update']) == 'Success') {
            echo "<div class='alert mekata alert-success alert-dismissible fade show text-center' id='success-alert' role='alert'>
                <strong>Profile Updated!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } if (isset($_GET['uploadsuccess'])) {
            echo "<div class='alert mekata alert-success alert-dismissible fade show text-center' auto-close='5000' id='success-alert' role='alert'>
                <strong>Profile Updated!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } if (isset($_GET['uploadsizeexceeded'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' id='success-alert' role='alert'>
                <strong>File Size Exceeded</strong> Maximum file size is 1MB
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } if (isset($_GET['uploadselectanimage'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' id='success-alert' role='alert'>
                <strong>No image selected!</strong> Select an image of size less than 1MB
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } if (isset($_GET['uploadinvalidfiletype'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' id='success-alert' role='alert'>
                <strong>Invalid image file!</strong> Select only JPG/JPEG/PNG formats
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } if (isset($_GET['uploaderror'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' id='success-alert' role='alert'>
                <strong>An error Occured!</strong> Try again later...
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        }
        ?>        

        <script type="text/javascript">
            window.setTimeout(function () {
                $(".mekata").fadeTo(1000, 0).slideUp(1000, function () {
                    $(this).hide();
                });
            }, 1000);
        </script>


        <div class="thetop"></div>
        <?php
        include_once './includes/header.php';
        ?>

        <main role="main">





            <br>


            <?php
            include_once './includes/user-profile-content.php';
            ?>




            <hr class="style3">                                                                                                                                               


            <?php
            include_once './includes/footer.php';
            ?>
        </main>

        <div class="scrolltop">
            <div class="scroll icon"><i class="fa fa-4x fa-angle-up"></i></div>
        </div>








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
        
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        


    </body>
</html>

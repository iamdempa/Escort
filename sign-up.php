<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Sign Up - Escort Personal Adz</title>

        <!-- Bootstrap core CSS -->
        <link href="css/main/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/index/carousel.css" rel="stylesheet">
        <link href="css/index/index-custom.css" rel="stylesheet">
        <!--<link href="css/main/font-awesome.min.css" rel="stylesheet">-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="css/main/imagehover.css" rel="stylesheet">
        <link href="css/sign-up/sign-up-custom.css" rel="stylesheet">



    </head>
    <body>




        <?php
        if (isset($_GET['userexists'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>User Exists!</strong> Email has already registered with another account.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['invalidUsername'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Invalid Username!</strong> A username can only contain alphanumeric characters (letters A-Z, numbers 0-9).
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['password'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Passwords doesn't match!</strong> Make sure you enter the correct password.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        }else if(isset($_GET['invalidEmail'])){
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Invalid Email!</strong> Enter a valid email.
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
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-light navigation-bar">
                <a class="navbar-brand" href="index.php">Escort</a>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">                                               
                    </ul>                    
                </div>



            </nav>
        </header>

        <main role="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-1 col-1"></div>


                    <div class="col-md-6 col-sm-10 col-10">
                        <!--                        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">-->
                        <div class="card card-signin my-5">
                            <div class="card-body card-body-new">
                                <h5 class="card-title text-center">Sign Up</h5>

                                <!--form-->
                                <form class="form-signin" action="includes/sign-up-inc.php" method="POST">

                                    <div class="form-label-group">
                                        <input type="text" id="userName" name="userName" class="form-control" placeholder="Name" autofocus>
                                        <label for="userName">Username</label>
                                        <small id="textCount" class="form-text text-right">Use your company/institute name</small>                                    
                                    </div>

                                    <div class="form-label-group">
                                        <input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Email address" required autofocus>
                                        <label for="userEmail">Email address</label>
                                    </div>

                                    <div class="form-label-group">
                                        <input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Password" required>
                                        <label for="userPassword">Password</label>
                                    </div>

                                    <div class="form-label-group">
                                        <input type="password" id="userConfirmPassword" name="userConfirmPassword" class="form-control" placeholder="Confirm Password" required>
                                        <label for="userConfirmPassword">Confirm Password</label>
                                    </div>

                                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Sign Up</button>
                                    <hr class="my-4">
                                    <p class="text-center">Already have an account? <a href="sign-in.php" class="card-link"><strong>Sign in</strong></a></p>
                                </form>



                            </div>
                            <!--</div>-->
                        </div>
                    </div>  

                    <div class="col-md-3 col-sm-1 col-1"></div>

                </div>
            </div>
            <hr class="style3">


            <?php
            include_once './includes/footer.php';
            ?>
        </main>

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

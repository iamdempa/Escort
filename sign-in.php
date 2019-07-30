<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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


        <title>Sign In - Escort Personal Adz</title>

        <!-- Bootstrap core CSS -->
        <link href="css/main/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/index/carousel.css" rel="stylesheet">
        <link href="css/index/index-custom.css" rel="stylesheet">
        <!--<link href="css/main/font-awesome.min.css" rel="stylesheet">-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="css/main/imagehover.css" rel="stylesheet">
        <link href="css/sign-in/sign-in-custom.css" rel="stylesheet">



    </head>
    <body>

        <!--changing the local storage values-->
        <script>
            localStorage.setItem("cookieEmail", "");
            localStorage.setItem("cookieTel", "");
            localStorage.setItem("cookieTelOffice", "");
            localStorage.setItem("cookieStreet", "");
            localStorage.setItem("cookieCity", "");
            localStorage.setItem("cookieState", "");
        </script>

        <div class="thetop"></div>


        <?php
        if (isset($_GET['success'])) {
            echo "<div class='alert mekata alert-success alert-dismissible fade show text-center' role='alert'>
                <strong>Successfully Registered!</strong> Enter your email and Password to login.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['loginEmpty'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Empty Fields!</strong> Fields cannot be empty.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['loginNoData'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Invalid Credentials/Account is Banned!</strong> Make sure you enetered correct login credentials or send an email to unban your account.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['loginError'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Invalid Credentials!</strong> Make sure you enetered correct login credentials.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['update']) == "SuccessLoginAgain") {
            echo "<div class='alert mekata alert-success alert-dismissible fade show text-center' role='alert'>
                <strong>Profile Updated!</strong> Login into your account.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['reset']) == "success") {
            echo "<div class='alert mekata alert-success alert-dismissible fade show text-center' role='alert'>
                <strong>Password Reset Successful!</strong> Login into your account with the new password.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        } else if (isset($_GET['PostAnAd']) || isset ($_GET['AdminLoginFirst'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Login Required!</strong> Log in to your account to access profile.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        }else if(isset ($_GET['isBanned'])){
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' role='alert'>
                <strong>Account is Banned!</strong> Contact us if this happened mistakenly.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        }
        ?>

        <script type="text/javascript">
            window.setTimeout(function () {
//                $(".mekata").fadeTo(1000, 0).slideUp(1000, function () {
//                    $(this).hide();
//                });
                $(".mekata").show();
            }, 1000);
        </script>

        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark navigation-bar">
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
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto"> 
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Sign In</h5>


                                <form class="form-signin" action="includes/sign-in-inc.php" method="POST">
                                    <div class="form-label-group">
                                        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                        <label for="inputEmail">Email address</label>
                                    </div>

                                    <div class="form-label-group">
                                        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                                        <label for="inputPassword">Password</label>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember password</label>
                                    </div>
                                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Sign in</button>
                                    <hr class="my-4">
                                    <p class="text-center">Don't have an account? <a href="sign-up.php" class="card-link"><strong>Sign up</strong></a></p>                                    
                                    <p class="text-center"><a href="reset-password.php" class="card-link"><strong>I forgot my password</strong></a></p>
                                </form>



                            </div>
                        </div>
                    </div>
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

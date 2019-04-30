<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!-- Bootstrap core CSS -->
<link href="css/main/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/index/carousel.css" rel="stylesheet">
<link href="css/index/index-custom.css" rel="stylesheet">
<!--<link href="css/main/font-awesome.min.css" rel="stylesheet">-->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="css/main/imagehover.css" rel="stylesheet">



<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark navigation-bar">
        <a class="navbar-brand" href="../index.php">Escort</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php"><i class='fa fa-home'> Home <span class="sr-only">(current)</i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class='fa fa-user'> About us</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class='fa fa-phone'> Contact us</i></a> 
                </li>
                <li class="nav-item search-bar">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search Ads" aria-label="Search">                            
                </li>
                <li class="nav-item search-button">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </li>

            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <?php
                if (isset($_SESSION['username'])) {
                    //echo "<a class='nav-link create-account card-link' href='user-profile.php'>" . $_SESSION['username'] . " " . "<i class='fa fa-user-o'></i></a>";

                    if (isset($_SESSION['admin']) || !empty($_SESSION['admin'])) {
                        echo "<div class='dropdown show'>
                    <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
                        . $_SESSION['username'] . " <i class='fa fa-user-o'></i>" . "</a>

                    <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuLink'>
                    <a class = 'dropdown-item' href = '../AdminDashboard/index-admin.php'>Profile</a>
                    <div class='dropdown-divider'></div>
                    <a class = 'dropdown-item' href = './includes/sign-out-inc.php'><i class='fa fa-sign-out'></i> Logout</a>
                    
                    </div>
                    </div>";
                    } else {
                        echo "<div class='dropdown show'>
                    <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
                        . $_SESSION['username'] . " <i class='fa fa-user-o'></i>" . "</a>

                    <div class = 'dropdown-menu' aria-labelledby = 'dropdownMenuLink'>
                    <a class = 'dropdown-item' href = '../user-profile.php'>Profile</a>
                    <div class='dropdown-divider'></div>
                    <a class = 'dropdown-item' href = './includes/sign-out-inc.php'><i class='fa fa-sign-out'></i> Logout</a>
                    
                    </div>
                    </div>";
                    }
                } else {
                    echo "<a class = 'nav-link create-account card-link' href = 'sign-in.php'>Sign in <i class = 'fa fa-sign-in'></i></a>";
                }
                ?>

            </form> 

            <form method="POST" class="form-inline mt-2 mt-md-0" action="../post-ad.php?postNewAd=success">
                <button type="submit" class="btn btn-warning">Post your Ad</button>
            </form> 


        </div>



    </nav>
</header>

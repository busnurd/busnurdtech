<?php
ob_start();
session_start();
require_once('dbconfig.php');

// process admin login details
require_once('lib/Validate.class.php');

if (isset($_POST['login'])) {
	$validate = new Validate();
	
	$validate->addRequiredFields('email');
	$validate->addRequiredFields('password');
	
	$validate->checkRequired($_POST);
	
	if ($validate->errorOccured()) {
		// it means user didnt enter required fields
		$error_msg = 'Some error occured.<br>';
		
		foreach ($validate->getErrors() as $error) {
			$error_msg .= $error.'<br>';
		}
		
		echo $error_msg;
	} else {
		// it means user entered all required fields, so we can proceed with the registration processing
		// validate email
		$validate->validateLength('Email',$_POST['email'],'5','40');
		
		// validate password
		$validate->validateLength('Password',$_POST['password'],'5','15');
		
		// check if there is errors and react accordingly
		if ($validate->errorOccured()) {
			$error_msg = 'Some error occured.<br>';
			foreach ($validate->getErrors() as $error) {
				$error_msg .= $error.'<br>';
			}
			
			echo $error_msg;
		} else { // if error didn't occur check user login details in the database
			$email = sanitizeData($_POST['email']);
			$password = md5(sanitizeData($_POST['password']));
			
			$sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
			$result = mysqli_query($db, $sql);
			
			// check if a result is returned from the database
			if (mysqli_num_rows($result) == 1) { // means that user credentials is correct
				$user_details = mysqli_fetch_assoc($result);
				$_SESSION['admin_id'] = $user_details['admin_id'];
				$_SESSION['lastname'] = $user_details['lastname'];
				$_SESSION['email'] = $user_details['email'];
				header("location: admin_home.php");
			} else { // means user credentials isn't correct
				echo '<p class="bg-danger text-center" style="padding: 15px;">Either your email or password is incorrect</p>';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Designing and building dynamic, interactive, responsive, awesome and beautiful websites">
	<meta name="keywords" content="Busnurd Technologies based in Nigeria is the top, best, innovator, Designer, builder & developer of Dynamic, Interactive, Responsive, Beautiful & Awesome Websites that promote businesses and schools. Our high technological expertise covers corporate websites, school websites and school web portal. We are also training students, graduates and professionals with ict skills for empowerment.">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Busnurd Technologies - Promoting Businesses and Schools</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Css animations  -->
    <link href="css/animate.css" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="css/style.css" rel="stylesheet" id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    
    <!-- owl carousel css -->

    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
	
</head>
<body>
    <div id="all">

        <header>

            <!-- *** TOP ***
_________________________________________________________ -->
            <div id="top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-5 contact">
                            <a href="#" data-animate-hover="pulse"><i class="fa fa-phone"></i></a> +234 806 278 0933 <a href="contact.php" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>info@busnurdtech.com
                        </div>
                        <div class="col-xs-7">
                            <div class="social">
                                <a href="https://www.facebook.com/busnurdtechnologies" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/busnurdworld" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
								<a href="https://www.linkedin.com/in/busari-nurudeen-0673889a?trk=nav_responsive_tab_profile" class="external linkedin" data-animate-hover="pulse"><i class="fa fa-linkedin"></i></a>
                                <a href="https://plus.google.com/u/0/105007846631962059441" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                <a href="contact.php" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                            </div>
                            
                            <?php if (isset($_SESSION['admin_id'])) { ?>
                            <div class="login">
                                    <a href="#"><?php echo ucfirst($_SESSION['lastname']); ?></a>
                                    <a href="logout.php">Logout</a>
                            </div>
                            <?php } else { ?>
                            <div class="login">
                                <a href="register.php"><i class="fa fa-user"></i> <span class="text-uppercase">Enrol For Learning How To Code</span></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- *** TOP END *** -->

            <!-- *** NAVBAR ***
    _________________________________________________________ -->

            <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                    <div class="container">
                        <div class="navbar-header">

                            <a class="navbar-brand home" href="index.php">
                                <img src="img/logo.png" alt="Busnurd Logo"><span class="sr-only">Busnurd Creativity</span>
                            </a>
                            <div class="navbar-buttons">
                                <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                        </div>
                        <!--/.navbar-header -->

                        <div class="navbar-collapse collapse" id="navigation">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="use-yamm yamm-fw active">
                                    <a href="index.php">HOME</a>
                                </li>
                                <li class="use-yamm yamm-fw">
                                    <a href="about.php">ABOUT US</a>
                                </li>
                                <li class="use-yamm yamm-fw">
                                    <a href="services.php">OUR SERVICES</a>
                                </li>
                                <li class="use-yamm yamm-fw">
                                    <a href="portfolio.php">OUR PORTFOLIO</a>
                                </li>
								<li class="use-yamm yamm-fw">
                                    <a href="index.php#testimonials">TESTIMONIALS</a>
                                </li>
								<li class="use-yamm yamm-fw">
                                    <a href="http://busnurdtech.com/blog/hire-a-developer/">HIRE A DEVELOPER</a>
                                </li>
                                <li class="use-yamm yamm-fw">
                                    <a href="http://busnurdtech.com/blog/">BLOG</a>
                                </li>
                                <li class="use-yamm yamm-fw">
                                    <a href="contact.php">CONTACT US</a>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->

                    </div>


                </div>
                <!-- /#navbar -->

            </div>

            <!-- *** NAVBAR END *** -->

        </header>
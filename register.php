<?php
include("header.php");
// process user registration details
require_once('lib/Validate.class.php');

if (isset($_POST['register'])) {
	
	$validate = new Validate();
	
	$validate->addRequiredFields('firstname');
	$validate->addRequiredFields('lastname');
	$validate->addRequiredFields('othername');
	$validate->addRequiredFields('address');
	$validate->addRequiredFields('phone');
	$validate->addRequiredFields('email');
	$validate->addRequiredFields('occupation');
	$validate->addRequiredFields('computer');
	$validate->addRequiredFields('html');
	$validate->addRequiredFields('date');
	$validate->addRequiredFields('gender');
	
	$validate->checkRequired($_POST);
	
	$validate->isChecked('Gender', 'gender');
	$validate->isChecked('Computer', 'computer');
	$validate->isChecked('Html', 'html');
	$validate->fileSelected('Photo', 'photo');
	
	if ($validate->errorOccured()) {
		// it means user didn't enter required fields
		$error_msg = 'Some error occured.<br>';
		
		foreach ($validate->getErrors() as $error) {
			$error_msg .= $error.'<br>';
		}
		
		echo $error_msg;
	} else {
		// it means user entered all required fields, so we can proceed with the registration processing
		
		// validate firstname
		$validate->validateLength('First Name',$_POST['firstname'],'5','15');
		
		// validate lastname
		$validate->validateLength('Last Name',$_POST['lastname'],'5','15');
		
		// validate username
		$validate->validateLength('Othername',$_POST['othername'],'6','15');

		// check if there are errors and react accordingly
		if ($validate->errorOccured()) {
			$error_msg = 'Some error occured.<br>';
			foreach ($validate->getErrors() as $error) {
				$error_msg .= $error.'<br>';
			}
			
			echo $error_msg;
		} else { // if error didn't occur check user registration details in the database
			$first_name = sanitizeData($_POST['firstname']);
			$last_name = sanitizeData($_POST['lastname']);
			$othername = sanitizeData($_POST['othername']);
			$email = sanitizeData($_POST['email']);
			$gender = $_POST['gender'];
			$computer = $_POST['computer'];
			$html = $_POST['html'];
            $address = sanitizeData($_POST['address']);
			$phone = sanitizeData($_POST['phone']);
			$occupation = sanitizeData($_POST['occupation']);
			$date = sanitizeData($_POST['date']);
			
			// set flag to determine whether username or password doesnt exists before
			$duplicate = false;
			
			// check duplicate email
			$sql = "SELECT user_id FROM users WHERE email = '$email'";
			$result = mysqli_query($db, $sql);
			if (mysqli_num_rows($result) == 1) {
				$duplicate = true;
				echo '<p>Email already exists. Please choose another email</p>';
			}
			
			if ($duplicate == false) { // means email is unique
				$sql1 = "INSERT INTO users(firstname,lastname,othername,email,gender,address,phone,occupation,computer,html,date) VALUES('$first_name','$last_name','$othername','$email','$gender','$address','$phone','$occupation','$computer','$html','$date')";
			$result1 = mysqli_query($db, $sql1);
			
			// check if data was successfully added to database
			if ($result1 == true) {
				// get id of the registered user
				$user_id = mysqli_insert_id($db);
				
				// process users image uploaded photo
				include('ImageResizer.php');
				$image_name = imageResizer($_FILES['photo']['tmp_name'],'uploads/','200','200',$user_id);
				if ($image_name) {
					// update image name in database
					$sql2 = "UPDATE users SET image = '$image_name' WHERE user_id = '$user_id'";
					$result2 = mysqli_query($db, $sql2);
					
					echo '<p class="bg-success text-center" style="padding: 15px;">Congratulations. You are now registered. You will be replied via email soon.</p>';
					$_POST = array();
				}
				else {
					echo '<p class="bg-danger text-center" style="padding: 15px;">Problem uploading user photo.</p>';
				}
				if ($result2 == true) {
					$email4 = $_REQUEST['email'] ;
					$name4 = $_REQUEST['lastname'] ;
					
					
					require 'phpmailer/PHPMailerAutoload.php';
					
					$mail = new PHPMailer();
					
					// set mailer to use SMTP
					$mail->IsSMTP();
					
					// As this email.php script lives on the same server as our email server
					// we are setting the HOST to localhost
					$mail->Host = "rs110.nsresponse.com";  // specify main and backup server
					
					$mail->SMTPAuth = true;     // turn on SMTP authentication
					
					
					$mail->Username = "contact@busnurdtech.com";  // SMTP username
					$mail->Password = "Goal@2025"; // SMTP password
					
					// $email is the user's email address the specified
					// on our contact us page. We set this variable at
					// the top of this page with:
					// $email = $_REQUEST['email'] ;
					$mail->From = $email4;
					
					// below we want to set the email address we will be sending our email to.
					$mail->AddAddress("contact@busnurdtech.com", "Busnurd Technologies");
					
					// set word wrap to 50 characters
					$mail->WordWrap = 50;
					// set email format to HTML
					$mail->IsHTML(true);
					
					$mail->Subject = "You have a new Training ENROLLMENT from your website!";
					
					// $message is the user's message they typed in
					// on our contact us page. We set this variable at
					// the top of this page with:
					// $message = $_REQUEST['message'] ;
					$mail->Body    = $name4;
					$mail->AltBody = $name4;
					
					if(!$mail->Send())
					{
					   echo '<p class="bg-danger text-center" style="padding: 15px;">Message could not be sent. </p>';
					   echo '<p class="bg-danger text-center" style="padding: 15px;">Mailer Error: ' . $mail->ErrorInfo;
					   echo "</p>";
					   exit;
					}
				}
			} else {
				echo '<p class="bg-danger text-center" style="padding: 15px;">Problem occured during client registration. Please try again later or fill our contact form.</p>' . mysqli_error($db);
			}
			}
		}
	}
}
?>
        <div id="content">
            <div class="container">

                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <h2 class="text-uppercase">ENROL FOR WEB DEVELOPMENT TRAINING</h2>

                            <p class="lead">Are you curious about learning PHP, the language that runs 75% of the Web?</p>
                            <p class="lead">Are you in need of a skill that could give you financial freedom and make you rich for ever?</p>
							<p class="lead">Are you ready to change your story from being an employee (working to make someone else rich) for life to employer of labour?</p>
							<p class="lead">The solution is at your fingertips. A Single click on Enrol button after filling the enrolment form by the right will get you started on a career of web developers that are earning an average of $58,000 monthly</p>
							<p class="lead">At Busnurd Technologies, we have dedicated training team that will offer you more than all technical skills to get started on Web Development career. We will get you empowered by your ability to deliver end results to your clients.</p>
                        </div>
                    </div>

                    <div class="col-md-6">
						<div class="col-sm-12">
							<div class="heading text-center">
								<h2>Enrollment Form</h2>
							</div>
						</div>
                        <form name="frmRegister" enctype="multipart/form-data" method="post">
							<div class="form-group">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>" required="" id="firstname-login">
							</div>
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>" required="" class="form-control" id="lastname-login">
							</div>
							<div class="form-group">
								<label for="othername">Other Name</label>
								<input type="text" name="othername" value="<?php echo isset($_POST['othername']) ? $_POST['othername'] : ''; ?>" required="" class="form-control" id="othername-login">
							</div>
							<div class="form-group">
								<label for="email-login">Email</label>
								<input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required="" class="form-control" id="email-login">
							</div>
							<div class="form-group">
								<label for="gender">Gender</label>
								<span class="form-control">
									<input type="radio" name="gender" value="Male"> Male
									<input type="radio" name="gender" value="Female"> Female
								</span>
							</div>
							<div class="form-group">
								<label for="address">Contact Address</label>
								<input type="text" class="form-control" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required="">
							</div>
							<div class="form-group">
								<label for="phone">Phone Contact</label>
								<input type="text" class="form-control" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required="">
							</div>
							<div class="form-group">
								<label for="occupation">Occupation</label>
								<input type="text" class="form-control" name="occupation" value="<?php echo isset($_POST['occupation']) ? $_POST['occupation'] : ''; ?>" required="">
							</div>
							<div class="form-group">
								<label for="computer">Computer Knowledge</label>
								<span class="form-control">
									<input type="radio" name="computer" value="Basic" data-form-field="computer"> Basic
									<input type="radio" name="computer" value="Intermediate" data-form-field="computer"> Intermediate
									<input type="radio" name="computer" value="Advanced" data-form-field="computer"> Advanced
								</span>
							</div>
							<div class="form-group">
								<label for="html">HTML & CSS Knowledge</label>
								<span class="form-control">
									<input type="radio" name="html" value="Basic" data-form-field="html"> Basic
									<input type="radio" name="html" value="Intermediate" data-form-field="html"> Intermediate
									<input type="radio" name="html" value="Advanced" data-form-field="html"> Advanced
								</span>
							</div>
							<div class="form-group">
								<label for="date">Proposed Starting date</label>
								<span class="form-control">
									<input type="text" id="date" placeholder="MM/DD/YYY" name="date">
								</span>
							</div>
							<div class="form-group">
								<label for="photo">Attach Passport size photograph</label>
								<span class="form-control">
									<input type="file" name="photo" id="photo">
									<input style="clear: both;" type="submit" name="uploadPhoto" value="">
								</span>
							</div>
							<div class="text-center">
								<button type="submit" name="register" class="btn btn-template-main"><i class="fa fa-user-md"></i> Enrol</button>
							</div>
						</form> <br><br>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
			<section class="bar background-pentagon no-mb" id="testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading text-center">
                            <h2>Testimonials</h2>
                        </div>

                        <p class="lead">We have empowered over 200 Students, Graduates and Professionals with Our Web Development Training. Have a look at what some of our students said about us.</p>


                        <!-- *** TESTIMONIALS CAROUSEL ***
 _________________________________________________________ -->

                        <ul class="owl-carousel testimonials same-height-row">
                            <li class="item">
                                <div class="testimonial same-height-always">
                                    <div class="text">
                                        <p>Hi, I am the CEO & Principal Software Engineer at Straighthold Global Links Ltd, We had the pleasure of hiring the training team of Busnurd Technologies to train our new employees for Front end, Back end and Web Applications development. This choice was a great success. The new employees that were novice on IT then are now developing applications that meet the requirements of our clients in the best way which gives an edge in the market. I recommend Busnurd Technologies  for whoever want to promote his/her businesses and ideas</p>
                                    </div>
                                    <div class="bottom">
                                        <div class="icon"><i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="name-picture">
                                            <img class="img-circle" alt="CEO & Principal Software Engineer, Straighthold global links Ltd" src="img/software-engineer.jpg">
                                            <h5>Nurudeen Taiwo Ayobami</h5>
											<p>Principal Software Engineer</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="testimonial same-height-always">
                                    <div class="text">
                                        <p>The brain behind Busnurd Technologies is wow!
											===============================
											===============================
											I came in contact with Busnurd Technologies in 2014 while I wanted to develop myself on how to design website. Unlike other web design training institutes I have attended, Busnurd made me see that coding is no difficult task, with constant practice. The first thing that thrilled me about Busnurd Technologies is the priority it gives to hands-on session.
										</p>
                                    </div>
                                    <div class="bottom">
                                        <div class="icon"><i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="name-picture">
                                            <img class="img-circle" alt="Web Development Training" src="img/monsuru.jpg">
                                            <h5>Biliaminu Monsur</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="testimonial same-height-always">
                                    <div class="text">
                                        <p>I Adeoye Ibrahim Babatunde, a 400 level chemical engineering student of ladoke Akintola University of Technology, Ogbomoso hereby testify to the qualitative, competency and highly reliable attitude of BUSNURD TECHNOLOGIES TRAINING in building and designing a standard and well responsive website. I have tested the company by putting in for training on Web Development and I can say boldly without any hesitation that their training team offers the best of the best.</p>
                                    </div>
                                    <div class="bottom">
                                        <div class="icon"><i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="name-picture">
                                            <img class="img-circle" alt="Web Development Training" src="img/ibrahim.jpg">
                                            <h5>Ibrahim Adeoye</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="testimonial same-height-always">
                                    <div class="text">
                                        <p>I came to know about Busnurd Technologies Web Development Trainings via a facebook post and decided to join the training. My experience as a trainee, I found the training team very co-operative, making the subject a lot easier to understand and very effective way of responding to doubts. I am very well satisfied with the team and with their training. In future I will proudly suggest my friends, who are seeking to learn web designing, php, wordpress, bootstrap etc. I will assure them that they will be fully satisfied with the training. I thank Busnurd Technologies Training team for providing me the best training on web designing and development.</p>
                                    </div>

                                    <div class="bottom">
                                        <div class="icon"><i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="name-picture">
                                            <img class="" alt="" src="img/gbadesams.jpg">
                                           
                                        </div>
                                    </div>
                                </div>
                            </li>
							<li class="item">
                                <div class="testimonial same-height-always">
                                    <div class="text">
                                        <p>I have passion to become a Software Developer. So, I enrolled with one of the biggest IT Company in my city for #70,000. After few months, I realized that the guys are only greedy. They have no competent instructors. While looking for way out, I found a post from Busnurd on facebook, read through and head over to his blog page and was convinced that this guy knows better than my instructors there. I enrolled for Web Development and met beyond my expectations. Busnurd! You are a great Teacher! You are a great Mentor! Within just a week, I have the road map to my software development career</p>
                                    </div>

                                    <div class="bottom">
                                        <div class="icon"><i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="name-picture">
                                            <img class="" alt="" src="img/gbadesams.jpg">
                                           
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- /.owl-carousel -->

                        <!-- *** TESTIMONIALS CAROUSEL END *** -->
                    </div>

                </div>
            </div>
        </section>
        </div>
        <!-- /#content -->
<?php
include("footer.php");
?>    
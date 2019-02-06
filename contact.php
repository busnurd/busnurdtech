<?php
include("header.php");

if (isset($_POST['send'])) {
	
			$email = $_REQUEST['email'] ;
			$message = $_REQUEST['message'] ;
			
			
			require 'phpmailer/PHPMailerAutoload.php';
			
			$mail = new PHPMailer();
			
			// set mailer to use SMTP
			$mail->IsSMTP();
			
			$mail->Host = "rs110.nsresponse.com";  
			
			$mail->SMTPAuth = true;     
			
			$mail->Username = "contact@busnurdtech.com";  // SMTP username
			$mail->Password = "Goal@2025"; // SMTP password
			
			$mail->From = $email;
			
			// below we want to set the email address we will be sending our email to.
			$mail->AddAddress("contact@busnurdtech.com", "Busnurd Technologies");
			
			// set word wrap to 50 characters
			$mail->WordWrap = 50;
			// set email format to HTML
			$mail->IsHTML(true);
			
			$mail->Subject = "You have received feedback from your website!";
			
			$mail->Body    = $message;
			$mail->AltBody = $message;
			
			if(!$mail->Send())
			{
			   echo '<p class="bg-danger text-center" style="padding: 15px;">Message could not be sent. </p>';
			   echo '<p class="bg-danger text-center" style="padding: 15px;">Mailer Error: ' . $mail->ErrorInfo;
			   echo "</p>";
			   exit;
			}
			
			echo '<p class="bg-success text-center" style="padding: 15px;">Message has been sent. We will be in touch through the email provided</p>';
        
    }
?>
       
        <div id="content">
            <div class="container" id="contact">

                <section>

                    <div class="row">
                        <div class="col-md-8">
                            <section>
                                <div class="heading text-center">
                                    <h2>We are here to help you out</h2>
                                </div>

                                <p class="lead">Are you curious about getting the whole world to know about your business?<br>Are you in need of web based solution to automate all your school activities?<br>Are you a Proprietor looking for way out of delay in school fees payment & tracking of records or want to relief your staffs from the stress of filling report sheet?</p>
                                <p>Please feel free to contact us, We have a dedicated team that will work tirelessly to promote your business/idea to life & craft awesome website that automate all school activities</p>
                                <p>Our Customer Service Center is working for you 24/7.</p>
								<div class="heading text-center">
									<h2>Contact form</h2>
									<p>All fields are required</p>
								</div>
								 <form name="frmRequest" method="post" enctype="multipart/form-data" role="form">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Email*</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required id="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="message">Message*</label>
                                            <textarea id="message" class="form-control" name="message" value="<?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?>" required placeholder="Please Enter Your Project Description or Feedback Here..."></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 text-center">
                                        <button type="submit" name="send" class="btn btn-template-main"><i class="fa fa-envelope-o"></i> Send message</button>

                                    </div>
                                </div>
                                <!-- /.row -->
                            </form>

                            </section>
                        </div>
						
						<div class="col-md-4">
                            <div class="box-simple">
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <h3>Lagos Address</h3>
                                <p>15 Ire Akari Estate Road,
                                    <br>Isolo, Lagos
                                    <br>Lagos State, <strong>Nigeria</strong>
                                </p>
								<h3>Oyo Address</h3>
                                <p>85 Abiodun Atiba Road
                                    <br>Kosobo Layout, Kosobo Oyo
                                    <br>Oyo State, <strong>Nigeria</strong>
                                </p>
                            </div>
                            <!-- /.box-simple -->
							<div class="box-simple">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <h3>Call center</h3>
                                <p class="text-muted">Instant answer on your queries just phone call away</p>
                                <p><strong>+234 806 278 0933</strong>
                                </p>
                            </div>
							<div class="box-simple">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <h3>Electronic support</h3>
                                <p class="text-muted">Please feel free to fill the contact form or send email to info@busnurdtech.com for your project requirements and feedback.</p>
                            </div>
                            <!-- /.box-simple -->
                        </div>
                    </div>

                </section>

                <section>

                    <div class="row">
                        <div class="col-md-6">
                        	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.0006132494764!2d3.319916013988533!3d6.5216032249966025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8e8bba42255b%3A0xf24f05d60f21b822!2s15+Ire+Akari+Estate+Rd%2C+Lagos!5e0!3m2!1sen!2sng!4v1454146430064" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                        <div class="col-md-6">
                        	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1031.7439774946372!2d3.9438422306348544!3d7.83130058848711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0xf3dc5483643d207c!2sBusnurd+Technologies+Ltd!5e0!3m2!1sen!2sng!4v1455182384599" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                </section>
				
			</div>
            <!-- /#contact.container -->
        </div>
        <!-- /#content -->

<?php
include("footer.php");
?>        
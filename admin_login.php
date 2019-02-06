<?php
include('header.php');

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
		$validate->validateLength('Password',$_POST['password'],'5','10');
		
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
				$_SESSION['email'] = $user_details['email'];
				header("location: admin_home.php");
			} else { // means user credentials isn't correct
				echo '<p class="bg-danger text-center" style="padding: 15px;">Either your email or password is incorrect</p>';
			}
		}
	}
}
?>
	


			<form name="frmAdminLogin" method="post" class="navbar-form" role="form">
				<div class="modal-header">
					<h2>Admin Login</h2>
				</div>
					<div class="modal-body">

						<input type="text" class="form-control" name="email" placeholder="Enter admin email...">
						<input type="password" class="form-control" name="password" placeholder="Password" id="Enter Password...">
						<input type="submit" value="login" name="login" class="btn btn-default"><span class="glyphicon glyphicon-login">
					
					</div>
			</form>
<?php
include("footer.php");
?>
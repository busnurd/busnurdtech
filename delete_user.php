<?php
include('header.php');

if (!isset($_GET['user_id'])) {
	header("location: index.php");
	exit;
}

$user_id = $_GET['user_id'];

// get client details from database
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($db, $sql);
$user_details = mysqli_fetch_assoc($result);

// process delete client details
if (isset($_POST['delete'])) {
	$sql1 = "DELETE FROM users WHERE user_id='$user_id' LIMIT 1";
	$delete_result = mysqli_query($db, $sql1);
	
	if ($delete_result) {
		header("location: admin_home.php");
	} else {
		echo '<p class="bg-danger text-center" style="padding: 15px;">Problem deleting client. Please contact the administrator.</p>';
	}
}
?>

				<form name="frmDeleteUser" method="post" class="form-horizontal" role="form">
				
					<div class="modal-header">
						<h2>Delete Trainee</h2>
						
						<p>Are you sure you want to delete this trainee?</p>
					</div>

					<div class="modal-body">
				
						<div class="form-group">
								<label for="topic" class="col-sm-2 control-label">Trainee Last Name</label>
							<div class="col-sm-6">
								<input type="text" name="name" value="<?php echo $user_details['lastname']; ?>" class="form-control" placeholder="Trainee Last Name" readonly>
							</div> 
						</div>
						
						<div class="form-group">
								<label for="content" class="col-sm-2 control-label">Trainee Email</label>
							<div class="col-sm-6">
								<input type="text" name="email" value="<?php echo $user_details['email']; ?>" class="form-control" placeholder="Trainee Email" readonly>
							</div> 
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<input type="submit" name="delete" value="Delete" class="btn btn-primary">
								<input type="button" value="Cancel" onclick="window.history.back();" class="btn btn-primary">
							</div>
						</div>
					</div>
				</form>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>
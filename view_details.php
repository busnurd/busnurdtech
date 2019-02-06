<?php
include('header.php');

$user_id = sanitizeData($_GET['user_id']);

// get users details
$sql1 = "SELECT * FROM users WHERE user_id='$user_id'";
$user_results = mysqli_query($db, $sql1);
$rows = mysqli_fetch_assoc($user_results);

?>

<div class="container">
	
	<div class="row">
		<div class="col-sm-12">
			<h4 class="text-center"><?php echo $rows['lastname']; ?> Details</h4>
			<table class="table">
				<tr><td>First Name: </td><td><?php echo $rows['firstname']; ?></td></tr>
				<tr><td>Last Name: </td><td><?php echo $rows['lastname']; ?></td></tr>
				<tr><td>Other Name: </td><td><?php echo $rows['othername']; ?></td></tr>
				<tr><td>Address: </td><td><?php echo $rows['address']; ?></td></tr>
				<tr><td>Gender: </td><td><?php echo $rows['gender']; ?></td></tr>
				<tr><td>Occupation: </td><td><?php echo $rows['occupation']; ?></td></tr>
				<tr><td>Email: </td><td><?php echo $rows['email']; ?></td></tr>
				<tr><td>Computer Knowledge: </td><td><?php echo $rows['computer']; ?></td></tr>
				<tr><td>HTML & CSS Knowledge: </td><td><?php echo $rows['html']; ?></td></tr>
				<tr><td>Proposed Starting Date: </td><td><?php echo $rows['date']; ?></td></tr>
				<tr><td>Image: </td><td><img width="100" height="100" style="border-radius:50%" src="uploads/<?php echo $rows['image'] ?>"></td></tr>
			</table>		
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
	
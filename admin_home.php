<?php 
include('header.php');

// retrieve enrolled trainee
$sql1 = "SELECT user_id, email, CONCAT(firstname,' ',lastname) AS full_name FROM users";
$user_results = mysqli_query($db, $sql1);
?>

<div class="container">
	
	<div class="row">
		<div class="col-sm-12">
			<h4 class="text-center">Enrolled Trainee</h4>
			<table class="table">
				<thead>
					<tr>
						<th>Trainee Name</th>
						<th>Trainee Email</th>
					</tr>
				</thead>
				
				<tbody>   
				<?php while($row = mysqli_fetch_assoc($user_results)) { ?>
					<tr>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><a target="_blank" href="view_details.php?user_id=<?php echo $row['user_id']; ?>">View Details</a></td>
						<td><a href="delete_user.php?user_id=<?php echo $row['user_id']; ?>">Delete Client</a></td>
					</tr>
			    <?php } ?>
				</tbody>
			</table>
		</div>
		
		
	</div>
</div>
<?php 
include('footer.php');
?>
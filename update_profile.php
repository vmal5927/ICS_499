<?php 
    ob_start();
	session_start();
	
	require_once ('db_configuration.php');

	$errors = [];
    if(!isset($_SESSION['user_id'])){
		$errors[] = "You have to log in first.";
	}
	
	if(!isset($_SESSION['role']) || $_SESSION['role'] == '0'){
		$errors[] = "You must be logged in as a manager to access this page";
	}

	$logged_in = isset($_SESSION['user_id'] ) ? 1 : 0;
	if($logged_in){
		$user_id = $_SESSION['user_id'];
		$user = find_user($user_id);
		$manager = $user['role'];
	}
	
	if(isset($_POST['submit'])){
		updateProfile();
		header("Location: modify_profiles.php");
	}
    
    $user_id = $_GET['id'] ?? '';
   
	$query = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
	$result = run_sql($query);
     
	function updateProfile(){
		global $db;
		$user_id = $_POST['user_id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$user_name = $_POST['user_name'];
		$street_address = $_POST['street_address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		  
		$sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`user_name`='$user_name',`street_address`='$street_address',`city`='$city',  `state`='$state',`email`='$email',`phone`='$phone' WHERE `user_id` = '$user_id' LIMIT 1";
		$db->query($sql);
	}

	  function find_user($user_id){
		global $db;
  
		$query = "SELECT `user_id`, `user_name`, `password`, `role` FROM `users` WHERE `user_id` = '$user_id'";
		$result = run_sql($query);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $user;
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<script src="https://kit.fontawesome.com/b66f8991ae.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<link rel="stylesheet" href="css/style.css" />
	<title>Update Profile</title>
</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
		<div class="container">
			<a class="navbar-brand" href="#">Best In Town</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<!-- <form class="form-inline mr-auto">
					<input type="text" class="form-control mr-2" placeholder="Enter Search Term" />
					<button class="btn btn-outline-primary">Search</button>
				</form> -->
				<form class="form-inline mr-auto" action="search.php" method="GET">
					<input type="text" class="form-control mr-2" placeholder="Enter Search Term" name="query" />
					<input class="btn btn-outline-primary" type="submit" value="Search" />
				</form>
				<ul class="navbar-nav">
				<li class="nav-item">
					<?php
						if($logged_in){
							if($manager){
								echo '<a class="nav-link" href="manager_home.php">Home</a>';
							} else {
								echo '<a class="nav-link" href="customer_home.php">Home</a>';
							}
						} else {
							echo '<a class="nav-link" href="index.php">Home</a>';
						}
					?>
                    </li>
					<li class="nav-item">
						<a href="logout.php" class="nav-link">Logout</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="view_inventory.php">Inventory</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="jumbotron text-center text-light">
			<h1 class="display-4">Best In Town</h1>
			<h2 class="display-6">Home Appliance Store</h2>
		</div>
		<div class="card mx-auto my-5" style="width:600px;">
			<div class="card-header mx-auto">
				<h1 class="text-center">Update Profile</h1>
				<h6 style="color: green;">Please Review and Modify Values to Update</h6>
			</div>
			<div class="card-body px-3 mx-auto">
			<?php
	if($errors){
		echo display_errors($errors);
	}
		else{

		  	if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
            echo '<form class="form" action="update_profile.php" method="POST">
                      
			<div class="form-group">
			<label for="user_id">User Id:</label> <br> <input type="text" class="form-control" name="user_id" value="'.$row["user_id"].'" readonly>
		</div>

		<div class="form-group">
			<label for="first_name">First Name:</label> <br> <input type="text" class="form-control"
				name="first_name" value="'.$row["first_name"].'" >
		</div>

		<div class="form-group">
			<label for="last_name">Last Name:</label> <br> <input type="text" class="form-control"
				name="last_name" value="'.$row["last_name"].'" >
		</div>

		<div class="form-group">
			<label for="username">User Name:</label> <br> <input type="text" class="form-control" name="user_name"
				value="'.$row["user_name"].'" >
		</div>
	
		<div class="form-group">
			<label for="street_address">Street_Address</label> <br> <input type="text" class="form-control" name="street_address" value="'.$row["street_address"].'" >
		</div>

		<div class="form-group">
			<label for="city">City</label> <br> <input type="text" class="form-control" name="city"
				value="'.$row["city"].'" >
		</div>

		<div class="form-group">
			<label for="state">State</label> <br> <input type="text" class="form-control" name="state"
				value="'.$row["state"].'" >
		</div>

		<div class="form-group">
			<label for="email">Email</label> <br> <input type="text" class="form-control" name="email"
				value="'.$row["email"].'" >
		</div>

		<div class="form-group">
			<label for="phone">Phone</label> <br> <input type="text" class="form-control" name="phone"
				value="'.$row["phone"].'" >
		</div>
		<br>

			<button type="submit" name="submit" class="btn btn-success btn-sm" style="background:#5CB85C;">OK</button>
			</form>';


			}//end if
			else {
			echo "0 results";
			}//end else
		}
			?>
		</div>
	</div>

	</div>
	<!-- Footer -->
	<footer class="page-footer font-small bg-dark">
		<div class="footer-copyright text-center text-light py-4">
			&copy; <span id="year"></span> Copyright
		</div>
	</footer>
	<!-- Footer -->
	<script src="http://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
	<script>
	$('#year').text(new Date().getFullYear());
	</script>
</body>

</html>
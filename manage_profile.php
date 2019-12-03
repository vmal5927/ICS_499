<?php 
    ob_start();
    session_start();
    
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
    }
    require_once ('db_configuration.php');
    
    $user_id = $_SESSION['user_id'];
  
    if (isset($_GET['update'])){
	  
		$update = $_GET['update'];
		if($update == 0){
			$readonly = 'readonly';
			$href = 'customer_home.php';
			$manage_profile = 'View Profile';
			$message = $_GET['message'] ?? '';
		} elseif($update == 1) {
			$readonly = '';
			$href = 'manage_profile.php?update=2&readonly=readonly';
			$manage_profile = 'Update Profile';
			$message = 'Type new values in the fields you wish to change and press OK button.';
		} elseif($update == 2){
			$readonly = $_GET['readonly'] ?? '';
			$href = 'customer_home.php';
			$manage_profile = 'Update Profile';
			$message = 'Your profile has been updated successfully! Click OK to exit.';
			updateProfile();
		}

        $sql = "SELECT * FROM `users`
                WHERE `user_id` = '$user_id'";
                
        if (!$result = $db->query($sql)) {
            echo 'Something went wrong.';
            die ('There was an error running query[' . $connection->error . ']');
        }//end if
	  }//end if
	  
	  function updateProfile(){
		  global $user_id, $db;
		  $first_name = $_POST['first_name'];
		  $last_name = $_POST['last_name'];
		  $user_name = $_POST['user_name'];
		  $password = $_POST['password'];
		  $street_address = $_POST['street_address'];
		  $city = $_POST['city'];
		  $state = $_POST['state'];
		  $email = $_POST['email'];
		  $phone = $_POST['phone'];

		  $sql = "UPDATE `users` SET `first_name`= '$first_name',`last_name`='$last_name',`user_name`='$user_name',`password`='$password',`street_address`='$street_address',`city`='$city',`state`='$state',`email`='$email',`phone`='$phone' WHERE `user_id` = '$user_id'";
		  $db->query($sql);
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
	<title>Manage Profile</title>
</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
		<div class="container">
			<a class="navbar-brand" href="#">Best In Town</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				 <form class="form-inline mr-auto" action="search.php" method="GET">
					<input type="text" class="form-control mr-2" placeholder="Enter Search Term" name="query" />
					<input class="btn btn-outline-primary" type="submit" value="Search" />
				</form>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
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
				<h1 class="text-center"><?php echo $manage_profile ?></h1>
				<h6 style="color: green;"><?php echo $message ?></h6>
			</div>
			<div class="card-body px-3 mx-auto">
				<?php
 	
  if (isset($_GET['id'])){
	  
	$sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";		
    if (!$result = $db->query($sql)) {
        echo 'Something went wrong.';
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
  }//end if

  	if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
            echo '<form class="needs-validation" action="'.$href.'" method="POST" novalidate>          
            <div class="form-group">
				<label for="first name">First Name:</label> <br> <input type="text" class="form-control" name="first_name" value="'.$row["first_name"].'" '.$readonly.' required>
				<div class="valid-feedback"></div>
                <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="last name">Last Name:</label> <br> <input type="text" class="form-control"
					name="last_name" value="'.$row["last_name"].'" '.$readonly.' required>
					<div class="valid-feedback"></div>
                    <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="user name">User Name:</label> <br> <input type="text" class="form-control" name="user_name"
					value="'.$row["user_name"].'" '.$readonly.' required>
					<div class="valid-feedback"></div>
                    <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="password">Password:</label> <br> <input type="text" class="form-control" name="password"
					value="'.$row["password"].'" '.$readonly.' required>
					<div class="valid-feedback"></div>
                    <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="street address">Street Address</label> <br> <input type="text" class="form-control"
					name="street_address" value="'.$row["street_address"].'" '.$readonly.' required>
					<div class="valid-feedback"></div>
                    <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="city">City</label> <br> <input type="text" class="form-control" name="city" 
				id="city" value="'.$row["city"].'" '.$readonly.' required>
				<div class="valid-feedback"></div>
                <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="state">State</label> <br> <input type="text" class="form-control" name="state"
					id="state" value="'.$row["state"].'" '.$readonly.' required>
				<div class="valid-feedback"></div>
                <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="email">Email</label> <br> <input type="text" class="form-control" name="email"
					value="'.$row["email"].'" '.$readonly.' required>
					<div class="valid-feedback"></div>
                    <div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="form-group">
				<label for="phone">Phone</label> <br> <input type="text" class="form-control" name="phone"
					value="'.$row["phone"].'" '.$readonly.' required>
					<div class="valid-feedback"></div>
                    <div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<br>

			<button type="submit" name="submit" class="btn btn-success btn-sm" style="background:#5CB85C;">OK</button>
			</form>';


			}//end if
			else {
			echo "0 results";
			}//end else

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
	<script>
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
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
<?php 
    ob_start();
	session_start();
	require_once ('db_configuration.php');
	
	$errors = [];
    if(!isset($_SESSION['user_id'])){
	   header('Location: login.php');
	}
	$logged_in = isset($_SESSION['user_id'] ) ? 1 : 0;
	if($logged_in){
		$user_id = $_SESSION['user_id'];
		$user = find_user($user_id);
		$manager = $user['role'];
	}
	if(isset($_POST['submit'])){
		if(isset($_POST['order_id'])){
			$order_id = $_POST['order_id'];
		}
		delete_order();
	}
			
	$order_id = $_GET['id'] ?? '';

	$query = "SELECT ol.item_id, `item_name`, `brand`, `model`, o.order_id, `quantity`, `price`, `customer_id`, `date`, `approval_status`, `delivery_status`, `date` FROM `order_lines` ol, `orders` o, `inventory` i WHERE ol.order_id = o.order_id AND o.order_id = '$order_id' AND customer_id = '$user_id' AND ol.item_id = i.item_id AND `delivery_status` <> '1'";

	$result = run_sql($query);
	
	  function delete_order(){
		global $db, $order_id;
		$query = "DELETE FROM `order_lines` WHERE `order_id` = '$order_id'";
		$result = run_sql($query);
		$query = "DELETE FROM `orders` WHERE `order_id` = '$order_id'";
		header("Location: cancel_orders.php");
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
	<title>Cancel Order Process</title>
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
				<h1 class="text-center">Cancel Order</h1>
				<h6 style="color: green;">Please Review and Confirm Deletion</h6>
			</div>
			<div class="card-body px-3 mx-auto">
	<?php
	if($errors){
		echo display_errors($errors);
	}
		else {

		  	if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
            echo '<form class="form" action="cancel_order_process.php" method="POST">
                      
            <div class="form-group">
                <label for="order_id">Order Id:</label> <br> <input type="text" class="form-control" name="order_id" value="'.$row["order_id"].'" readonly>
			</div>

			<div class="form-group">
				<label for="item_name">Item Name:</label> <br> <input type="text" class="form-control"
					name="item_name" value="'.$row["item_name"].'" readonly>
			</div>

			<div class="form-group">
				<label for="model">Model:</label> <br> <input type="text" class="form-control"
					name="model" value="'.$row["model"].'" readonly>
			</div>

			<div class="form-group">
				<label for="brand">Brand:</label> <br> <input type="text" class="form-control" name="brand"
					value="'.$row["brand"].'" readonly>
			</div>
		
			<div class="form-group">
				<label for="date">Date and Time</label> <br> <input type="text" class="form-control" name="date" value="'.$row["date"].'" readonly>
			</div>

			<div class="form-group">
				<label for="price">Price</label> <br> <input type="text" class="form-control" name="price"
					value="'.$row["price"].'" readonly>
			</div>

			<div class="form-group">
				<label for="quantity">Quantity</label> <br> <input type="text" class="form-control" name="quantity"
					value="'.$row["quantity"].'" readonly>
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
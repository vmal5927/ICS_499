<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/b66f8991ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign up</title>
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Login</a>
                        <div class="dropdown-menu">
                            <a href="sign_up.php" class="dropdown-item">Sign Up</a>
                            <a href="login.php" class="dropdown-item">Log in</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_inventory.php">Inventory</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron text-center text-light">
            <h1 class="display-4">Best In Town</h1>
            <h2 class="display-6">Home Appliance Store</h2>
        </div>

        <?php
        require_once('db_configuration.php');

		//$result = 0;
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$first_name = $_POST['fname'];
			$last_name = $_POST['lname'];
			$user_name = $_POST['uname'];
			$password = $_POST['pswd'];
			$street_address = $_POST['streetaddress'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip_code = $_POST['zip'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			
			$error_message = '';
			$query = "SELECT * FROM `users` WHERE `first_name` = '$first_name' AND `last_name` = '$last_name' AND `user_name` = '$user_name'";
			$result1 = run_sql($query);
			if($result1->num_rows > 0){
				$error_message = 'Failed to register user. The record with such first name, last name, and username already exists. ';
				$result = '0';
			} else {
				$query = "INSERT INTO users (`first_name`, `last_name`, `user_name`, `password`, `street_address`, `city`, `state`, `email`, `phone`) VALUES ('$first_name', '$last_name', '$user_name', '$password', '$street_address', '$city', '$state', '$email', '$phone');";
				$result = run_sql($query);
				$query = "INSERT INTO `zip_codes`(`city`, `state`, `zip`) VALUES ('$city','$state','$zip_code')";
				$result1 = run_sql($query);
			}
			$db -> close();
		
        	if($result){
            	echo '<div class="card">Success! The user has been added.</div>';
			}
			echo '<div class="card text-center text-danger"><h4>'.$error_message.'</h4></div>';
			
			//echo '<div class="card">'.$error_message.'</div>';
		}
        ?>
    </div>
    <!-- Footer -->

    <footer class="fixed-bottom page-footer font-small bg-dark">
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
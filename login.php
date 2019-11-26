<?php require_once('db_configuration.php');
ob_start();
session_start();

$id = $_GET['id'] ?? '0';
$page = $_GET['page'] ?? '';
$errors = [];
$username = '';
$password = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uname'] ?? '';
    $password = $_POST['pswd'] ?? '';

// Validations
    if(!isset($username) || trim($username) === '') {
  $errors[] = "Username cannot be blank.";
    }
    if(!isset($password) || trim($password) === '') {
  $errors[] = "Password cannot be blank.";
    }

    if(empty($errors)){
        $login_failure_msg = "Log in was unsuccessful. Please provide correct username and password.";
        $user = find_user($username);
       // echo '$user["user_name"]';
        if($user) {

            if($password == $user['password']){
                //echo 'password verified ';
               if (log_in_user($user)){
				  // echo $_SESSION['user_id'];
				  //if(isset($id) && $id = 0){
					 
                	$manager = $user['role'];
                	if($manager){
                   	 	header("Location: manager_home.php");
               		 }else{
                   		 header("Location: customer_home.php");
					}
				//}
				// if(isset($page)){
				// 	header("Location: $page");
				// }
               }
                
            }
      
          } //else {
            // no username found
            //$errors[] = $login_failure_msg;
		 // }
		  $errors[] = $login_failure_msg;
    }
}

//functions
/* function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }
 */
  function find_user($username){
      global $db;

      $query = "SELECT `user_id`, `user_name`, `password`, `role` FROM `users` WHERE `user_name` = '$username'";
      $result = run_sql($query);
      $user = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $user;
  }

  function log_in_user($user) {
    // Renerating the ID protects the admin from session fixation.
      session_regenerate_id();
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['last_login'] = time();
	  $_SESSION['username'] = $user['user_name'];
	  $_SESSION['role'] = $user['role'];
      return true;
    }
?>
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
    <title>login</title>
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
                        <a class="nav-link" href="#">Home</a>
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
                        <a class="nav-link" href="#">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
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
        <div class="card mx-auto my-5" style="width:420px">
            <div class="card-header">

                <h1 class="text-center"> Login </h1>
            </div>

            <div class="card-body px-3">
				<?php
				if($errors){
					echo display_errors($errors);
				}
				?>
                <form action="login.php" method="post" class="needs-validation" novalidate>


                    <div class="form-group">

                        <label for="uname">Username:</label>
                        <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname"
                            required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd"
                            required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>



                    <input type="submit" class="btn btn-primary" value="Submit" />
                </form>
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
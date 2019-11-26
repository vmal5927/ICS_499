<?php
    
    ob_start();
	session_start();
	require_once('db_configuration.php');

	$logged_in = isset($_SESSION['user_id'] ) ? 1 : 0;
	if($logged_in){
		$user_id = $_SESSION['user_id'];
		$user = find_user($user_id);
		$manager = $user['role'];
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
    <script
      src="https://kit.fontawesome.com/b66f8991ae.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style.css" />
    <title>About</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
      <div class="container">
        <a class="navbar-brand" href="#">Best In Town</a>
        <button
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarNav"
        >
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
            <!-- <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-toggle="dropdown"
                >Login</a
              >
              <div class="dropdown-menu">
                <a href="sign_up.php" class="dropdown-item">Sign Up</a>
                <a href="login.php" class="dropdown-item">Log in</a>
              </div>
			</li> -->
			<?php if($logged_in){
                            echo '<li class="nav-item">
                                        <a href="logout.php" class="nav-link">Logout</a>
                                 </li>';
                        } else {
                            echo '<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Login</a>  <div class="dropdown-menu">
                            <a href="sign_up.php" class="dropdown-item">Sign Up</a>
                            <a href="login.php" class="dropdown-item">Log in</a>
                        </div> </li>';
                        }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="view_inventory.php">Inventory</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="order.php">Order</a>
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
      <div class="card my-5">
        <div class="card-header">
          <h1 class="text-center m-4">About</h1>
        </div>
        <div class="card-body">
          <p>
            Nisi veniam ut esse consectetur. Deserunt duis ex Lorem aliquip.
            Nulla qui anim tempor nulla sit ad laboris ea elit dolor ad laborum.
            Velit id culpa labore non ea incididunt aliquip tempor. Aliquip quis
            cillum irure laborum ipsum ad laboris.
          </p>

          <p>
            Reprehenderit consectetur exercitation aliquip aute ipsum elit magna
            ipsum eu sit. Do ad dolore dolor enim. Do ipsum sint tempor irure
            officia sint magna laboris.
          </p>

          <p>
            qui incididunt elit in fugiat ad do incididunt aliqua incididunt.
            Est anim eu ex aliquip cupidatat consectetur Lorem nisi eu veniam
            officia. Anim do nostrud mollit minim incididunt. Consectetur
            proident fugiat adipisicing veniam.
          </p>

          <p>
            Sint eu dolore et dolor excepteur elit qui cillum amet consequat
            velit consectetur. Velit occaecat tempor ipsum est deserunt ad
            proident. Sunt Lorem do aute consequat sint culpa est deserunt
            minim. Cillum sint non non sunt esse ullamco dolore consectetur
            veniam velit occaecat incididunt. Commodo cupidatat consequat irure
            aute sit pariatur. Ipsum labore pariatur consequat ad non amet
            mollit adipisicing.
          </p>

          <p>
            Nulla cupidatat ad et laboris nisi. Anim tempor id sunt officia anim
            dolore enim aute velit. Id irure ut enim id mollit nulla laboris non
            sint veniam nulla occaecat aute fugiat.
          </p>
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
    <script
      src="http://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <script>
      $('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>

<?php 
    ob_start();
    session_start();
	require_once ('db_configuration.php');
	
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
	}
	if(!isset($_SESSION['role']) || $_SESSION['role'] == '0'){
		echo 'You must be logged in as a manager to access this page!';
	}
	
	$logged_in = isset($_SESSION['user_id'] ) ? 1 : 0;
	if($logged_in){
		$user_id = $_SESSION['user_id'];
		$user = find_user($user_id);
		$manager = $user['role'];
	}
	
    $query = "SELECT * FROM `inventory`";
	$result = run_sql($query);
	
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <title>Modify Item</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: #ffa343;">Best In Town</a>
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
                        <a class="nav-link" href="about.php" style="color: #ffa343;">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" style="color: #ffa343;">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_inventory.php" style="color: #ffa343;">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" style="color: #ffa343;">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron text-center text-light">
            <h1>Best In Town - Home Appliance Store</h1>
            <h3>Update/Remove Item</h3>
        </div>
        <div class="card my-5">
            <div class="card-header">
                <h1 class="text-center m-4">To Update/Remove an Item click the Corresponding Button</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="inventory_items">
                    <div class="table responsive">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Model</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Update</th>
								<th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
						  if ($result->num_rows > 0) {
                            // output data of each row
                         	while($row = $result->fetch_assoc()) {
                             

                                echo    '<tr>
                                          <!--<td> '.$row["item_id"].'</td>-->
                                        	<td> '.$row["item_id"].'</td>
                                          	<td> '.$row["item_name"]. '</td>
                                          	<td> '.$row["brand"]. '</td>
                                          	<td> '.$row["model"]. '</td>
											<td> '.$row["price"]. '</td>
											<td> '.$row["quantity_in_stock"]. '</td>
										  	<td><a href="update_item.php?id='.$row["item_id"].'"><input
											   class="btn btn-warning" type="button" value="Update Item"></a></td>
											<td><a href="remove_item.php?id='.$row["item_id"].'"><input
										 	  class="btn btn-danger" type="button" value="Remove Item"></a></td>
                                        </tr>';

                            }//end while
                        }//end if
                        else {
                            echo "0 results";
                        }//end else
                        ?>
                        </tbody>
                    </div>
                </table>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small bg-dark mt-5">
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#inventory_items').dataTable();
    });
    </script>
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>
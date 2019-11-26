<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Search</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	<form action="search.php" method="GET">
		<input type="text" name="query" />
		<input type="submit" value="Search" />
	</form>
</body>
</html> -->



<?php
	ob_start();
	session_start();
	require_once('db_configuration.php');
	$logged_in = isset($_SESSION['user_id'] ) ? 1 : 0;
	if($logged_in){
		$manager = $_SESSION['role'];
	}
	//mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
	/*
		localhost - it's location of the mysql server, usually localhost
		root - your username
		third is your password
		
		if connection fails it will stop loading the page and display an error
	*/
	
	//mysql_select_db("tutorial_search") or die(mysql_error());
	/* tutorial_search is the name of database we've created */
?>

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Search results</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body> -->
<?php
	$query = $_GET['query']; 
	// gets value sent over search form
	
	//$min_length = 3;
	// you can set minimum length of the query if you want
	
	//if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
		
		$query = htmlspecialchars($query); 
		// changes characters used in html to their equivalents, for example: < to &gt;
		
		$query = mysqli_real_escape_string($db, $query);
		// makes sure nobody uses SQL injection
		
		// $raw_results = mysql_query("SELECT * FROM articles
		// 	WHERE (`title` LIKE '%".$query."%') OR (`text` LIKE '%".$query."%')") or die(mysql_error());
		$query = "SELECT * FROM inventory
			WHERE (`item_name` LIKE '%".$query."%') OR (`brand` LIKE '%".$query."%') OR (`model` LIKE '%".$query."%')";
		$result = run_sql($query);
		// * means that it selects all fields, you can also write: `id`, `title`, `text`
		// articles is the name of our table
		
		// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
		// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
		// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
		
		// if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
			
		// 	while($results = mysql_fetch_array($raw_results)){
		// 	// $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
			
		// 		echo "<p><h3>".$results['title']."</h3>".$results['text']."</p>";
		// 		// posts results gotten from database(title and text) you can also show id ($results['id'])
		// 	}
			
		// }
		// else{ // if there is no matching rows do following
		// 	echo "No results";
		// }
		
	// }
	// else{ // if query length is less than minimum
	// 	echo "Minimum length is ".$min_length;
	// }
?>
<!-- </body>
</html> -->
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

    <title>Search</title>
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
                        <a class="nav-link" href="about.php">About</a>
                    </li>
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
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
					<?php if($logged_in){
						echo '<li class="nav-item">
						 		<a class="nav-link" href="contact.php">Contact</a>
					 		</li>';
						}
						?>
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
                <h1 class="text-center m-4">Inventory</h1>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
						  if ($result->num_rows > 0) {
                            // output data of each row
                         	while($row = $result->fetch_assoc()) {
                             

                                echo    '<tr>
                                          <td> '.$row["item_id"].'</td>
                                          <td> '.$row["item_name"]. '</td>
                                          <td> '.$row["brand"]. '</td>
                                          <td> '.$row["model"]. '</td>
                                          <td> '.$row["price"]. '</td>
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
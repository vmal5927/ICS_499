<?php 
    ob_start();
    session_start();
    require_once ('db_configuration.php');
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
	}
	$order_id = $_SESSION['order_id'] ?? '';
	//$order_id = $_GET['order_id'] ?? '';
	//$order_id = $_GET['order_id'];
	//echo $order_id;
    //require_once ('db_configuration.php');
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
    <title>Order Form</title>
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
                <h1 class="text-center">Order Item</h1>
                <h6>Fill in quantity, then press Submit Order button</h6>
            </div>
            <div class="card-body px-3 mx-auto">
                <?php
 // include_once 'db_configuration.php';
	
  if (isset($_GET['id'])){
	  
    $item_id = $_GET['id'];
   // echo '$item_id';
    $sql = "SELECT * FROM `inventory`
            WHERE `item_id` = '$item_id'";
     //$query = "SELECT * FROM `inventory` WHERE `item_name` = 'Refrigerator'";
			
    if (!$result = $db->query($sql)) {
        echo 'Something went wrong.';
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
  }//end if

  if ($result->num_rows > 0) {
	//$order_id = $_GET['order_id'] ?? '';
      // output data of each row
      while($row = $result->fetch_assoc()) {
		  //echo $order_id;
            echo '<form class="form" action="create_order_line.php" method="POST">
            <div class="form-group">
              <label for="item_id">Item Id:</label> <br> <input type="text" class="form-control" name="item_id" value="'.$row["item_id"].'" maxlength="50" readonly> 
            </div>
          
            <div class="form-group">
                <label for="item name">Item Name:</label> <br> <input type="text" class="form-control" name="item_name" value="'.$row["item_name"].'"  readonly>
            </div>
          
            <div class="form-group">
              <label for="brand">Brand:</label> <br> 
              <input type="text" class="form-control" name="brand" value="'.$row["brand"].'"  maxlength="255" readonly> 
            </div>
            
            <div class="form-group">
              <label for="model">Model:</label> <br> 
              <input type="text" class="form-control" name="model" value="'.$row["model"].'"  maxlength="255" readonly>
            </div>
             
            <div class="form-group">
              <label for="price">Price:</label> <br> 
              <input type="text" class="form-control" name="price" value="$'.$row["price"].'"  maxlength="255" readonly> 
            </div>
             
            <div class="form-group">
              <label for="quantity">Quantity:</label> <br> 
              <input type="text" class="form-control" name="quantity" value=""  maxlength="4" required> 
            </div>
              <br>
           
              <button type="submit" name="submit" class="btn btn-success btn-sm" style="background:#5CB85C;">Submit Order</button>
			</form>';
			
      }//end while
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
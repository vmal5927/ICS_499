<?php
    require_once('db_configuration.php');

    $id = $_GET['id'] ?? '0';

    switch($id){
        case '0':
            $query = "SELECT * FROM `inventory`";
            break;
        case '1':
            $query = "SELECT * FROM `inventory` WHERE `item_name` = 'Refrigerator'";
            break;
        case '2':
            $query = "SELECT * FROM `inventory` WHERE `item_name` = 'Washer' OR `item_name` = 'Dryer'";
            break;
        case '3':
            $query = "SELECT * FROM `inventory` WHERE `item_name` = 'Range'";
    }
    
	$result = run_sql($query);
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

    <title>About</title>
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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Login</a>
                        <div class="dropdown-menu">
                            <a href="sign_up.php" class="dropdown-item">Sign Up</a>
                            <a href="login.php" class="dropdown-item">Log in</a>
                        </div>
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
                                <!-- <th>Required</th>
                        <th>Optional</th>
                        <th>Cadence</th>
                        <th>Time_lower</th>
                        <th>Time_upper</th>
                        <th>Contains_demo</th>
                        <th>Demo_lead</th>
						<th>Is_optional</th>
                        <th>Is_safe</th>
                        <th>Safe_link</th>
                        <th>Status</th>
                        <th>Comments</th>
						<th>Update Rows</th>
						<th>Delete Rows</th>
						<th>View Rows</th> -->
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
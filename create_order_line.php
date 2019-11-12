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
    <title>Create order line</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="#">Best In Town</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="form-inline mr-auto">
                    <input type="text" class="form-control mr-2" placeholder="Enter Search Term" />
                    <button class="btn btn-outline-primary">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" style="color: #ffa343;">Logout</a>
                    </li>
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

        <?php
        require_once('db_configuration.php');
        ob_start();
        session_start();

        // $first_name = $_POST['fname'];
        // $last_name = $_POST['lname'];
        // $user_name = $_POST['uname'];
        // $password = $_POST['pswd'];
        // $street_address = $_POST['streetaddress'];
        // $city = $_POST['city'];
        // $state = $_POST['state'];
        // $zip_code = $_POST['zip'];
        // $email = $_POST['email'];
        // $phone = $_POST['phone'];

        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];
        $customer_id = $_SESSION['user_id'];
        $query = "INSERT INTO orders (`customer_id`) VALUES ('$customer_id');";
        
       // $date = date_create()->format('M-d-Y');
        // $query = "INSERT INTO orders (`customer_id`, `date`) VALUES ('$customer_id', now();";
        // $query = "INSERT INTO orders (`customer_id`, `date`) VALUES ('$customer_id', DATE_FORMAT(NOW(),'%b-%d-%Y'));";

        // $query = "INSERT INTO users (`first_name`, `last_name`, `user_name`, `password`, `street_address`, `city`, `state`, `email`, `phone`) VALUES ('$first_name', '$last_name', '$user_name', '$password', '$street_address', '$city', '$state', '$email', '$phone');";
        $result = run_sql($query);
        $query = "SELECT `order_id` FROM `orders` ORDER BY `order_id` DESC LIMIT 1;";
        $result = run_sql($query);
        if ($result->num_rows > 0) {
             if($row = $result->fetch_assoc()) {
                $order_id = $row["order_id"];
             }
            }
        $query = "INSERT INTO order_lines (`item_id`, `order_id`, `quantity`) VALUES ('$item_id', '$order_id', '$quantity');";
        $result = run_sql($query);
                // echo    '<tr>
                //           <td> '.$row["item_id"].'</td>
        // $query = "INSERT INTO `zip_codes`(`city`, `state`, `zip`) VALUES ('$city','$state','$zip_code')";
        // $result1 = run_sql($query);
        $db -> close();
       // if($result){
            echo '<div class="card">Success! The order has been added.</div>';
       // }
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
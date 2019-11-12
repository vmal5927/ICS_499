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
    <title>Document</title>
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Login</a>
                        <div class="dropdown-menu">
                            <a href="sign_up.php" class="dropdown-item">Sign Up</a>
                            <a href="login.php?id=1" class="dropdown-item">Log in</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_inventory.php?id=0">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron text-center text-light">
            <h1 class="display-4">Welcome To Best In Town!</h1>
            <h2 class="display-6">Home Appliance Store</h2>
            <br>
            <a class="btn btn-primary btn-lg" href="order.php" role="button">Order Now</a>
        </div>

        <div class="card-deck mb-3">
            <div class="card ">
                <div class="card-body">
                    <h2 class="card-title text-center">Refrigerators</h2>
                </div>
                <img class="card-img-top img-fluid" src="img/Picture2m.jpg" alt="">
                <div class="card-body text-center">
                    <a class="btn btn-primary btn-lg" href="view_inventory.php?id=1">View Selection</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Washers & Driers</h2>
                </div>
                <img class="card-img-top img-fluid" src="img/Picture3m.jpg" alt="">
                <div class="card-body text-center">
                    <a class="btn btn-primary btn-lg" href="view_inventory.php?id=2">View Selection</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Ranges</h2>
                </div>
                <img class="card-img-top img-fluid" src="img/Picture2.png" alt="">
                <div class="card-body text-center">
                    <a class="btn btn-primary btn-lg" href="view_inventory.php?id=3">View Selection</a>
                </div>
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
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
        <div class="card mx-auto my-5" style="width:800px">
            <div class="card-header">

                <h1 class="text-center m-4"> Sign Up </h1>
				<h4 class="text-center">Please fill all fields in the form</h4>
            </div>
           
            <div class="card-body px-3">
                <form action="insert_user.php" method="post" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="col">
                                <label for="fname">First Name:</label>
                                <input type="text" class="form-control" id="fname" placeholder="Enter first name"
                                    name="fname" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="lname">Last Name:</label>
                                <input type="text" class="form-control" id="lname" placeholder="Enter last name"
                                    name="lname" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="col">
                                <label for="uname">Username:</label>
                                <input type="text" class="form-control" id="uname" placeholder="Enter username"
                                    name="uname" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password"
                                    name="pswd" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="col">
                                <label for="streetaddress">Street address:</label>
                                <input type="text" class="form-control" id="srteetaddress" placeholder="Enter username"
                                    name="streetaddress" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="city" placeholder="Enter city"
                                    name="city" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="col">
                                <label for="state">State:</label>
                                <input type="text" class="form-control" id="state" placeholder="Enter state"
                                    name="state" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="zip">Zip code:</label>
                                <input type="text" class="form-control" id="zip" placeholder="Enter zip code" name="zip"
                                    required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="col">
                                <label for="state">Email:</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter email"
                                    name="email" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="zip">Phone:</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter phone"
                                    name="phone" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label" id="tclabel">
                            <input class="form-check-input" type="checkbox" name="remember" required> By creating an
                            account, you agree to our terms and conditions
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Check this checkbox to continue.</div>
                        </label>
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
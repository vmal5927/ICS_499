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
    <title>manager_home</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: #ffa343;">Best In Town</a>
            <button class=" navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="form-inline mr-auto">
                    <input type="text" class="form-control mr-2" placeholder="Enter Search Term" />
                    <button class="btn btn-outline-primary">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link" style="color: #ffa343;">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #ffa343;">Inventory</a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link" href="#" style="color: #ffa343;">Order</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron text-center text-light">
            <h1>Best In Town - Home Appliance Store</h1>
            <h3>Managers Home Page</h3>
        </div>
        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <img class="card-img-top img-fluid" src="img/Picture1.jpg" alt="">
                </div>
            </div>
            <div id="accordion" style="width: 300px;">
                <div class="card bg-secondary">
                    <div class="card-header text-light text-center">
                        <h2>Menu</h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-info">
                        <a class="card-link text-light" data-toggle="collapse" href="#collapseOne">
                            Inventory
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn btn-primary" style="width: 200px;" href="#"> View Inventory</a>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn btn-success" style="width: 200px;" href="#">Search Inventory</a>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn " style="width: 200px; background-color: #4B0082; color: white;" href="#">Add
                                Item</a>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn btn-danger" style="width: 200px;" href="#">Update/Remomve Item</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-info">
                        <a class="collapsed card-link text-light" data-toggle="collapse" href="#collapseTwo">
                            Orders
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn" style="background-color: #8A2BE2; color: white; width: 130px;" href="#">View
                                Orders</a>
                        </div>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn btn-success" style="width: 130px;" href="#">Search Orders</a>
                        </div>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn btn-danger" style="width: 130px;" href="#">Update Orders</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-info">
                        <a class="collapsed card-link text-light" data-toggle="collapse" href="#collapseThree">
                            Users
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn btn-success" style="width: 185px;" href="#">View Profiles</a>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <a class="btn" style="background-color: #8A2BE2; color: white;" href="#">Update/Delete
                                Profiles</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <img class="card-img-top img-fluid" src="img/Appliances.jpg" alt="">
                </div>
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
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>
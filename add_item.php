

<?php
	ob_start();
	session_start();
    //Database connection
    require_once('db_configuration.php');

	$logged_in = isset($_SESSION['user_id'] ) ? 1 : 0;
	if(!$logged_in || $_SESSION['role'] != 1){
		header("Location: login.php");
	}
    //Get input from add_item_form.php by POST methed. 
    $item_name = $_POST['item_name'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
        


    //Insert inputs from add_item_form.php file
    $query = "INSERT INTO inventory (`item_name`, `brand`, `model`, `price`, `quantity_in_stock`)
     VALUES ('$item_name', '$brand', '$model', '$price', '$qty');";
     $result = run_sql($query);

    $db -> close();
    if($result){
        header("Location: view_inventory.php");
    }
     else header("Location: add_item_form.php");
?>
    
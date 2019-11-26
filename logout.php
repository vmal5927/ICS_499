<?php
    ob_start();
    session_start();

    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
	unset($_SESSION['username']);
	unset($_SESSION['order_id']);

    header("Location: index.php");
?>
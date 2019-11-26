<?php
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'home_appliance_store');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');

$order_id = $order_id ?? '';
$db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
$db->set_charset("utf8");
function run_sql($sql_script)
{
    global $db;
    // check connection
    if ($db->connect_error)
    {
        trigger_error(print_r(debug_backtrace()).'.Database connection failed: '  . $db->connect_error, E_USER_ERROR);
    }
    else
    {
        $result = $db->query($sql_script);
        if($result === false)
        {
            trigger_error('Stack Trace: '.print_r(debug_backtrace()).'Invalid SQL: ' . $sql_script . '; Error: ' . $db->error, E_USER_ERROR);
        }
        else if(strpos($sql_script, "INSERT")!== false)
        {
            return $db->insert_id;
        }
        else
        {
            return $result;
        }
    }
}

function display_errors($errors=array()) {
	$output = '';
	if(!empty($errors)) {
	  $output .= "<div class=\"errors\">";
	  $output .= "The following errors have occurred:";
	  $output .= "<ul>";
	  foreach($errors as $error) {
		$output .= "<li>" . htmlspecialchars($error) . "</li>";
	  }
	  $output .= "</ul>";
	  $output .= "</div>";
	}
	return $output;
  }
?>
<?php
	
	session_start();
	
	if(!$_SESSION['logged']){
	    header("Location: login.php");
	    die;
	}

	$session_user_id = $_SESSION['user_id'];

	$sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = $session_user_id");
	$row = mysqli_fetch_array($sql);
	$session_username = ucwords($row['username']);
	$session_user_first_name = ucwords($row['user_first_name']);
	$session_user_last_name = ucwords($row['user_last_name']);
	$session_security_level = $row['security_level'];
	$session_avatar = $row['avatar'];
	$session_location_id = $row['location'];

	$sql = mysqli_query($mysqli,"SELECT * FROM locations WHERE location_id = $session_location_id");
	$row = mysqli_fetch_array($sql);
	$session_location = $row['location'];


	$session_security = 0;

    //$message_count = mysql_num_rows(mysql_query("SELECT * FROM messages WHERE message_to = $session_user_id AND message_active = 1"));

    // Check to see if employee is clocked in or out

	$date = date("U");
	mysqli_query($mysqli,"UPDATE users SET online = '$date' WHERE user_id = '$session_user_id'");


	$date_from = strtotime('today');
	$date_to = strtotime('today 23:59');
	$clock_status = "unknown";
	$clock_in  = 0;

	    $sql = mysqli_query($mysqli,"SELECT * FROM employee_clockin_clockout
	                    WHERE clock_in >= '$date_from' AND clock_in <= '$date_to'
	                  AND user_id = $session_user_id
	                  ORDER BY clock_id DESC limit 1");

	        if (mysqli_num_rows($sql) == 0){
	          $clock_status='Clockin';
	           $clock_id = 0;
	          }else{

	            $row = mysqli_fetch_array($sql);
	            $user_id = $row['user_id'];
	            $clock_id = $row['clock_id'];
	            $clock_in = $row['clock_in'];
	            $clock_out = $row['clock_out'];

	             if ($clock_out == 0){
	              $clock_status = 'Clockout';
	             }else{ 
	              $clock_status='Clockout for the day';
	             }
	        }
  
?>
<?php

include "config.php";    
include "includes/check_login.php";

if(isset($_POST['add_customer'])){
	$company = ucwords(strtolower($_POST['company']));
	$first_name = ucwords(strtolower($_POST['first_name']));
	$last_name = ucwords(strtolower($_POST["last_name"]));
	$address = ucwords(strtolower($_POST["address"]));
	$city = ucwords(strtolower($_POST["city"]));
	$state = strtoupper($_POST["state"]);
	$zip = $_POST['zip'];
	$phone = preg_replace("/[^0-9]/", '',$_POST["phone"]);
	$mobile = preg_replace("/[^0-9]/", '',$_POST["mobile"]);
	$email = strtolower($_POST["email"]); 

	$sql = mysqli_query($mysqli,"INSERT INTO customers SET  company = '$company', first_name = '$first_name', last_name = '$last_name', address = '$address', city = '$city', state = '$state', zip = '$zip', phone = '$phone', mobile = '$mobile', email = '$email', date_added = UNIX_TIMESTAMP(now())");
	
	echo "<div class='alert alert-info'>Customer <strong>$first_name $last_name</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>"; 
}

if(isset($_POST['edit_customer'])){
	$id = intval($_POST['id']);
	$company = mysqli_real_escape_string($mysqli,ucwords(strtolower($_POST['company'])));
	$first_name = mysqli_real_escape_string($mysqli,ucwords(strtolower($_POST['first_name'])));
	$last_name = mysqli_real_escape_string($mysqli,ucwords(strtolower($_POST["last_name"])));
	$address = mysqli_real_escape_string($mysqli,ucwords(strtolower($_POST["address"])));
	$city = mysqli_real_escape_string($mysqli,ucwords(strtolower($_POST["city"])));
	$state = mysqli_real_escape_string($mysqli,strtoupper($_POST["state"]));
	$zip = mysqli_real_escape_string($mysqli,$_POST['zip']);
	$phone = mysqli_real_escape_string($mysqli,preg_replace("/[^0-9]/", '',$_POST["phone"]));
	$mobile = mysqli_real_escape_string($mysqli,preg_replace("/[^0-9]/", '',$_POST["mobile"]));
	$email = mysqli_real_escape_string($mysqli,strtolower($_POST["email"]));

	$sql = mysqli_query($mysqli,"UPDATE customers SET company = '$company', first_name = '$first_name', last_name = '$last_name', address = '$address', city = '$city', state = '$state', zip = '$zip', phone = '$phone', mobile = '$mobile', email = '$email' WHERE customer_id = $id");

	echo "<div class='alert alert-info'>User <strong>$first_name $last_name</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['add_user'])){
	$username = mysqli_real_escape_string($mysqli,$_POST['username']);
	$password = mysqli_real_escape_string($mysqli,$_POST['password']);
	$email = mysqli_real_escape_string($mysqli,$_POST['email']);
	$first_name = mysqli_real_escape_string($mysqli,$_POST['first_name']);
	$last_name = mysqli_real_escape_string($mysqli,$_POST['last_name']);
	$security_level = mysqli_real_escape_string($mysqli,$_POST['security_level']);
	$location = mysqli_real_escape_string($mysqli,$_POST['location']);

	$sql = mysqli_query($mysqli,"INSERT INTO users SET user_id = NULL, username = '$username', password = '$password', user_first_name = '$first_name', user_last_name = '$last_name', user_email = '$email', user_date_added = UNIX_TIMESTAMP(now()), security_level = $security_level, avatar = 'img/avatars/anon.png', location = $location, start_page = 'dashboard.php'");

	echo "<div class='alert alert-info'>User <strong>$username</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['edit_user'])){
	$id = intval($_POST['id']);
	$username = mysqli_real_escape_string($mysqli,$_POST['username']);
	$password = mysqli_real_escape_string($mysqli,$_POST['password']);
  	$email = mysqli_real_escape_string($mysqli,$_POST['email']);
  	$first_name = mysqli_real_escape_string($mysqli,$_POST['first_name']);
  	$last_name = mysqli_real_escape_string($mysqli,$_POST['last_name']);
  	$security_level = mysqli_real_escape_string($mysqli,$_POST['security_level']);
  	$location = mysqli_real_escape_string($mysqli,$_POST['location']);
  	$avatar = mysqli_real_escape_string($mysqli,$_POST['avatar']);
  	
  	$sql = mysqli_query($mysqli,"UPDATE users SET username = '$username', password = '$password', user_email = '$email', user_first_name = '$first_name', user_last_name = '$last_name', security_level = $security_level, location = $location, avatar = '$avatar' WHERE user_id = $id");
  	
  	echo "<div class='alert alert-info'>User <strong>$username</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['change_user_preferences'])){
	$id = intval($_POST['id']);
	$username = mysqli_real_escape_string($mysqli,$_POST['username']);
	$email = mysqli_real_escape_string($mysqli,$_POST['email']);
	$password = mysqli_real_escape_string($mysqli,$_POST['password']);
	$avatar = mysqli_real_escape_string($mysqli,$_POST['avatar']);
	$start_page = mysqli_real_escape_string($mysqli,$_POST['start_page']);
	
	$sql = mysqli_query($mysqli,"UPDATE users SET username = '$username', user_email = '$email', password = '$password', avatar = '$avatar', start_page = '$start_page' WHERE user_id = $id");
	
	echo "<div class='alert alert-info'>User preferences updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['add_location'])){
	$location = mysqli_real_escape_string($mysqli,$_POST['location']);

	$sql = mysqli_query($mysqli,"INSERT INTO locations SET location_id = NULL, location = '$location', active = 1");

	echo "<div class='alert alert-info'>Location <strong>$location</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['edit_location'])){
	$id = intval($_POST['id']);
	$location = mysqli_real_escape_string($mysqli,$_POST['location']);

	$sql = mysqli_query($mysqli,"UPDATE locations SET location = '$location' WHERE location_id = $id");

	echo "<div class='alert alert-info'>Location <strong>$location</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['delete_location'])){
    $id = intval($_GET['delete_location']);

    $sql = mysqli_query($mysqli,"UPDATE locations SET active = 0 WHERE location_id = $id");

    echo "<div class='alert alert-warning'>Location removed.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['add_computer'])){
	$system_number = mysqli_real_escape_string($mysqli,$_POST['system_number']);
	$type = mysqli_real_escape_string($mysqli,$_POST['type']);
	$make = mysqli_real_escape_string($mysqli,$_POST['make']);
	$model = ucwords(mysqli_real_escape_string($mysqli,$_POST['model']));
	$serial = strtoupper(mysqli_real_escape_string($mysqli,$_POST['serial']));
	$os = mysqli_real_escape_string($mysqli,$_POST['os']);
	$coa = mysqli_real_escape_string($mysqli,$_POST['coa']);
	$processor = mysqli_real_escape_string($mysqli,$_POST['processor']);
	$memory = $_POST['memory'];
	$hard_drive = $_POST['hard_drive'];
	$price = $_POST['price'];
	$notes = $_POST['notes'];

	$sql = mysqli_query($mysqli,"SELECT serial FROM computers WHERE serial = '$serial'");
	$num_rows = mysqli_num_rows($sql);
	if($num_rows == 0){
		mysqli_query($mysqli,"INSERT INTO computers SET computer_id = NULL, system_number = '$system_number', location = $session_location_id, type = '$type', make = '$make', model = '$model', serial = '$serial', os = '$os', coa = '$coa', processor = '$processor', memory = $memory, hard_drive = $hard_drive, price = $price, status = 'stock', notes = '$notes', employee = $session_user_id, date_added = UNIX_TIMESTAMP(now())");
	

		if ((isset($_POST['save_template'])) and $_POST['save_template'] == "on"){   
			mysqli_query($mysqli,"INSERT INTO computer_templates SET type = '$type', make = '$make', model = '$model',  os = '$os', processor = '$processor', memory = $memory, hard_drive = $hard_drive, price = $price");

		}	

		echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";	
		$computer_id = mysqli_insert_id($mysqli);
	}else{
		echo "<div class='alert alert-danger'>Computer <strong>$make $model</strong> with same serial number of <strong>$serial</strong> and System Number $system_number already exists.<button class='close' data-dismiss='alert'>&times;</button></div>";
	}
}

if(isset($_POST['edit_computer'])){
	$id = intval($_POST['id']);
	$system_number = mysqli_real_escape_string($mysqli,$_POST['system_number']);
	$type = mysqli_real_escape_string($mysqli,$_POST['type']);
	$make = mysqli_real_escape_string($mysqli,$_POST['make']);
	$model = ucwords(mysqli_real_escape_string($mysqli,$_POST['model']));
	$serial = strtoupper(mysqli_real_escape_string($mysqli,$_POST['serial']));
	$os = mysqli_real_escape_string($mysqli,$_POST['os']);
	$coa = mysqli_real_escape_string($mysqli,$_POST['coa']);
	$processor = mysqli_real_escape_string($mysqli,$_POST['processor']);
	$memory = $_POST['memory'];
	$hard_drive = $_POST['hard_drive'];
	$price = $_POST['price'];
	$status = mysqli_real_escape_string($mysqli,$_POST['status']);
	$notes = mysqli_real_escape_string($mysqli,$_POST['notes']);
	$location_id = intval($_POST['location']);

	mysqli_query($mysqli,"UPDATE computers SET system_number = '$system_number', make = '$make', model = '$model', serial = '$serial', coa = '$coa', os = '$os', processor = '$processor', memory = $memory, hard_drive = $hard_drive, price = $price, status = '$status', notes = '$notes', location = $location_id WHERE computer_id = $id");

	echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['delete_computer_template'])){
	$id = intval($_GET['delete_computer_template']);

	$sql = mysqli_query($mysqli,"DELETE FROM computer_templates WHERE computer_template_id = $id");

	echo "<div class='alert alert-warning'>Computer Template removed.<button class='close' data-dismiss='alert'>&times;</button></div>";
}
  

if(isset($_GET['delete_computer'])){
	$id = intval($_GET['delete_computer']);

	$sql = mysqli_query($mysqli,"UPDATE inventory SET active = 0 WHERE inventory_id = $id");

	echo "<div class='alert alert-warning'>Computer removed.<button class='close' data-dismiss='alert'>&times;</button></div>";
}
  

if(isset($_GET['delete_work_order_note'])){
	$id = intval($_GET['delete_work_order_note']);

	$sql = mysqli_query($mysqli,"UPDATE work_order_notes SET active = 0, date_modified = UNIX_TIMESTAMP(now()), modified_by = $session_user_id WHERE work_order_note_id = $id");

	echo "<div class='alert alert-warning'>Note Deleted.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['delete_customer_note'])){
    $id = intval($_GET['delete_customer_note']);
    
    $sql = mysqli_query($mysqli,"UPDATE customer_notes SET active = 0, date_modified = UNIX_TIMESTAMP(now()), modified_by = $session_user_id WHERE customer_note_id = $id");

    echo "<div class='alert alert-warning'>Note Deleted.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['add_common'])){
	$category = intval($_POST['category']);
	$name = mysqli_real_escape_string($mysqli,$_POST['name']);

	$sql = mysqli_query($mysqli,"INSERT INTO commons SET common_id = NULL, category_id = $category, value = '$name'");

	echo "<div class='alert alert-info'>Common <strong>$name</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['edit_common'])){
	$common_id = intval($_POST['common_id']);
	$category = intval($_POST['category']);
	$name = mysqli_real_escape_string($mysqli,$_POST['name']);

	$sql = mysqli_query($mysqli,"UPDATE commons SET category_id = $category, value = '$name' WHERE common_id = $common_id");

	echo "<div class='alert alert-info'>Common <strong>$name $category $common_id</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

//ADD SALE POST CODE
if(isset($_POST['new_sale'])){ 
    $customer_id = intval($_POST['customer_id']);
    $system_number = strtoupper($_POST['system_number']);
    $warranty = intval($_POST['warranty']);
    $date_of_sale = strtotime($_POST['date_of_sale']);
    
    if($date_of_sale == ''){
     	$date_of_sale = time();
    }
    
    $sql = mysqli_query($mysqli,"SELECT * FROM computers WHERE system_number = '$system_number'");
    $row = mysqli_fetch_array($sql); 
      
    $computer_id = $row['computer_id'];
    $status = $row['status'];
      
    if($status == ''){  
      
    	echo "<div class='alert alert-warning'><p><strong>Computer $system_number</strong> Does not Exist!</p></div>";
    
    }elseif($status == 'sold'){
        $sql = mysqli_query($mysqli,"SELECT * FROM computers, users, computer_sales, customers 
	        WHERE computer_sales.customer_id = customers.customer_id
	        AND computers.computer_id = $computer_id 
	        AND computer_sales.computer_id = $computer_id 
	        AND users.user_id = computer_sales.employee_id"
        );

        $row = mysqli_fetch_array($sql);
        $customer_num = $row['customer_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $username = ucwords($row['username']);
        $sale_date = $row['sale_date'];
        $sale_date = date('F d, g:i a', $row['sale_date']);
            
        echo "
	        <div class='alert alert-warning'>
	        	<p><strong>Computer $system_number</strong> Has been sold to <a href='customer_details.php?id=$customer_num'>$first_name $last_name</a> $sale_date_rel on $sale_date by $username</p>
	        </div>
        ";      
    }else{
	   	mysqli_query($mysqli,"INSERT INTO computer_sales SET sale_id = NULL, sale_date = $date_of_sale, warranty = $warranty, computer_id = $computer_id, employee_id = $session_user_id, customer_id = $customer_id, location_id = $session_location_id");

	    $sale_id = mysqli_insert_id($mysqli);

	    mysqli_query($mysqli,"UPDATE computers SET status = 'sold' WHERE computer_id = $computer_id");
	      
	    echo "
	        <div class='alert alert-info'>
	        	<p><strong>Computer $system_number</strong> Sale Completed! <a href='print_sales_agreement.php?id=$sale_id' target='_blank'>PRINT SALES AGREEMENT</a></p>
	        </div>
	    ";
    }
}

//COMPUTER RETURN POST CODE
if(isset($_GET['computer_return'])){
	$sale_id = intval($_GET['computer_return']);
    $reason = mysqli_real_escape_string($mysqli,$_GET['reason']);

    $sql = mysqli_query($mysqli,"SELECT * FROM computer_sales WHERE sale_id = $sale_id");

    $row = mysqli_fetch_array($sql);
    $computer_id = $row['computer_id'];
    $sale_date = $row['sale_date'];
    $sales_person = $row['employee_id'];
    $customer_id = $row['customer_id'];
   
    mysqli_query($mysqli,"INSERT INTO computer_returns SET return_id = NULL, reason = '$reason', return_date = UNIX_TIMESTAMP(now()), customer_id = $customer_id, computer_id = $computer_id, employee_id = $session_user_id, store_id = $session_location_id, sale_date = $sale_date, sales_person = $sales_person");
    mysqli_query($mysqli,"DELETE FROM computer_sales WHERE sale_id = $sale_id");
	mysqli_query($mysqli,"UPDATE computers SET status = 'returned' WHERE computer_id = $computer_id");
	
	echo "
    	<div class='alert alert-success'>
    		<p><strong>Computer Returned!</strong></p>
    	</div>
   	";
}

//EXTEND WARRANTY
if(isset($_GET['extend_warranty'])){
	$id = intval($_GET['extend_warranty']);
	$warranty = $_GET['warranty'];
   
	mysqli_query($mysqli,"UPDATE computer_sales SET warranty = $warranty WHERE sale_id = $id");
	
	echo "
    	<div class='alert alert-info'>
    		<p><strong>Warranty has been extended!<br>please print a New Sales Agreement for the customer.</strong></p>
    	</div>
   	";
}

if(isset($_POST['new_customer_note'])){
    $customer_id = $_POST['customer_id'];
    $note = mysqli_real_escape_string($mysqli,$_POST['note']);

    $sql = mysqli_query($mysqli,"INSERT INTO customer_notes SET customer_note_id = NULL, note = '$note', date_added = UNIX_TIMESTAMP(now()), employee = $session_user_id, customer = $customer_id, active = 1");

    echo "<div class='alert alert-info'>Note <strong>$note</strong> made.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['new_work_order_note'])){
    $id = intval($_POST['work_order_id']);
    $note = mysqli_real_escape_string($mysqli,$_POST['note']);

    $sql = mysqli_query($mysqli,"INSERT INTO work_order_notes SET work_order_note_id = NULL, work_order_id = $id, employee = $session_user_id, date_added = UNIX_TIMESTAMP(now()), note = '$note', active = 1");   
}

if(isset($_GET['edit_customer_note'])){
    $id = intval($_GET['edit_customer_note']);
    $note = mysqli_real_escape_string($mysqli,$_GET['note']);

    $sql = mysqli_query($mysqli,"UPDATE customer_notes SET note = '$note', date_modified = UNIX_TIMESTAMP(now()), modified_by = $session_user_id WHERE customer_note_id = $id");

    echo "<div class='alert alert-info'>Note <strong>$note</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['edit_work_order_note'])){
    $id = intval($_GET['edit_work_order_note']);
    $note = mysqli_real_escape_string($mysqli,$_GET['note']);

    $sql = mysqli_query($mysqli,"UPDATE work_order_notes SET note = '$note', date_modified = UNIX_TIMESTAMP(now()), modified_by = $session_user_id WHERE work_order_note_id = $id");
}

if(isset($_POST['new_work_order'])){
	$customer_id = intval($_POST['customer_id']);
	$scope = mysqli_real_escape_string($mysqli,$_POST['scope']);
	$asset_type = mysqli_real_escape_string($mysqli,$_POST['asset_type']);
	$make = mysqli_real_escape_string($mysqli,$_POST['make']);
	$model = ucwords(mysqli_real_escape_string($mysqli,$_POST['model']));
	$serial = strtoupper(mysqli_real_escape_string($mysqli,$_POST['serial']));
	$takein_notes = mysqli_real_escape_string($mysqli,$_POST['takein_notes']);

	mysqli_query($mysqli,"INSERT INTO work_orders SET work_order_id = NULL, work_order_type = '$scope', type = '$asset_type', make = '$make', model = '$model', serial = '$serial', work_order_status = 'To Be Inspected', description = '$takein_notes', take_in_date = UNIX_TIMESTAMP(now()), take_in_employee = $session_user_id, customer_id = $customer_id, location_id = $session_location_id");
	
	echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['new_inside_work_order'])){
	$customer_id = intval($_GET['customer_id']);
	$scope = mysqli_real_escape_string($mysqli,$_GET['scope']);
	$type = mysqli_real_escape_string($mysqli,$_GET['type']);
	$make = mysqli_real_escape_string($mysqli,$_GET['make']);
	$model = ucwords(mysqli_real_escape_string($mysqli,$_GET['model']));
	$serial = strtoupper(mysqli_real_escape_string($mysqli,$_GET['serial']));
	$takein_notes = mysqli_real_escape_string($mysqli,$_GET['takein_notes']);

	mysqli_query($mysqli,"INSERT INTO work_orders SET work_order_type = '$scope', type = '$type', make = '$make', model = '$model', serial = '$serial', work_order_status = 'To Be Inspected', description = '$takein_notes', take_in_date = UNIX_TIMESTAMP(now()), take_in_employee = $session_user_id, customer_id = $customer_id, location_id = $session_location_id");
	
	echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['edit_work_order'])){
	$id = intval($_POST['id']);
	$scope = mysqli_real_escape_string($mysqli,$_POST['scope']);
	$type = mysqli_real_escape_string($mysqli,$_POST['type']);
	$make = mysqli_real_escape_string($mysqli,$_POST['make']);
	$model = ucwords(mysqli_real_escape_string($mysqli,$_POST['model']));
	$serial = strtoupper(mysqli_real_escape_string($mysqli,$_POST['serial']));
	$description = mysqli_real_escape_string($mysqli,$_POST['description']);

	mysqli_query($mysqli,"UPDATE work_orders SET work_order_type = '$scope', type = '$type', make = '$make', model = '$model', serial = '$serial', description = '$description' WHERE work_order_id = $id");

	echo "<div class='alert alert-info'>Workorder updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['update_work_order_status'])){
	$id = intval($_GET['id']);
	$status = mysqli_real_escape_string($mysqli,$_GET['status']);

	mysqli_query($mysqli,"UPDATE work_orders SET work_order_status = '$status' WHERE work_order_id = $id");
	mysqli_query($mysqli,"INSERT INTO work_order_notes SET work_order_id = $id, employee = $session_user_id, date_added = UNIX_TIMESTAMP(now()), note = '$status', active = 1");
	echo "<div class='alert alert-info'>Work Order Status has been updated. <button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['send_message'])){
	$message = mysqli_real_escape_string($mysqli,$_POST['message']);
	$message_to = $_POST['message_to'];

	$sql = mysqli_query($mysqli,"INSERT INTO messages SET message = '$message', message_to = $message_to, message_from = $session_user_id, sent_timestamp = UNIX_TIMESTAMP(now()), message_active = 1");

	echo "<div class='alert alert-info'>Message <strong>Sent</strong>!<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['change_print_label_status'])){
	$id = intval($_GET['id']);      
	mysqli_query($mysqli,"UPDATE computers SET label_printed = 1 WHERE computer_id = $id");  
}

if(isset($_GET['clock_id'])){
	$clock_id = intval($_GET["clock_id"]);
  	if($clock_id == 0){
    	$sql = "INSERT INTO employee_clockin_clockout SET user_id = $session_user_id, store_id = $session_location_id, clock_in = UNIX_TIMESTAMP(now())";
    	mysqli_query($mysqli,$sql);
		$clock = date('F d, g:i a');
		echo "<div class='alert alert-info'>You clocked in at $clock <button class='close' data-dismiss='alert'>&times;</button></div>";
  	}else{
      	$sql = "UPDATE employee_clockin_clockout SET clock_out = UNIX_TIMESTAMP(now()) WHERE clock_id = $clock_id";
      	mysqli_query($mysqli,$sql);
      	$clock = date('F d, g:i a');
      	echo "<div class='alert alert-info'>You clocked out at $clock <button class='close' data-dismiss='alert'>&times;</button></div>";
  	}
}


if(isset($_REQUEST['modify_clock_in'])){	
    $clock_in_date = $_REQUEST['clock_in_date'];
    $clock_in_time = $_REQUEST['value'];
    $clock_in_id = $_REQUEST['clock_in_id'];

	$clock_in_time = strtotime($clock_in_time." ".$clock_in_date);
	$sql = "update employee_clockin_clockout set clock_in='$clock_in_time' where clock_id = '$clock_in_id'"; 
	mysqli_query($mysqli,$sql);
}

if(isset($_REQUEST['modify_clock_out'])){ 
    $clock_out_date = $_REQUEST['clock_out_date'];
    $clock_out_time = $_REQUEST['value'];
    $clock_out_id = $_REQUEST['clock_out_id'];

	$clock_out_time = strtotime($clock_out_time." ".$clock_out_date);
	$sql = "update employee_clockin_clockout set clock_out='$clock_out_time' where clock_id = '$clock_out_id'"; 
	mysqli_query($mysqli,$sql);
}

if(isset($_REQUEST['add_clock_in'])){ 
    $clock_in_date = $_REQUEST['add_clock_in'];
    $clock_in_time = $_REQUEST['value'];
	$clock_in_time = strtotime($clock_in_date." ".$clock_in_time);
	//$sql = "INSERT INTO employee_clockin_clockout VALUES('','$session_user_id','$session_location_id','$clock_in_time','','')";


	$sql = "INSERT INTO employee_clockin_clockout SET user_id = $session_user_id, store_id = $session_location_id, clock_in = $clock_in_time";
    mysqli_query($mysqli,$sql);

}

if(isset($_POST['transfer_sale'])){
	$customer_id = intval($_POST['customer_id']);
	$sale_id = intval($_POST['sale_id']);
  	
  	$sql = mysqli_query($mysqli,"UPDATE computer_sales SET customer_id = $customer_id WHERE sale_id = $sale_id");
  	
  	echo "<div class='alert alert-info'>Sale Transferred.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['transfer_work_order'])){
	echo "<script>alert();</script>";

	$customer_id = intval($_POST['customer_id']);
	$work_order_id = intval($_POST['work_order_id']);
  	
  	$sql = mysqli_query($mysqli,"UPDATE work_orders SET customer_id = $customer_id WHERE work_order_id = $work_order_id");
  	
  	echo "<div class='alert alert-info'>Work Order Transferred.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

?>
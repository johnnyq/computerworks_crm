<?php 
	
include "config.php";
include "includes/check_login.php";
include "includes/functions.php";

if(isset($_GET['q'])){
	$q = $_GET['q'];
	if(strlen($q) > 1){
		$sql = mysqli_query($mysqli,"SELECT * FROM customers
					WHERE company LIKE '%$q%'
					OR last_name LIKE '%$q%' 
					OR first_name LIKE '%$q%'
					OR CONCAT(first_name,' ',last_name) LIKE '%$q%'
					OR email LIKE '%$q%'
					OR address LIKE '%$q%'
					OR city LIKE '%$q%'
					OR state LIKE '%$q%'
					OR zip LIKE '%$q%'
					OR phone LIKE '%$q%'
					OR email LIKE '%$q%'
					ORDER BY customer_id DESC LIMIT 5"
		);
		$num = mysqli_num_rows($sql);
		if($num > 0){

?>
		
			<table class="table">	
				<legend>Customers</legend>
				<thead>	
					<tr>	
						<th>Name</th>
						<th>Address</th>
						<th>Contact</th>
						<th>Created</th>
						<th>Stats</th>
					</tr>
				</thead>
				<tbody>
						
<?php
				
				while($row = mysqli_fetch_array($sql)){
					$id = $row['customer_id'];
					$company = $row['company'];
					$last_name = ucwords($row['last_name']);
					$first_name = ucwords($row['first_name']);
					$address = ucwords($row['address']);
					$city = $row['city'];
					$state = $row['state'];
					$zip = $row['zip'];
					$phone = $row['phone'];
					if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
					$email = $row['email'];
					$human_time = human_time($row['date_added']);
					$date_added = date($date_format,$row['date_added']);     
					$total_sales = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales WHERE customer_id = $id"));
	                if($total_sales > 0){
	                	$display_sales = "$total_sales <i class='glyphicon glyphicon-shopping-cart'></i>";
	                }else{
	                	$display_sales = '';
	                }
	                $total_returns = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_returns WHERE customer_id = $id"));
	                if($total_returns > 0){
	                	$display_returns = "$total_returns <i class='glyphicon glyphicon-refresh'></i>";
	                }else{
	                	$display_returns = '';
	                }
	                $total_work_orders = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE customer_id = $id"));
	                if($total_work_orders > 0){
	                	$display_work_orders = "$total_work_orders <i class='glyphicon glyphicon-wrench'></i>";
	                }else{
	                	$display_work_orders = '';
	                }
	                $total_customer_notes = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM customer_notes WHERE customer = $id"));
	                if($total_customer_notes > 0){
	                	$display_customer_notes = "$total_customer_notes <i class='glyphicon glyphicon-pencil'></i>";
	                }else{
	                	$display_customer_notes = '';
	                }
					echo "
						<tr>
							<td><a href='customer_details.php?id=$id'>$first_name $last_name $company</a></td>
							<td>$address<br><small>$city $state $zip</small></td>
							<td>$phone<br><small>$email</small></td>
							<td>$human_time</td>
							<td>$display_sales $display_returns $display_work_orders $display_customer_notes</td>
						</tr>
					";
				}
?>
					
				</tbody>
			</table>
<?php
		} //End if($num > 0)
		
		$sql = mysqli_query($mysqli,"SELECT * FROM computers
			WHERE system_number LIKE '%$q%'
			OR type LIKE '%$q%' 
			OR make LIKE '%$q%'
			OR model LIKE '%$q%'
			OR CONCAT(make,' ',type) LIKE '%$q%'
			OR CONCAT(make,' ',model) LIKE '%$q%'
			OR serial LIKE '%$q%'
			OR os LIKE '%$q%'
			OR CONCAT(os,' ',type) LIKE '%$q%'
			OR processor LIKE '%$q%'
			OR status LIKE '%$q%'
			ORDER BY computer_id DESC LIMIT 5"
    	);
		$num = mysqli_num_rows($sql);
		
		if($num > 0){	
?>

			<table class="table">	
			    <legend>Computers</legend>
				<thead>	
			        <tr>	
			            <th>#</th>
						<th>Item</th>
						<th>Description</th>
						<th>Status</th>
						<th>Price</th>
						<th>Added</th>
						<th></th>
					</tr>
				</thead>
			    <tbody>
					
<?php

				while($row = mysqli_fetch_array($sql)){
					$id = $row['computer_id'];
	                $system_number = $row['system_number'];
	                $type = ucwords($row['type']);
	                if($type == 'Laptop'){
	                	$type = 'fa fa-laptop';
	                }elseif($type == 'Desktop'){
	                	$type = 'fa fa-desktop';
	                }
	                $make = ucwords($row['make']);
	                $model = ucwords($row['model']);
	                $serial = $row['serial'];
	                $os = $row['os'];
	                $processor = $row['processor'];
	                $hard_drive = $row['hard_drive'];
	                $memory = $row['memory'];
	                $price = $row['price'];
	                $status = $row['status'];
	                $human_time = human_time($row['date_added']);
	                $date_added = date($date_format,$row['date_added']);
	                $label_printed = $row['label_printed'];
			        if($label_printed == 1){
			            $print_label = "btn btn-default"; 
			        }else{
			            $print_label = "btn btn-danger";
			        }
	                if($status == 'sold'){
	                	$sql2 = mysqli_query($mysqli,"SELECT * FROM computer_sales, customers WHERE computer_sales.customer_id = customers.customer_id AND computer_sales.computer_id = $id ");
	                	$row2 = mysqli_fetch_array($sql2);
	                	$customer_id = $row2['customer_id'];
	                	$last_name = ucwords($row2['last_name']);
	    				$first_name = ucwords($row2['first_name']);
	                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a></small>";
	                }elseif($status == 'returned'){
	                	$sql2 = mysqli_query($mysqli,"SELECT * FROM computer_returns, customers WHERE computer_returns.customer_id = customers.customer_id AND computer_id = $id");
	                	$row2 = mysqli_fetch_array($sql2);
	                	$customer_id = $row2['customer_id'];
	                	$last_name = ucwords($row2['last_name']);
	    				$first_name = ucwords($row2['first_name']);
	                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a></small>";
	                }else{
	                	$display = "";
	                }
	               
	                echo "
						<tr id='tr_$id'>
							<td><i class='$type'></i> $system_number</td>
							<td>$make $model<br><small>$serial</small></td>
							<td>$processor<br><small>$memory MB / $hard_drive GB</small></td>
							<td>$status $display</td>
							<td>$$price</td>
							<td>$human_time</td>
							<td>
								<div class='btn-group'>
								    <a class='btn btn-default $print_label' id='printComputerLabel_$id'><span class='glyphicon glyphicon-barcode'></span></a>
								    <a class='btn btn-default' href='edit_computer.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
								    <a class='btn btn-default' href='print_computer.php?id=$id'><span class='glyphicon glyphicon-print'></span></a>
	                            </div>
							</td>
						</tr>
					";
				}
?>
				
			</tbody>
		</table>	
		
<?php		

		}	
	} 
} 

?>
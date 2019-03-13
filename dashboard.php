<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$computers_today = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE()"));
	$customers_today = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM customers WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE()"));
	$work_orders_today = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE DATE(FROM_UNIXTIME(take_in_date)) = CURDATE()"));
	$work_orders_tbi = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'To Be Inspected'"));
	$work_orders_ip = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'In Progress'"));
	$work_orders_oh = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'On Hold'"));
	$work_orders_rfc = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'Ready For Collection'"));
	$work_order_pu_today = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_order_notes WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE() AND note = 'Status set to Picked Up'"));
	$work_order_notes_today = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_order_notes WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE()"));
	$sales_today = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales WHERE DATE(FROM_UNIXTIME(sale_date)) = CURDATE()"));
	$returns_today = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_returns WHERE DATE(FROM_UNIXTIME(return_date)) = CURDATE()"));
	$inventory_today_yesterday = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM inventory WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE(),1)"));
	$desktop_stock = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE status = 'stock' AND type = 'Desktop'"));
	$laptop_stock = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE status = 'stock' AND type = 'Laptop'"));
	$desktop_stock = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE status = 'stock' AND type = 'Desktop'"));
	$computer_stock = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE status = 'stock'"));
	$computer_good_to_go = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE status = 'goodtogo'"));

	mysqli_query($mysqli,"SELECT os,COUNT(*) as count FROM computers GROUP BY os ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT price,COUNT(*) as count FROM computers GROUP BY price ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT make,COUNT(*) as count FROM computers GROUP BY make ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT model,COUNT(*) as count FROM computers GROUP BY model ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT zip,COUNT(*) as count FROM customers GROUP BY zip ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT referral,COUNT(*) as count FROM customers GROUP BY referral ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT work_order_type,COUNT(*) as count FROM work_orders GROUP BY work_order_type ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT make,COUNT(*) as count FROM work_orders GROUP BY make ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT model,COUNT(*) as count FROM work_orders GROUP BY model ORDER BY count DESC");
	mysqli_query($mysqli,"SELECT type,COUNT(*) as count FROM work_orders GROUP BY type ORDER BY count DESC");

?>

<div class="row">
	<h4 class="text-center text-info"><i class='glyphicon glyphicon-stats'></i> Statistics Today</h4>
	<div class="col-md-offset-1 col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-group'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-success"><?php echo $customers_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>New Customers</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='glyphicon glyphicon-save'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-info"><?php echo $computers_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>Computers Refurbed</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-wrench'></i></div>
			<div class="panel-body">
				<a href="work_orders.php"><h2 class="text-center text-danger"><?php echo $work_orders_today; ?></h2></a>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>New Work Orders</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-shopping-cart'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-warning"><?php echo $sales_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>Computer Sales</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-refresh'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-danger"><?php echo $returns_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>Computer Returns</small></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<h4 class="text-center text-success"><span class='glyphicon glyphicon-stats'></span> Work Order Statistics</h4>
	<div class="col-md-offset-1 col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">To Be Inspected</div>
			<div class="panel-body">
				<a href="work_orders.php?q=To Be Inspected"><h2 class="text-center text-success"><?php echo $work_orders_tbi; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">In Progress</div>
			<div class="panel-body">
				<a href="work_orders.php?q=In Progress"><h2 class="text-center text-info"><?php echo $work_orders_ip; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">On Hold</div>
			<div class="panel-body">
				<a href="work_orders.php?q=On Hold"><h2 class="text-center text-danger"><?php echo $work_orders_oh; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Ready For Collect</div>
			<div class="panel-body">
				<a href="work_orders.php?q=Ready For Collection"><h2 class="text-center text-warning"><?php echo $work_orders_rfc; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Collected</div>
			<div class="panel-body">
				<h2 class="text-center text-success"><?php echo $work_order_pu_today; ?></h2>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<h4 class="text-center text-danger"><span class='glyphicon glyphicon-stats'></span> Stock</h4>
	<div class="col-md-offset-2 col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Laptops</div>
			<div class="panel-body">
				<h2 class="text-center text-success"><?php echo $laptop_stock; ?></h2>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Desktops</div>
			<div class="panel-body">
				<h2 class="text-center text-info"><?php echo $desktop_stock; ?></h2>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Total</div>
			<div class="panel-body">
				<h2 class="text-center text-danger"><?php echo $computer_stock; ?></h2>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Good To Go</div>
			<div class="panel-body">
				<h2 class="text-center text-warning"><?php echo $computer_good_to_go; ?></h2>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
    	<div class="panel panel-default">
    		<div class="panel-heading">Clocked in</div>
    		<div class="panel-body">
			    <table class='table '>
			      <tr>
			        <th>Employee</th>
			        <th>Location</th>
			        <th>Clocked in</th>
			        <th>Clocked Out</th>
			      </tr>
			    
			    <?php
			    //Employees Clocked in.

			    $sql = mysqli_query($mysqli,"SELECT * FROM users, employee_clockin_clockout, locations 
							   WHERE DATE(FROM_UNIXTIME(clock_in)) = CURDATE()
							   AND users.user_id = employee_clockin_clockout.user_id
							   AND locations.location_id = employee_clockin_clockout.store_id");
				while ($row = mysqli_fetch_array($sql)){

				$user_first_name = $row['user_first_name'];
				$user_last_name = $row['user_last_name'];
			    $clock_in = date('g:i a', $row['clock_in']);
			    if($row['clock_out'] <> 0 ) {
			    	$clock_out = date('g:i a', $row['clock_out']);
			    }else{
			    	$clock_out = "-";
			    }
			    
			    $location = $row['location'];
			    
			echo "
			      <tr>
			        <td>$user_first_name $user_last_name</td>
			        <td>$location</td>
			        <td>$clock_in</td>
			        <td>$clock_out</td>
			      </tr>";
			}
			?>  
			    </table>
			</div>
		</div>
	</div>	

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Users Online</div>
			<div class="panel-body">
				<?php
				$sql = mysqli_query($mysqli,"SELECT * FROM users WHERE online >= UNIX_TIMESTAMP(DATE_ADD(NOW(),INTERVAL -10 MINUTE))") or die ("cant do it");
				while($row = mysqli_fetch_array($sql))
				{
				 	$username = ucwords($row['username']);
				 	$avatar = $row['avatar']; 
				 	echo "
				 		<div class='col-md-2'>
				 			<center>
				 				<img class='img-circle' height='60' width='60' src='$avatar'>
				 				<br>
				 				<small class='text-success'>$username</small>
				 			</center>
				 		</div>
				 	";
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>
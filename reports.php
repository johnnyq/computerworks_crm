<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
	$now = time();
	$date_from = strtotime('today');
	$date_to = $now;
	if(isset($_GET['canned_date'])){
		$detailed = $_GET['detailed'];
		$canned_date = $_GET['canned_date'];
		$date_from = strtotime($_GET['date_from']);
		$date_to = strtotime($_GET['date_to']);
		if($canned_date == 'custom'){
			$date_from = strtotime("midnight", $date_from);
			$date_to   = strtotime("tomorrow", $date_to) - 1;
		}elseif($canned_date == "today"){
			$date_from = strtotime('today');
			$date_to = $now;
		}elseif($canned_date == "yesterday"){
			$date_from = strtotime('yesterday');
			$date_to = strtotime('yesterday 23:59');
		}elseif($canned_date == "weektodate"){
			$date_from = strtotime('last monday');
			$date_to = $now;
		}elseif($canned_date == "lastweek"){
			$date_from = strtotime('last week 00:00');
			$date_to = strtotime('last week + 7 days');
		}elseif($canned_date == "monthtodate"){
			$date_from = strtotime('first day of this month 00:00');
			$date_to = $now;
		}elseif($canned_date == "lastmonth"){
			$date_from = strtotime('first day of last month 00:00');
			$date_to = strtotime('last day of last month 23:59');
		}elseif($canned_date == "yeartodate"){
			$date_from = strtotime('first day of january this year');
			$date_to = $now;
		}elseif($canned_date == "lastyear"){
			$date_from = strtotime('first day of january last year');
			$date_to = strtotime('last day of december last year 23:59');
		}elseif($canned_date == "2014"){
			$date_from = strtotime('first day of january 2014');
			$date_to = strtotime('last day of december 2014 23:59');
		}elseif($canned_date == "2013"){
			$date_from = strtotime('first day of january 2013');
			$date_to = strtotime('last day of december 2013 23:59');
		}elseif($canned_date == "2012"){
			$date_from = strtotime('first day of january 2012');
			$date_to = strtotime('last day of december 2012 23:59');
		}elseif($canned_date == "2011"){
			$date_from = strtotime('first day of january 2011');
			$date_to = strtotime('last day of december 2011 23:59');
		}
	}
	$readable_date_from = date("Y-m-d",$date_from);
	$readable_date_to = date("Y-m-d",$date_to);	

	$sql = mysqli_query($mysqli,"SELECT * FROM users");

	$customers = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM customers WHERE date_added > $date_from AND date_added < $date_to"));

?>
<form class="form-inline well well-sm">
  <div class="form-group">
    <select class="form-control" id="canned_date" name="canned_date">
		<option value="custom" <?php if($canned_date == "custom"){ echo "selected"; } ?>>Custom</option>
		<option value="today" <?php if($canned_date == "today"){ echo "selected"; } ?>>Today</option>
		<option value="yesterday" <?php if($canned_date == "yesterday"){ echo "selected"; } ?>>Yesterday</option>
		<option value="weektodate" <?php if($canned_date == "weektodate"){ echo "selected"; } ?>>Week to Date</option>
		<option value="lastweek" <?php if($canned_date == "lastweek"){ echo "selected"; } ?>>Last Week</option>
		<option value="monthtodate" <?php if($canned_date == "monthtodate"){ echo "selected"; } ?>>Month to Date</option>
		<option value="lastmonth" <?php if($canned_date == "lastmonth"){ echo "selected"; } ?>>Last Month</option>
		<option value="yeartodate" <?php if($canned_date == "yeartodate"){ echo "selected"; } ?>>Year to Date</option>
		<option value="lastyear" <?php if($canned_date == "lastyear"){ echo "selected"; } ?>>Last Year</option>
		<option value="2014" <?php if($canned_date == "2014"){ echo "selected"; } ?>>2014</option>
		<option value="2013" <?php if($canned_date == "2013"){ echo "selected"; } ?>>2013</option>
		<option value="2012" <?php if($canned_date == "2012"){ echo "selected"; } ?>>2012</option>
		<option value="2011" <?php if($canned_date == "2011"){ echo "selected"; } ?>>2011</option>
	</select>
  </div>
  <div class="form-group">
    <input type="date" class="form-control" id="date_from" name="date_from" value="<?php echo "$readable_date_from"; ?>" placeholder="From Date">
  </div>
  <div class="form-group">
    <input type="date" class="form-control" id="date_to" name="date_to" value="<?php echo "$readable_date_to"; ?>" placeholder="To Date">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="detailed" <?php if($detailed =="on"){ echo "checked"; } ?> > Detailed Report
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Generate Report</button>
</form>
<h1>Customer Added: <?php echo $customers; ?></h1>
<table class="table table-bordered">
	<tr>
		<th>Employee</th>
		<th>Sales</th>
		<th>Returns</th>
		<th>Refurbed</th>
		<th>Cust Notes</th>
		<th>Work Orders</th>
		<th>WO Notes</th>
		<th>Interactions</th>
	</tr>
	<?php 
	
	while($row = mysqli_fetch_array($sql)){
		$user_id = $row['user_id'];
		$username = $row['username'];
		
		$sales = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales WHERE employee_id = $user_id AND sale_date > $date_from AND sale_date < $date_to"));
		$laptop_sales = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales, computers WHERE computer_sales.computer_id = computers.computer_id AND computer_sales.employee_id = $user_id AND type = 'laptop' AND sale_date > $date_from AND sale_date < $date_to"));
		$desktop_sales = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales, computers WHERE computer_sales.computer_id = computers.computer_id AND computer_sales.employee_id = $user_id AND type = 'desktop' AND sale_date > $date_from AND sale_date < $date_to"));
		$all_in_one_sales = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales, computers WHERE computer_sales.computer_id = computers.computer_id AND computer_sales.employee_id = $user_id AND type = 'all-in-one' AND sale_date > $date_from AND sale_date < $date_to"));
		$returns = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_returns WHERE employee_id = $user_id AND return_date > $date_from AND return_date < $date_to"));
		$computers = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE employee = $user_id AND date_added > $date_from AND date_added < $date_to"));
		$laptop_computers = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE employee = $user_id AND type = 'laptop' AND date_added > $date_from AND date_added < $date_to"));
		$desktop_computers = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE employee = $user_id AND type = 'desktop' AND date_added > $date_from AND date_added < $date_to"));
		$all_in_one_computers = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computers WHERE employee = $user_id AND type = 'all-in-one' AND date_added > $date_from AND date_added < $date_to"));
		$customer_notes = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM customer_notes WHERE employee = $user_id AND date_added > $date_from AND date_added < $date_to"));
		$work_orders = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE take_in_employee = $user_id AND take_in_date > $date_from AND take_in_date < $date_to"));
		$work_order_notes = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_order_notes WHERE employee = $user_id AND date_added > $date_from AND date_added < $date_to"));
		$interactions = $sales + $returns + $computers + $customer_notes + $work_orders + $work_order_notes;
		$total_sales += $sales;
		$total_returns += $returns;
		$total_computers += $computers;
		$total_customer_notes += $customer_notes;
		$total_work_orders += $work_orders;
		$total_work_order_notes += $work_order_notes;
		$total_interactions += $interactions;
		if($interactions > 0){
			echo "
				<tr>
					<td>$username</td>
					<td>Total: $sales<br>Laptops: $laptop_sales<br>Desktops: $desktop_sales<br>All In Ones: $all_in_one_sales</td>
					<td>$returns</td>
					<td>Total: $computers<br>Laptops: $laptop_computers<br>Desktops: $desktop_computers<br>All in Ones: $all_in_one_computers</td>
					<td>$customer_notes</td>
					<td>$work_orders</td>
					<td>$work_order_notes</td>
					<td>$interactions</td>
				</tr>
			";
		}
	}
	
	?>

<tr>
	<th>Totals</th>
	<td><?php echo $total_sales; ?></td>
	<td><?php echo $total_returns; ?></td>
	<td><?php echo $total_computers; ?></td>
	<td><?php echo $total_customer_notes; ?></td>
	<td><?php echo $total_work_orders; ?></td>
	<td><?php echo $total_work_order_notes; ?></td>
	<td><?php echo $total_interactions; ?></td>
</tr>
	
</table>

<?php if($detailed == "on"){ ?>

<?php if($total_sales > 0){ ?>

	<div class="panel panel-default">
		<div class="panel-heading text-center"><i class='fa fa-shopping-cart'></i> Computer Sales</div>
		<table class="table" id="dataTables">
			<thead>
				<tr>
					<td>Time</th>
					<td>Computer</th>
					<td>Price</th>
					<td>Seller</th>
					<td>Customer</th>
				</tr>
			</thead>
			<tbody>
				
				<?php
				
				$sql = mysqli_query($mysqli,"SELECT * FROM users, computer_sales, customers, computers
					WHERE computer_sales.employee_id = users.user_id
					AND computer_sales.computer_id = computers.computer_id
					AND computer_sales.customer_id = customers.customer_id
					AND computer_sales.sale_date > $date_from 
					AND computer_sales.sale_date < $date_to
					ORDER BY sale_id DESC"
				);

				while($row = mysqli_fetch_array($sql)){
	                $type = $row['type'];
	                if($type == 'Laptop'){
	                	$type = 'fa fa-laptop';
	                }elseif($type == 'Desktop'){
	                	$type = 'fa fa-desktop';
	                }
	                $make = ucwords($row['make']);
	                $model = ucwords($row['model']);
	                $price = $row['price'];
	                $username = ucwords($row['username']);   
	                $human_time = human_time($row['sale_date']);
	                $sale_date = date('g:ia',$row['sale_date']);
	                $first_name = $row['first_name'];
	                $last_name = $row['last_name'];
	                $customer_id = $row['customer_id'];
	                $system_number = $row['system_number'];
	                $warranty = $row['warranty'];
	                $total += $price;
	                echo "
						<tr>
							<td>$human_time</td>
							<td><i class='$type'></i> $make <small>$model</small><br><small class='text-muted'>$system_number - $warranty Day</small></td>
							<td>$$price</td>
							<td>$username</td>
							<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>					
						</tr>
					";
				}
			    ?>
			
			</tbody>
		</table>
		<div class="panel-footer text-center">Total: $<?php echo $total; ?></div>
	</div>

<?php } ?>

<?php if($total_returns > 0){ ?>

<div class="panel panel-default">
	<div class="panel-heading text-center"><i class='fa fa-refresh'></i> Returns</div>
	<table class="table" id="dataTables2">
		<thead>
			<tr>
				<td>Time</td>
				<td>Computer</td>
				<td>Price</td>
				<td>Returned By</td>
				<td>Customer</td>
				<td>Reason</td>
			</tr>
		</thead>
		<tbody>
			
			<?php
			
			$sql = mysqli_query($mysqli,"SELECT * FROM users, computer_returns, customers, computers
				WHERE computer_returns.employee_id = users.user_id
				AND computer_returns.computer_id = computers.computer_id
				AND computer_returns.customer_id = customers.customer_id
				AND return_date > $date_from AND return_date < $date_to
				ORDER BY return_id DESC"
			);

			while($row = mysqli_fetch_array($sql)){
                $type = $row['type'];
                if($type == 'Laptop'){
                	$type = 'fa fa-laptop';
                }elseif($type == 'Desktop'){
                	$type = 'fa fa-desktop';
                }
                $make = ucwords($row['make']);
                $model = ucwords($row['model']);
                $system_number = $row['system_number'];
                $price = $row['price'];
                $username = ucwords($row['username']);   
                $human_time = human_time($row['return_date']);
                $return_date = date('g:ia',$row['return_date']);
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $customer_id = $row['customer_id'];
                $reason = $row['reason'];
                
                echo "
					<tr>
						<td>$human_time</td>
						<td><i class='$type'></i> $make <small>$model</small><br><small>$system_number</small></td>
						<td>$$price</td>
						<td>$username</td>
						<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>					
						<td><small>$reason</small></td>
					</tr>
				";
			}
		    
		    ?>
		
		</tbody>
	</table>
</div>

<?php } ?>

<?php if($customers > 0){ ?>

<div class="panel panel-default">
	<div class="panel-heading text-center"><i class='fa fa-group'></i> Customers Added</div>
	<table class="table" id="dataTables3">
		<thead>
			<tr>
				<td>Time</th>
				<td>Name</th>
				<td>City</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			
			$sql = mysqli_query($mysqli,"SELECT * FROM customers
				WHERE date_added > $date_from 
				AND date_added < $date_to
				ORDER BY customer_id DESC"
			);

			while($row = mysqli_fetch_array($sql)){
                $customer_id = $row['customer_id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $city = $row['city'];
                $human_time = human_time($row['date_added']);
                $date_added = date('g:ia',$row['date_added']);
                
                echo "
					<tr>
						<td>$human_time</td>
						<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>
						<td>$city</td>
					</tr>
				";
			}
		    
		    ?>
		
		</tbody>
	</table>
</div>

<?php } ?>


<?php if($total_computers > 0){ ?>

<div class="panel panel-default">
	<div class="panel-heading text-center"><span class='glyphicon glyphicon-save'></span> Computers Refurbished</div>
	<table class="table" id="dataTables4">
		<thead>
			<tr>
				<td>Time</th>
				<td>Computer</th>
				<td>Specs</td>
				<td>Price</td>
			</tr>
		</thead>
		<tbody>
			
			<?php
			
			$sql = mysqli_query($mysqli,"SELECT * FROM computers WHERE date_added > $date_from AND date_added < $date_to ORDER BY computer_id DESC");

			while($row = mysqli_fetch_array($sql)){
                $system_number = $row['system_number'];
                $type = $row['type'];
                if($type == 'Laptop'){
                	$type = 'fa fa-laptop';
                }elseif($type == 'Desktop'){
                	$type = 'fa fa-desktop';
                }
                $make = $row['make'];
                $model = $row['model'];
                $price = $row['price'];
                $memory = $row['memory'];
                $processor = $row['processor'];
                $os = $row['os'];
                $hard_drive = $row['hard_drive'];
                $human_time = human_time($row['date_added']);
                $date_added = date('g:ia',$row['date_added']);
           
                echo "
					<tr>
						<td>$human_time</td>
						<td><i class='$type'></i> $make $model<br><small class='text-muted'>$system_number</td>
						<td><small>$processor/$memory MB/$hard_drive GB<br>$os</small></td>
						<td>$$price</td>
					</tr>
				";
			}

		    ?>
		
		</tbody>
	</table>
</div>

<?php } ?>

<?php if($total_work_orders > 0){ ?>

<div class="panel panel-default">
	<div class="panel-heading text-center"><i class='fa fa-wrench'></i> WorkOrders</div>
	<table class="table" id="dataTables5">
		<thead>
			<tr>
				<td>Time</td>
				<td>Type</td>
				<td>User</td>
				<td>Asset</th>
				<td>Customer</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			
			$sql = mysqli_query($mysqli,"SELECT * FROM users, customers, work_orders
				WHERE work_orders.take_in_employee = users.user_id
				AND work_orders.customer_id = customers.customer_id
				AND take_in_date > $date_from AND take_in_date < $date_to
				ORDER BY work_order_id DESC"
			);

			while($row = mysqli_fetch_array($sql)){
                $type = $row['type'];
                if($type == 'Laptop'){
                	$type = 'fa fa-laptop';
                }elseif($type == 'Desktop'){
                	$type = 'fa fa-desktop';
                }
                $make = ucwords($row['make']);
                $model = ucwords($row['model']);
                $username = ucwords($row['username']);
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $customer_id = $row['customer_id'];
                $work_order_type = $row['work_order_type'];
                $human_time = human_time($row['take_in_date']);
                $take_in_date = date('g:ia',$row['take_in_date']);
                
                echo "
					<tr>
						<td>$human_time</td>
						<td>$work_order_type</td>
						<td>$username</td>
						<td><i class='$type'></i> $make <small>$model</small></td>
						<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>
					</tr>
				";
			}
		    
		    ?>
		
		</tbody>
	</table>
	<div class="panel-footer"></div>
</div>

<?php } ?>

<?php } //End if detail = on  ?>

<?php include "includes/footer.php"; ?>
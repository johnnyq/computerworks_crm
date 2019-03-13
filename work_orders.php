<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$tbi_count = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'To Be Inspected'"));
	$ip_count = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'In Progress'"));
	$oh_count = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'On Hold'"));
	$rfc_count = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE work_order_status = 'Ready For Collection'"));

	if (isset($_GET['q'])){
		$q = $_GET['q'];
	}elseif($tbi_count > 0){
		$q = 'To Be Inspected';
	}elseif($ip_count > 0){
		$q = 'In Progress';
	}elseif($oh_count > 0){
		$q = 'On Hold';
	}elseif($rfc_count > 0){
		$q = 'Ready For Collection';
	}

	$sql = mysqli_query($mysqli,"SELECT * FROM users, customers, work_orders
			WHERE work_orders.take_in_employee = users.user_id
			AND work_orders.customer_id = customers.customer_id
			AND work_order_status = '$q'
			ORDER BY work_order_id DESC");
	
	$num_rows = mysqli_num_rows($sql);

	if ($q == 'To Be Inspected'){
    	$hide = 'hide';
    }else{
    	$hide = '';
    }

?>		
		<ul class="nav nav-pills nav-justified well well-sm">
		  <?php if($tbi_count > 0){ ?><li <?php if($q == 'To Be Inspected'){ echo "class='active'"; } ?>><a href="?q=To Be Inspected">To Be Inspected <span class="badge pull-right"><?php echo $tbi_count; ?></span></a></li> <?php } ?>
		  <?php if($ip_count > 0){ ?><li <?php if($q == 'In Progress'){ echo "class='active'"; } ?>><a href="?q=In Progress">In Progress <span class="badge pull-right"><?php echo $ip_count; ?></span></a></li> <?php } ?>
		  <?php if($oh_count > 0){ ?><li <?php if($q == 'On Hold'){ echo "class='active'"; } ?>><a href="?q=On Hold">On Hold <span class="badge pull-right"><?php echo $oh_count; ?></span></a></li><?php } ?>
		  <?php if($rfc_count > 0){ ?><li <?php if($q == 'Ready For Collection'){ echo "class='active'"; } ?>><a href="?q=Ready For Collection">Ready For Collection <span class="badge pull-right"><?php echo $rfc_count; ?></span></a></li><?php } ?>
		  <li <?php if($q == 'Picked Up'){ echo "class='active'"; } ?>><a href="?q=Picked Up">Picked Up</a></li>
		</ul>
		
		<?php if($num_rows > 0){ ?>
			<table class="table" <?php if($num_rows > 10){ echo "id='dataTables'"; } ?>>
				<thead>
					<tr>
						<th>WO#</th>
						<th>Date</th>
						<th>Customer</th>
						<th>Details</th>
						<th>Takin</th>
						<th class="<?php echo $hide; ?>">Updated</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
			
					while($row = mysqli_fetch_array($sql)){
						$type = ucwords($row['type']);
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
						$take_in_date = date($date_format,$row['take_in_date']);
						$human_time = human_time($row['take_in_date']);
						$work_order_id = $row['work_order_id'];
					
						$sql2 = mysqli_query($mysqli,"SELECT * FROM work_order_notes, users WHERE work_order_notes.employee = users.user_id AND work_order_id = $work_order_id ORDER BY work_order_note_id DESC LIMIT 1");
						$row2 = mysqli_fetch_array($sql2);
						$sql2_count = mysqli_num_rows($sql2);
						$date_note_added = date($date_format,$row2['date_added']);
						$human_time2 = human_time($row2['date_added']);
						$username_last_update = ucwords($row2['username']);
						if($row2['date_added'] < strtotime('5 days ago')){ 
							$rowresult = "class='danger'";
						}elseif($row2['date_added'] < strtotime('3 days ago')){
							$rowresult = "class='warning'"; 
						}else{ 
							$rowresult = "";
						}
						if($sql2_count == 0){
							$rowresult = "";
						}
						echo "
							<tr $rowresult>
								<td>$work_order_id</td>
								<td>$human_time</td>
								<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>
								<td><i class='$type'></i> $make <small>$model<br>$work_order_type</small></td>
								<td>$username</td>
								<td class='$hide'>$human_time2<br><small>$username_last_update</small></td>
								<td>
									<div class='btn-group'>
										<a class='btn btn-primary' href='work_order_details.php?id=$work_order_id'><i class='glyphicon glyphicon-eye-open'></i></a>
										<a class='btn btn-default' href='print_work_order.php?id=$work_order_id'><i class='fa fa-print'></i></a>
									</div>
								</td>
							</tr>
						";
					}
					
					?>
				
				</tbody>
			</table>

<?php 

	}else{
		echo "<div class='alert alert-danger'>No Work Orders found!</div>";
	}

?>

<?php include("includes/footer.php"); ?>
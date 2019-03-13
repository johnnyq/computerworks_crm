<?php

include "config.php";
include "includes/check_login.php";
include "includes/functions.php";

if(isset($_GET['id'])){
	$id = intval($_GET['id']);

$sql = mysqli_query($mysqli,"SELECT * FROM work_orders 
			WHERE customer_id = $id
			AND work_order_status = 'Picked Up'
			ORDER BY work_order_id DESC"
);
	
$num = mysqli_num_rows($sql);
if($num>0){

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-wrench"></i> WorkOrder History <span class="badge pull-right"><?php echo "$num"; ?></span></h3>
	</div>
	<table class="table" id="dt2">
		<thead>
			<tr>
				<th>Date</th>
				<th>Type</th>
				<th>Asset</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				
				while ($row = mysqli_fetch_array($sql)){
					$work_order_id = $row['work_order_id'];
					$customer_id = $row['customer_id'];
			  		$take_in_date = date($date_format, $row['take_in_date']);
			  		$human_take_in_date = human_time($row['take_in_date']);
					$type = ucwords($row['type']);
	                if($type == 'Laptop'){
	                	$type_icon = 'fa fa-laptop';
	                }elseif($type == 'Desktop'){
	                	$type_icon = 'fa fa-desktop';
	                }
					$make = $row['make'];
					$model = $row['model'];
					$serial = $row['serial'];
					$work_order_type = $row['work_order_type'];
			    	
			    	echo "
						<tr>
							<td>$take_in_date<br><small class='text-muted'>$human_take_in_date</small></td>
							<td>$work_order_type</td>
							<td><i class='$type_icon'></i> $make <small>$model</small></td>
							<td>
								<div class='btn-group'>
				  					<a class='btn btn-default btn-sm' onclick='collapseInsideWorkOrder($work_order_id)'><i class='fa fa-wrench'></i></a>
				  					<a class='btn btn-default btn-sm' href='print_work_order.php?id=$work_order_id' target='_blank'><i class='fa fa-print'></i></a>
				  					<a class='btn btn-default btn-sm' href='work_order_details.php?id=$work_order_id'><i class='glyphicon glyphicon-eye-open'></i></a>
				  				</div>
				  			</td>
						</tr>
						<tr id='collapseInsideWorkOrder_$work_order_id' class='hide' >
							<td colspan='5'>
						        <input type='hidden' id='customer_$work_order_id' value='$customer_id'>
						        <input type='hidden' id='type_$work_order_id' value='$type'>
						        <input type='hidden' id='make_$work_order_id' value='$make'>
						        <input type='hidden' id='model_$work_order_id' value='$model'>
						        <input type='hidden' id='serial_$work_order_id' value='$serial'>
						        <label>Scope</label>
						     

						        <select class='form-control input-lg' name='scope' id='scope_$work_order_id' autofocus required>
						       		<option></option>
						       		
						       		";
						       			
						       			$sql2 = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'work_order_type' ORDER BY value ASC");
										while($row = mysqli_fetch_array($sql2)){
							                $value = $row['value'];

							            	echo "<option>$value</option>";
							            }

							        
							    echo "


							     </select>
							    <label>Takin Notes</label>
							    <textarea class='form-control input-lg' id='takein_notes_$work_order_id' rows='6' required></textarea>
							    <br>
						        <div class='btn-group pull-right'>
									<button class='btn btn-default btn-lg' onclick='cancelInsideWorkOrder($work_order_id)'><span class='glyphicon glyphicon-remove'></span></button>
									<button class='btn btn-primary btn-lg' onclick='processInsideWorkOrder($work_order_id)'><span class='glyphicon glyphicon-ok'></span></button>
								</div>
							</td>
						</tr>
					";
				}
				$count = mysqli_num_rows($sql);

			?>
		
		</tbody>
	</table>
</div>

<?php
	} //End if no records found for Work Order History
}
?>
<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['id'])){
		$work_order_id = intval($_GET['id']);
	}

	$sql = mysqli_query($mysqli,"SELECT * FROM work_orders, users, customers, locations WHERE work_orders.location_id = locations.location_id AND work_orders.take_in_employee = users.user_id AND work_orders.customer_id = customers.customer_id AND work_orders.work_order_id = $work_order_id");

	$row = mysqli_fetch_array($sql);

	$type = ucwords($row['type']);
	$make = ucwords($row['make']);
	$model = ucwords($row['model']);
	$serial = $row['serial'];
	$username = ucwords($row['username']);
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$description = $row['description'];
	$customer_id = $row['customer_id'];
	$work_order_type = $row['work_order_type'];
	$take_in_date = date($date_format,$row['take_in_date']);

?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="work_order_details.php?id=<?php echo $work_order_id; ?>">Work Order Details</a></li>
	<li class="active">Edit Work Order</li>
</ol>    

<div id="response"></div>

<form id="ajaxEditForm" class="form-horizontal col-md-6" autocomplete="off">
	<input type="hidden" name="edit_work_order">
	<input type="hidden" name="id" value="<?php echo $work_order_id; ?>">
	<div class="form-group">
		<label class="col-sm-3">Scope</label>
		<div class="col-md-9">
			<input type="text" class="form-control input-lg" name="scope" value="<?php echo $work_order_type; ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Type</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="type" required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'computer_type' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
						$value = $row['value'];
	
						if($type == $value){
							echo "<option selected='selected'>$value</option>";
						}else{
							echo "<option>$value</option>";
						}			
					}
	
				?>
	
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Make</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="make" required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'make' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
						$value = $row['value'];
	
						if($make == $value){
							echo "<option selected='selected'>$value</option>";
						}else{
							echo "<option>$value</option>";
						}			
					}
	
				?>
	
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Model</label>
		<div class="col-md-9">
			<input type="text" class="form-control input-lg" name="model" value="<?php echo $model; ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Serial</label>
		<div class="col-md-9">
			<input type="text" class="form-control input-lg" name="serial" value="<?php echo $serial; ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Description</label>
		<div class="col-md-9">
			<textarea class="form-control input-lg" name="description" required><?php echo $description; ?></textarea>
			<br>
			<button class="btn btn-primary btn-lg">Submit</button>
		</div>
	</div>
</form>

<?php include "includes/footer.php"; ?>
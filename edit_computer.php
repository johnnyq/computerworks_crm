<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['id'])){
		$computer_id = $_GET['id'];
	}

	$sql = mysqli_query($mysqli,"SELECT * FROM computers WHERE computer_id = $computer_id");

	$row = mysqli_fetch_array($sql);
    $system_number = $row['system_number'];
    $type = ucwords($row['type']);
    $make = ucwords($row['make']);
    $model = ucwords($row['model']);
    $serial = $row['serial'];
    $os = $row['os'];
    $coa = $row['coa'];
    $processor = $row['processor'];
    $hard_drive = $row['hard_drive'];
    $memory = $row['memory'];
    $price = $row['price'];
    $status = $row['status'];
    $location_id = $row['location'];
    $notes = $row['notes'];
?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="computers.php">Computers</a></li>
	<li class="active">Edit Computer</li>
</ol>    

<div id="response"></div>

<form id="ajaxEditForm" class="form-horizontal col-md-6" autocomplete="off">
	<input type="hidden" name="edit_computer">
	<input type="hidden" name="id" value="<?php echo $computer_id; ?>">
	<div class="form-group">
		<label class="col-sm-3">System</label>
		<div class="col-md-9">
			<input type="text" class="form-control input-lg" name="system_number" value="<?php echo $system_number; ?>" readonly required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Location</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="location" required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM locations ORDER BY location ASC");
					while($row = mysqli_fetch_array($sql)){
						$location = $row['location'];
						$location_id_b = $row['location_id'];
	
						if($location_id == $location_id_b){
							echo "<option value='$location_id_b' selected='selected'>$location</option>";
						}else{
							echo "<option value='$location_id_b'>$location</option>";
						}			
					}
	
				?>
	
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Type</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="type" autofocus required>
				
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
	<label class="col-sm-3">Operating System</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="os" required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'os' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
						$value = $row['value'];
	
						if($os == $value){
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
	<label class="col-sm-3">COA</label>
		<div class="col-md-9">
			<input type="text" class="form-control input-lg" name="coa" value="<?php echo $coa; ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Processor</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="processor" required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'processor' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
						$value = $row['value'];
	
						if($processor == $value){
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
	<label class="col-sm-3">Memory</label>
	<div class="col-md-9">
		<select class="form-control input-lg" name="memory" required>
			
			<?php
				
				$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'memory' ORDER BY ABS(value) ASC");
				while($row = mysqli_fetch_array($sql)){
					$value = $row['value'];

					if($memory == $value){
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
		<label class="col-sm-3">Hard Drive</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="hard_drive" required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'harddrive' ORDER BY ABS(value) ASC");
					while($row = mysqli_fetch_array($sql)){
						$value = $row['value'];
	
						if($hard_drive == $value){
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
		<label class="col-sm-3">Status</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="status" required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'computer_status' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
						$value = $row['value'];
	
						if($status == $value){
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
	<label class="col-sm-3">Price</label>
	<div class="col-md-9">
		<input type="text" class="form-control input-lg" name="price" value="<?php echo $price; ?>" required >
	</div>
	</div>

	<div class="form-group">
	<label class="col-sm-3">Notes</label>
	<div class="col-md-9">
		<textarea class="form-control input-lg" name="notes"><?php echo $notes; ?></textarea>
		<br>
		<button class="btn btn-primary btn-lg">Submit</button>
	</div>
	</div>
</form>

<?php include "includes/footer.php"; ?>
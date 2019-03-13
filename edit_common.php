<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['id'])){
		$common_id = $_GET['id'];
	}

	$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE common_id = $common_id");

	$row = mysqli_fetch_array($sql);
    $category_id_commons = $row['category_id'];
    $common = $row['value'];

?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="admin_commons.php">Commons</a></li>
	<li class="active">Edit Common</li>
</ol>    

<div id="response"></div>

<form id="ajaxEditForm" class="form-horizontal col-md-6" autocomplete="off">
	<input type="hidden" name="edit_common">
	<input type="hidden" name="common_id" value="<?php echo $common_id; ?>">
	<div class="form-group">
		<label class="col-sm-3">Category</label>
		<div class="col-md-9">
			<select class="form-control input-lg" name="category" autofocus required>
				
				<?php
					
					$sql = mysqli_query($mysqli,"SELECT * FROM commons_categories ORDER BY category ASC");
					while($row = mysqli_fetch_array($sql)){
						$category_id = $row['category_id'];
						$category = $row['category'];
	
						if($category_id == $category_id_commons){
							echo "<option value='$category_id' selected='selected'>$category</option>";
						}else{
							echo "<option value='$category_id'>$category</option>";
						}			
					}
	
				?>
	
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">Name</label>
		<div class="col-md-9">
			<input type="text" class="form-control input-lg" name="name" value="<?php echo $common; ?>" required>
			<br>
			<button class="btn btn-primary btn-lg">Submit</button>
		</div>
	</div>
</form>

<?php include "includes/footer.php"; ?>
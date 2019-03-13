<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['id'])){
	  	$id = $_GET['id'];
	  	
	  	$sql = mysqli_query($mysqli,"SELECT * FROM locations WHERE location_id = $id");

	  	$row = mysqli_fetch_array($sql);
	  	$location = $row['location'];
	}

?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Editing Location</h3>
	</div>
	<div class="panel-body">
	    <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="users.php">Admin</a></li>
		  <li><a href="locations.php">Locations</a></li>
		  <li class="active">Edit Location</li>
		</ol>    

	    <div id="response"></div>

	    <form id="ajaxEditForm" class="form col-md-4" autocomplete="off">
	      <input type="hidden" name="edit_location">
	      <input type="hidden" name="id" value="<?php echo $id; ?>">
	      <div class="form-group has-feedback">
	        <label>Location</label>
	        <input type="text" class="form-control input-lg" name="location" value="<?php echo "$location"; ?>" autofocus required>
	        <span class="glyphicon glyphicon-home form-control-feedback"></span>
	        <br>
	        <button class="btn btn-primary btn-lg">Submit</button>
	      </div>
	    </form>
	</div>
</div>

<?php include "includes/footer.php"; ?>
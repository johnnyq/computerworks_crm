<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="admin_commons.php">Commons</a></li>
  <li class="active">Add Common</li>
</ol>    

<div id="response"></div>
<div class="col-md-5">
    <form id="ajaxform" class="form-horizontal" autocomplete="off">
      <input type="hidden" name="add_common">
      <div class="form-group">
        <label class="control-label col-sm-3">Category</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="category" autofocus required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysqli_query($mysqli,"SELECT * FROM commons_categories ORDER BY category ASC");
					while($row = mysqli_fetch_array($sql)){
		                $category_id = $row['category_id'];
		                $category = $row['category'];

		            	echo "<option value=$category_id>$category</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Name</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="name" required>
	        <br>
	        <button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok"></span> Add</button>
	    </div>
      </div>
    </form>
</div>

<?php include "includes/footer.php"; ?>
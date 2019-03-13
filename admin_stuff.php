<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<div class="col-md-3">
	<?php include "includes/admin_nav.php"; ?>
</div>
<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Admin Stuff</h3>
		</div>
		<div class="panel-body">
		    
		    <div id="response"></div>

		    <button class="btn btn-default">Download Emails in CSV</button>

		    <form id="ajaxform" class="form col-md-4" autocomplete="off">
		      <legend>Transfer Sale</legend>
		      <input type="hidden" name="transfer_sale">
		      <div class="form-group has-feedback">
		        <label>Sale ID</label>
		        <input type="text" class="form-control input-lg" name="sale_id" required>
		        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <label>Customer ID</label>
		        <input type="text" class="form-control input-lg" name="customer_id" required>
		        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
		        <br>
		        <button class="btn btn-primary btn-lg">Submit</button>
		      </div>
		    </form>
		    
		    <form id="ajaxForm2" class="form col-md-4" autocomplete="off">
		      <legend>Transfer WorkOrder</legend>
		      <input type="hidden" name="transfer_work_order">
		      <div class="form-group has-feedback">
		        <label>Work Order ID</label>
		        <input type="text" class="form-control input-lg" name="work_order_id" required>
		        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <label>Customer ID</label>
		        <input type="text" class="form-control input-lg" name="customer_id" required>
		        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
		        <br>
		        <button class="btn btn-primary btn-lg">Submit</button>
		      </div>
		    </form>
		    <form id="ajaxForm3" class="form col-md-4" autocomplete="off">
		      <legend>Delete Customer</legend>
		      <input type="hidden" name="delete_customer">
		      <div class="form-group">
		        <label>Customer ID</label>
		        <input type="text" class="form-control input-lg" name="customer_id" required>
		        <br>
		        <button class="btn btn-danger btn-lg">Delete</button>
		      </div>
		    </form>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>
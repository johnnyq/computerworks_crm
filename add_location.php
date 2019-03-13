<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Add Location</h3>
	</div>
	<div class="panel-body">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="users.php">Admin</a></li>
		  <li><a href="locations.php">Locations</a></li>
		  <li class="active">Add Location</li>
		</ol>    
	    
	    <div id="response"></div>

	    <form id="ajaxform" class="form col-md-4" autocomplete="off">
	      <input type="hidden" name="add_location">
	      <div class="form-group has-feedback">
	        <label>Location</label>
	        <input type="text" class="form-control input-lg" name="location" autofocus required>
	        <span class="glyphicon glyphicon-home form-control-feedback"></span>
	        <br>
	        <button class="btn btn-primary btn-lg">Submit</button>
	      </div>
	    </form>
	</div>
</div>

<?php include "includes/footer.php"; ?>

<script>

	$("#ajaxform").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            $('#ajaxform').trigger("reset");
	    		$("form:not(.filter) :input:visible:enabled:first").focus();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

</script>